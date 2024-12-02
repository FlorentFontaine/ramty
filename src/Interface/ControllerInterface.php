<?php

namespace App\Interface;

use Symfony\Component\HttpFoundation\Request;

interface ControllerInterface
{
    public function add(Request $request): void;
}
