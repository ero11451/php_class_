<?php

function ProductDetailsController()
{
    handleRequestMethod('get', function ($request) {

        $productID =  $request['params']['id'];

        if (empty($productID)) {
            MainAppLayout(__DIR__ . '/view.php', ['data' => [['Product creation failed']]]);
        } else {
            $productModel = new ProductModel();

            $productList =  $productModel->getProductById($productID)[0] ?? [];

            MainAppLayout(__DIR__ . '/view.php', ['data' => $productList]);
        }
    });
}