<?php

function ProductController()
{

  

    handleRequestMethod('put', function () {
        $productModel = new ProductModel();
        $productList = $productModel->getList();
        MainAppLayout(__DIR__ . '/index.php', ['products' => $productList]);
    });

    handleRequestMethod('delete', function ($request) {
        $productModel = new ProductModel();
        $productModel->deleteProduct((int)$request['body']['id']);
        $productList = $productModel->getList();

        MainAppLayout(__DIR__ . '/index.php', ['products' => $productList]);
    });

    handleRequestMethod('get', function () {
        $productModel = new ProductModel();
        $productList = $productModel->getList();
        MainAppLayout(__DIR__ . '/index.php', ['products' => $productList]);
    });
}
