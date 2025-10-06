<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\Application\Service\ProductService;
use Raketa\BackendTestTask\Infrastructure\View\CartView;
use Raketa\BackendTestTask\Infrastructure\View\ProductsView;

readonly class GetProductsController
{
    public function __construct(
        private ProductService $productsService,
        private ProductsView $productsView,
    ) {
    }

    public function get(RequestInterface $request): ResponseInterface
    {
        $response = new JsonResponse();
        $rawRequest = json_decode($request->getBody()->getContents(), true);

        $products = $this->productsService->getProductsByCategory($rawRequest['category']);

        $response->getBody()->write(
            json_encode(
                [
                  'products' => $this->productsView->toArray($products),
                ],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            )
        );

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus(200);
    }
}
