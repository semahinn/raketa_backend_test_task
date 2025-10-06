<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Raketa\BackendTestTask\Application\DTO\DTOValidator\GetCartDTOValidatorInterface;
use Raketa\BackendTestTask\Application\DTO\Exception\DTOValidatorException;
use Raketa\BackendTestTask\Application\Service\CartServiceInterface;
use Raketa\BackendTestTask\Infrastructure\View\CartView;

readonly class GetCartController
{
    public function __construct(
        private CartView $cartView,
        private CartServiceInterface $cartService,
        private LoggerInterface $logger,
        private GetCartDTOValidatorInterface $dtoValidator,
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

        if ($dto) {
            try {
                $cart = $this->cartService->getCartByUuid($dto);
                $response->getBody()->write(
                    json_encode(
                        [
                            'cart' => $this->cartView->toArray($cart),
                        ],
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                    )
                );
            }
            catch (\Exception $e) {
                $status = $e->getCode();
                $ui_message = "Не удалось получить данные из корзины";
                $this->logger->error("Не удалось получить данные из корзины с uuid '{$dto->cartUuid}': " . $e->getMessage());
                $response->getBody()->write(
                    json_encode(
                        [
                            'message' => $ui_message
                        ],
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                    )
                );
            }
        }

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus($status);
    }
}
