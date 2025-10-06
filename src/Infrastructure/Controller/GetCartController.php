<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Raketa\BackendTestTask\Application\DTO\DTO\GetCartDTO;
use Raketa\BackendTestTask\Application\Service\CartService;
use Raketa\BackendTestTask\Infrastructure\View\CartView;

readonly class GetCartController
{
    public function __construct(
        private CartView $cartView,
        private CartService $cartService,
        private LoggerInterface $logger,
    ) {
    }

    public function get(RequestInterface $request): ResponseInterface
    {
        $response = new JsonResponse();
        $status = 200;
        $rawRequest = json_decode($request->getBody()->getContents(), true);

        try {
            // Не стал тратить время и создавать класс валидатора для DTO и т.д.
            // По условию этого задания предполагается, что всё это уже есть в реальном проекте
            // Предположим, что здесь должна быть логика валидации массива для создания DTO
            // ...
            $dto = new GetCartDTO($rawRequest['cartUuid'] ?? null);
            // Предположим, что здесь должна быть логика валидации самого $dto
            // ...

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
            $this->logger->error("Не удалось получить данные из корзины с uuid '{$rawRequest['cartUuid']}': " . $e->getMessage());
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
