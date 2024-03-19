<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $AuthInterface;
    public function __construct(AuthInterface $AuthInterface)
    {
        $this->AuthInterface = $AuthInterface;
    }

    public function register(Request $request)
    {
        return $this->AuthInterface->registry($request);
    }

    public function login(Request $request)
    {
        return $this->AuthInterface->login($request);

    }

    //
}
