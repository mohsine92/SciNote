<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler {
    private static $secret_key = "SCINOTE_SECRET_KEY"; // change si tu veux
    private static $algo = 'HS256';

    public static function createToken($userData) {
        $payload = [
            'iss' => 'SciNote',
            'iat' => time(),
            'exp' => time() + 3600, // 1h
            'data' => $userData
        ];
        return JWT::encode($payload, self::$secret_key, self::$algo);
    }

    public static function validateToken($token) {
        try {
            $decoded = JWT::decode($token, new Key(self::$secret_key, self::$algo));
            return $decoded->data;
        } catch (Exception $e) {
            return false;
        }
    }
}