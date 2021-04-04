<?php

namespace SlimExample\Acl\Infra\TokenGenerator;

class TokenGeneratorLib {
    protected static $generatorClass = "SlimExample\\Acl\\Infra\\TokenGenerator\\Implementations\\ReallySimpleJwt";

    public static function generate(string $userId, string $secret, string $expiration = null, string $issuer = null): string {
        $generator = new TokenGeneratorLib::$generatorClass();

        $token = $generator->generate($userId, $secret, $expiration, $issuer);

        return $token;
    }

    public static function validate(string $token, string $secret): bool {
        $generator = new TokenGeneratorLib::$generatorClass();

        $token = $generator->validate($token, $secret);

        return $token;
    }
}