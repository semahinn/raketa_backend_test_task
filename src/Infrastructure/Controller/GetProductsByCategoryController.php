<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Raketa\BackendTestTask\Application\DTO\DTOValidator\GetProductsByCategoryDTOValidatorInterface;
use Raketa\BackendTestTask\Application\DTO\Exception\DTOValidatorException;
use Raketa\BackendTestTask\Application\Service\ProductServiceInterface;
use Raketa\BackendTestTask\Infrastructure\View\ProductsView;

readonly class GetProductsByCategoryController
{
    public function __construct(
        private ProductServiceInterface $productsService,
        private ProductsView $productsView,
        private LoggerInterface $logger,
        private GetProductsByCategoryDTOValidatorInterface $dtoValidator,
    ) {
    }

    public function get(RequestInterface $request): ResponseInterface
    {
        $response = new JsonResponse();
        $status = 200;
        $rawRequest = json_decode($request->getBody()->getContents(), true);

        $dto = null;
        try {
            $dto = $this->dtoValidator->validate($rawRequest);
        }
        catch (DTOValidatorException $e) {
            $status = $e->getCode();
            $ui_message = "Некорректные входные данные";
            $this->logger->error("Некорректные входные данные: " . $e->getMessage());
            $response->getBody()->write(
                json_encode(
                    [
                        'message' => $ui_message
                    ],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }

        try {
            $products = $this->productsService->getProductsByCategory($dto);
            $response->getBody()->write(
                json_encode(
                    [
                        'products' => $this->productsView->toArray($products),
                    ],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        catch (\Exception $e) {
            $status = $e->getCode();
            $ui_message = "Не удалось получить товары этой категории";
            $this->logger->error("Не удалось получить товары категории с id '{$dto->categoryId}': " . $e->getMessage());
            $response->getBody()->write(
                json_encode(
                    [
                        'message' => $ui_message
                    ],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus($status);
    }
}
