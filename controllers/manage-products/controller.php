<?php

function ManageUsersController()
{
    handleRequestMethod('post', function ($request) {
        $rules = [
            'name'        => ['required' => true,],
            'description' => ['required' => true, 'min' => 5],
            'price'       => ['required' => true, 'type' => 'number'],
            'stock'       => ['required' => true, 'type' => 'number'],
        ];

        $errors = validateProperties($request['body'], $rules);


        $file = $request['file']['file'] ?? null; // input name="file"
        $uploadDir = dirname(__DIR__, 2) . '/uploads/';
        $filePath = null;

        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('product_', true) . '.' . $extension;
            $targetPath = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $filePath = 'uploads/' . $newFileName; // relative path for storage
                $request['body']['image'] = $filePath; // attach to product data
            } else {
                $errors['file'] = ['Failed to save uploaded file'];
            }
        } else {
            $errors['file'] = ['Product image is required'];
        }

        if (!empty($errors)) {
            AdminLayout(__DIR__ . '/view.php', ['data' => [$errors, ['Product creation failed']]]);
            header('Location: /manage-products');
        } else {

            $productModel = new ProductModel();
            $productModel->create($request['body']);
            $productList = $productModel->getList();
            AdminLayout(__DIR__ . '/view.php', ['products' => $productList ?? []]);
        }
    });

    handleRequestMethod('put', function () {
        $productModel = new ProductModel();
        $productList = $productModel->getList();
        AdminLayout(__DIR__ . '/view.php', ['products' => $productList]);
    });


    handleRequestMethod('delete', function ($request) {
        $productModel = new ProductModel();
        $productId = (int) $request['body']['id'];

        // Step 1: Get product info before deletion
        $product = $productModel->getProductById($productId)[0]; // Assumes this method returns product by ID

        // Step 2: Delete associated image file if it exists
        if (!empty($product['image'])) {
            $filePath = dirname(__DIR__, 2) .  '/' . $product['image'];
            if (file_exists($filePath)) {
                unlink($filePath); // Remove file
            }
        }

        // Step 3: Delete product
        $productModel->deleteProduct($productId);

        // Step 4: Load updated view
        $productList = $productModel->getList() ?? [];
        AdminLayout(__DIR__ . '/view.php', ['products' => $productList]);
    });


    handleRequestMethod('get', function () {
        $productModel = new ProductModel();
        $productList = $productModel->getList() ?? [];
        AdminLayout(__DIR__ . '/view.php', ['products' => $productList]);
    });
}
