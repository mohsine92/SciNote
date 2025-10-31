<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Charge Composer et firebase/php-jwt

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler {
    private static $secret_key = "SCINOTE_SECRET_KEY"; // Change si tu veux
    private static $algo = 'HS256';

    /**
     * Crée un token JWT à partir de l'id, email et rôle
     */
    public static function createToken($id, $email, $role) {
        $payload = [
            'iss' => 'SciNote',          // Émetteur
            'iat' => time(),             // Timestamp de création
            'exp' => time() + 3600,      // Expiration dans 1h
            'data' => [
                'id' => $id,
                'email' => $email,
                'role' => $role
            ]
        ];

        return JWT::encode($payload, self::$secret_key, self::$algo);
    }

    /**
     * Valide un token JWT et retourne les données de l'utilisateur
     */
    public static function validateToken($jwt) {
        if (!$jwt) return false;

        try {
            $decoded = JWT::decode($jwt, new Key(self::$secret_key, self::$algo));
            return (array)$decoded->data; // Retourne id, email, role
        } catch (Exception $e) {
            return false; // Token invalide ou expiré
        }
    }
}