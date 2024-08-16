<?php

namespace App\Utils;

class HttpResponse
{
    private static function sendResponse(int $statusCode, array $data): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    public static function added(): void
    {
        self::sendResponse(201, ['message' => 'Product added successfully.']);
    }

    public static function dbError(string $message): void
    {
        self::sendResponse(500, ['error' => $message]);
    }
    public static function validationError(string $message): void
    {
        self::sendResponse(400, ['error' => $message]);
    }
}
