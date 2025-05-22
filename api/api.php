<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rules = [
        'name'  => ['required' => true, 'min' => 3, 'max' => 20],
        'email' => ['required' => true, 'email' => true],
        'age'   => ['required' => true, 'type' => 'number']
    ];

    // $errors = validateProperties($_POST, $rules);

    echo "Hello, $name!";
} else {
    echo "Invalid request method.";
}
