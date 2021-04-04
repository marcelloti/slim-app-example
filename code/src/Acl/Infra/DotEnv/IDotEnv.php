<?php

namespace SlimExample\Acl\Infra\DotEnv;

interface IDotEnv {
    public function get(string $envVar, string $env): string;
}