<?php

namespace App;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService {
    private static string $secret = 'super-secret-key';

    public static function generate(array $payload, int $expiresIn = 3600): string {
        $payload['exp'] = time() + $expiresIn;
        return JWT::encode($payload, self::$secret, 'HS256');
    }

    public static function validate(string $token): object|false {
        try {
            return JWT::decode($token, new Key(self::$secret, 'HS256'));
        } catch (\Exception $e) {
            return false;
        }
    }
}
