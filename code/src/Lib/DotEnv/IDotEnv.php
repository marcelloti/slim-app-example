<?php

namespace SlimExample\Lib\DotEnv;

interface IDotEnv {
    public function get(string $envVar): string;
}