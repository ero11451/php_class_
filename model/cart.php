<?php

class CartModel
{
    public function __construct() {}

    // Get a cart by user ID
    public function getCartByUserId(int $userId)
    {
        $carts = query('SELECT * FROM carts WHERE user_id = :user_id', [
            ':user_id' => $userId
        ]);

        return $carts[0] ?? null;
    }

    // Create a cart for a user
    public function createCart(int $userId)
    {
        return query('INSERT INTO carts (user_id) VALUES (:user_id)', [
            ':user_id' => $userId
        ]);
    }

    // Add item to cart (insert or update quantity if already exists)
    public function addItem(int $cartId, int $productId, int $quantity = 1)
    {
        // Check if item exists
        $existing = query('SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id', [
            ':cart_id' => $cartId,
            ':product_id' => $productId
        ]);

        if (!empty($existing)) {
            // Update quantity
            return query(
                'UPDATE cart_items SET quantity = quantity + :quantity WHERE cart_id = :cart_id AND product_id = :product_id',
                [
                    ':quantity' => $quantity,
                    ':cart_id' => $cartId,
                    ':product_id' => $productId
                ]
            );
        }

        // Insert new item
        return query(
            'INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)',
            [
                ':cart_id' => $cartId,
                ':product_id' => $productId,
                ':quantity' => $quantity
            ]
        );
    }

    // Get all items in a cart
    public function getCartItems(int $cartId)
    {
        return query(
            'SELECT ci.*, p.name, p.price FROM cart_items ci 
             JOIN products p ON ci.product_id = p.id 
             WHERE ci.cart_id = :cart_id',
            [':cart_id' => $cartId]
        );
    }

    // Remove an item from the cart
    public function removeItem(int $cartId, int $productId)
    {
        return query('DELETE FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id', [
            ':cart_id' => $cartId,
            ':product_id' => $productId
        ]);
    }

    // Clear all items from the cart
    public function clearCart(int $cartId)
    {
        return query('DELETE FROM cart_items WHERE cart_id = :cart_id', [
            ':cart_id' => $cartId
        ]);
    }
}
