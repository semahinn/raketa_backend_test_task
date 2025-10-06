<?php

namespace Raketa\BackendTestTask\Infrastructure\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Raketa\BackendTestTask\Application\DTO\DTOValidator\AddProductInCartDTOValidatorInterface;
use Raketa\BackendTestTask\Application\DTO\Exception\DTOValidatorException;
use Raketa\BackendTestTask\Application\Service\CartServiceInterface;
use Raketa\BackendTestTask\Infrastructure\View\CartView;

readonly class AddProductInCartController
{
    public function __construct(
        private CartServiceInterface $cartService,
        private CartView $cartView,
        private LoggerInterface $logger,
        private AddProductInCartDTOValidatorInterface $dtoValidator,
    ) {
    }

    public function add(RequestInterface $request): ResponseInterface
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
            $cart = $this->cartService->addProductInCart($dto);
            $response->getBody()->write(
                json_encode(
                    [
                        'cart' => $this->cartView->toArray($cart)
                    ],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                )
            );
        }
        catch (\Exception $e) {
            $status = $e->getCode();
            $ui_message = "Товар не удалось добавить в корзину";
            $this->logger->error("Товар с uuid '{$dto->productUuid}' не удалось добавить в корзину с uuid '{$dto->cartUuid}': " . $e->getMessage());
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
