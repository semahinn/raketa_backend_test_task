<?php

namespace Raketa\BackendTestTask\Infrastructure\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Raketa\BackendTestTask\Application\DTO\DTO\AddProductInCartDTO;
use Raketa\BackendTestTask\Application\Service\CartService;
use Raketa\BackendTestTask\Infrastructure\View\CartView;

readonly class AddToCartController
{
    public function __construct(
        private CartService $cartService,
        private CartView $cartView,
        private LoggerInterface $logger,
    ) {
    }

    public function add(RequestInterface $request): ResponseInterface
    {
        $response = new JsonResponse();
        $status = 200;
        $rawRequest = json_decode($request->getBody()->getContents(), true);

        try {
            // Не стал тратить время и создавать класс валидатора для DTO и т.д.
            // По условию этого задания предполагается, что всё это уже есть в реальном проекте
            // Предположим, что здесь должна быть логика валидации массива для создания DTO
            // ...
            $dto = new AddProductInCartDTO($rawRequest['productUuid'], $rawRequest['cartUuid'], $rawRequest['quantity']);
            // Предположим, что здесь должна быть логика валидации самого $dto
            // ...

            $cart = $this->cartService->addProductInCart($dto);
            // $this->logger->info("Товар с uuid '{$dto->productUuid}' был успешно добавлен в корзину с uuid '{$dto->cartUuid}'");
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
            $this->logger->error("Товар с uuid '{$rawRequest['productUuid']}' не удалось добавить в корзину с uuid '{$rawRequest['cartUuid']}': " . $e->getMessage());
            $response->getBody()->write(
                json_encode(
                    [
                        'message' => $e->getMessage()
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
