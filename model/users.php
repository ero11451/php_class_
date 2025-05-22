<?php


class UserModel
{
    // private PDO $db;

    public function __construct() {}

    public function getList(): array
    {
        return query('SELECT * FROM users');
    }

    public function create($data)
    {
        return   query(
            'INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password , :role)',
            [
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':password' => $data['password'],
                ':role' => $data['role']
            ]
        );
    }

    public function update($id, $data)
    {
        return query('UPDATE users SET name = :name WHERE id = :id', [
            'name' => $data['name'],
            'id'   => $id
        ]);
    }

    public function getUserByEmail($email)
    {
        return query('SELECT * FROM users WHERE email = :email', ['email' => $email]);
    }
    public function deleteUser(int $id)
    {
        return query('DELETE FROM users WHERE id = :id', ['id' => $id]);
    }
}
