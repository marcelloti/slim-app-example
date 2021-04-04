<?php
namespace SlimExample\Acl\Infra\TokenGenerator\Implementations;

use ReallySimpleJWT\Jwt;
use ReallySimpleJWT\Parse;  
use ReallySimpleJwt\Encoders\EncodeHS256;
use ReallySimpleJWT\Token;
use ReallySimpleJWT\Validate;
use ReallySimpleJWT\Encode;

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
            $jwtObj = new Jwt($token, $secret);
            $parse = new Parse($jwtObj, new Validate(), new Encode());

            if ($parse->parse()->getExpiresIn() <= 0){
                return false;
            }
            
            return true;

        } catch (\Exception $err){
            return false;
        }
    }
}