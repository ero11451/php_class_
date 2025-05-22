<?php

// function basePath($path)
// {
//     return dirname(__DIR__) . '/' . $path;
// }


function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateProperties(array $data, array $rules): array
{
    $errors = [];

    foreach ($rules as $field => $fieldRules) {
        $value = $data[$field] ?? null;

        foreach ($fieldRules as $rule => $ruleValue) {
            switch ($rule) {
                case 'required':
                    if ($ruleValue && empty($value)) {
                        $errors[$field][] = "$field is required.";
                    }
                    break;

                case 'min':
                    if (strlen($value) <= $ruleValue) {
                        $errors[$field][] = "$field must be at least $ruleValue characters.";
                    }
                    break;

                case 'max':
                    if (strlen($value) > $ruleValue) {
                        $errors[$field][] = "$field must be less than $ruleValue characters.";
                    }
                    break;

                case 'email':
                    if ($ruleValue && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$field][] = "$field must be a valid email.";
                    }
                    break;

                case 'type':
                    if ($ruleValue === 'number' && !is_numeric($value)) {
                        $errors[$field][] = "$field must be a number.";
                    }
                    break;

                    // Add more rules here as needed
            }
        }
    }

    return $errors;
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function basePath($path)
{
    return dirname(__DIR__) . '/' . $path;
}

function loadView($viewPath, $data = [])
{
    if (file_exists($viewPath)) {
        htmlspecialchars(extract($data));

        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        </head>
        <body>
        ';

        include $viewPath;

        echo '
        </body>
        </html>';
    } else {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Not Found</title>
        </head>
        <body>
            <h1>Error: View not found</h1>
            <p>' . htmlspecialchars($viewPath) . ' does not exist.</p>
        </body>
        </html>';
    }
}


function loadComponent($name, $data = [])
{

    $viewPath = basePath("views/component/{$name}.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo 'Component' . $name . ' does not exist';
    }
}

function print_data($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function format_date($data_string, $format = 'Y-m-d')
{

    $timestamp = strtotime($data_string);

    return date($format, $timestamp);
}

function limitString($string, $maxCount)
{

    if (strlen($string) > $maxCount) {
        $shortenedString = substr($string, 0, $maxCount) . "...";
    } else {
        $shortenedString = $string;
    }
    return $shortenedString;
}

function apiResponse($status = true, $message = '', $data = [], $code = 200)
{
    http_response_code($code);

    header('Content-Type: application/json');

    echo json_encode([
        'status'  => $status,
        'message' => $message,
        'data'    => $data
    ]);
    exit; // Stop further execution
}

function handleRequestMethod(string $method, callable $callback)
{
    $actualMethod = $_SERVER['REQUEST_METHOD'];

    // Support _method override for POST requests (common in HTML forms)
    if ($actualMethod === 'POST' && !empty($_POST['method'])) {
        $actualMethod = strtoupper($_POST['method']);
    }

    if (strtoupper($actualMethod) !== strtoupper($method)) {
        return;
    }

    // Collect request data
    $params = $_GET;
    $files  = $_FILES ?? null;

    // Parse body (JSON or form data)
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (stripos($contentType, 'application/json') !== false) {
        $body = json_decode(file_get_contents("php://input"), true);
    } else {
        $body = $_POST;
    }

    // Call the callback with structured request data
    $callback([
        'params' => $params,
        'file'   => !empty($files) ? $files : null,
        'body'   => $body,
    ]);

    exit; // Prevent further code execution
}

