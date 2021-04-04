<?php
namespace SlimExample\Acl\Infra\TokenGenerator\Implementations;

use ReallySimpleJWT\Token;
use SlimExample\Acl\Infra\TokenGenerator\ITokenGenerator;

class ReallySimpleJwt implements ITokenGenerator {
    public function generate(string $userId, string $secret, string $expiration = null, string $issuer = null): string {
        if ($expiration === null){
            $expiration = time() + 3600;
        }
        if ($issuer === null){
            $issuer = 'localhost';
        }

        return Token::create($userId, $secret, $expiration, $issuer);
    }

    public function validate(string $token, string $secret): bool {
        try{
            $validation = Token::validate($token, $secret);
            return $validation;
        } catch (\Exception $err){
            return false;
        }
    }
}