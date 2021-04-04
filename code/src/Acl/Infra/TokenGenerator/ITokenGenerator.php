<?php

namespace SlimExample\Acl\Infra\TokenGenerator;

interface ITokenGenerator {
    function generate(string $userId, string $secret, string $expiration = null, string $issuer = null): string;
    function validate(string $token, string $secret): bool;
}