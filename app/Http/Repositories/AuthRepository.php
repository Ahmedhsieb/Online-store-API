<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use App\Rules\EmailRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthInterface
{
    use ApiResponseTrait;

    public function registry($request)
    {
        $usersExist = User::where('email', $request->email)->doesntExist();

        if ($usersExist){

            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'email' => ['required', new EmailRule()],
                'password' => 'required'
            ]);

            if ($validation->fails()){
                return $this->apiResponse(400, 'Validation Error', $validation->errors());
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->name)
            ]);

            return $this->apiResponse(200, 'User Created Successfully');
        }

        return $this->apiResponse(400, 'User Already Exist');


    }

    public function login($request)
    {
        $validations = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validations->fails())
        {
            return $this->apiResponse(400, 'validation error', $validations->errors());
        }

        $userData = $request->only('email', 'password');

//        dd(auth()->attempt($userData));

        if (Auth::attempt($userData)){
            $user =[
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'password' => Auth::user()->paswword,
            ];
            return $this->apiResponse(200, 'Login Successfully', null, $user);
        }
        return $this->apiResponse(400, 'User not found');


    }
}
