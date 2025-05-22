<?php

function CartController()
{
    // Add item to cart (or create cart if not exists)
    handleRequestMethod('post', function ($request) {
        $rules = [
            'user_id'    => ['required' => true, 'type' => 'number'],
            'product_id' => ['required' => true, 'type' => 'number'],
            'quantity'   => ['required' => false, 'type' => 'number'],
        ];

        $errors = validateProperties($request['body'], $rules);

        if (!empty($errors)) {
            loadView(__DIR__ . '/view.php', ['data' => [$errors, ['Failed to add to cart']]]);
            return;
        }

        $userId    = (int)$request['body']['user_id'];
        $productId = (int)$request['body']['product_id'];
        $quantity  = isset($request['body']['quantity']) ? (int)$request['body']['quantity'] : 1;

        $cartModel = new CartModel();
        $cart = $cartModel->getCartByUserId($userId);

        if (!$cart) {
            $cartModel->createCart($userId);
            $cart = $cartModel->getCartByUserId($userId); // refetch
        }

        $cartModel->addItem($cart['id'], $productId, $quantity);
        $cartItems = $cartModel->getCartItems($cart['id']);

        loadView(__DIR__ . '/view.php', ['cartItems' => $cartItems]);
    });

    // Get cart items
    handleRequestMethod('get', function ($request) {
        if (empty($request['params']['user_id'])) {
            loadView(__DIR__ . '/cart.php', ['data' => [['User ID is required']]]);
            return;
        }

        $userId = (int)$request['params']['user_id'];

        $cartModel = new CartModel();
        $cart = $cartModel->getCartByUserId($userId);

        $cartItems = $cart ? $cartModel->getCartItems($cart['id']) : [];
        loadView(__DIR__ . '/view.php', ['cartItems' => $cartItems]);
    });

    // Remove a single item from the cart
    handleRequestMethod('delete', function ($request) {
        $rules = [
            'user_id'    => ['required' => true, 'type' => 'number'],
            'product_id' => ['required' => true, 'type' => 'number'],
        ];

        $errors = validateProperties($request['body'], $rules);
        if (!empty($errors)) {
            loadView(__DIR__ . '/view.php', ['data' => [$errors, ['Failed to remove item']]]);
            return;
        }

        $userId    = (int)$request['body']['user_id'];
        $productId = (int)$request['body']['product_id'];

        $cartModel = new CartModel();
        $cart = $cartModel->getCartByUserId($userId);

        if ($cart) {
            $cartModel->removeItem($cart['id'], $productId);
            $cartItems = $cartModel->getCartItems($cart['id']);
        } else {
            $cartItems = [];
        }

        loadView(__DIR__ . '/view.php', ['cartItems' => $cartItems]);
    });

    // Clear entire cart
    handleRequestMethod('put', function ($request) {
        if (empty($request['body']['user_id'])) {
            loadView(__DIR__ . '/cart.php', ['data' => [['User ID is required to clear cart']]]);
            return;
        }

        $userId = (int)$request['body']['user_id'];
        $cartModel = new CartModel();
        $cart = $cartModel->getCartByUserId($userId);

        if ($cart) {
            $cartModel->clearCart($cart['id']);
        }

        loadView(__DIR__ . '/view.php', ['cartItems' => []]);
    });
}
