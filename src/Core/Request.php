<?php
namespace Core;

class Request {
    public static function getJsonBody() {
        return json_decode(file_get_contents('php://input'), true);
    }

    public static function get($key, $default = null) {
        return $_GET[$key] ?? $default;
    }
}
?>
