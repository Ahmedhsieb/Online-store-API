<?php

namespace App\Http\Interfaces;

interface AuthInterface
{

    public function registry($request);
    public function login($request);

}
