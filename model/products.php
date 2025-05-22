<?php

class ProductModel
{
    public function __construct() {}

    public function getList(): array
    {
        return query('SELECT * FROM products');
    }

    public function create($data)
    {
        return query(
            'INSERT INTO products (name, description, price, stock, image) VALUES (:name, :description, :price, :stock, :image)',
            [
                ':name' => $data['name'],
                ':description' => $data['description'],
                ':price' => $data['price'],
                ':stock' => $data['stock'],
                ':image'=> $data['image'] ?? null,
            ]
        );
    }

    public function update($id, $data)
    {
        return query(
            'UPDATE products SET name = :name, description = :description, price = :price, stock = :stock WHERE id = :id',
            [
                ':name' => $data['name'],
                ':description' => $data['description'],
                ':price' => $data['price'],
                ':stock' => $data['stock'],
                ':image'=> $data[''],
                ':id' => $id
            ]
        );
    }

    public function getProductById($id)
    {
        return query('SELECT * FROM products WHERE id = :id', [':id' => $id]);
    }

    public function deleteProduct(int $id)
    {
        return query('DELETE FROM products WHERE id = :id', [':id' => $id]);
    }
}
