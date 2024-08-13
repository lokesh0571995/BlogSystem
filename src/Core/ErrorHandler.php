<?php
namespace Core;

use Exception;

class ErrorHandler {
    public static function handleException(Exception $e) {
        error_log($e->getMessage(), 3, __DIR__ . '/../../logs/error.log');
        Response::error('Internal Server Error', 500);
    }
}

// Set the global exception handler
set_exception_handler([ErrorHandler::class, 'handleException']);
?>
