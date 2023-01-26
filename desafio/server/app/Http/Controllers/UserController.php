<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        return User::firstOrCreate(
            [
                'name' => $request->name,
                // 'username' => $request->username,
            ],
            [
                'email' => 'teste@teste.com',
                'password' => 'getnet',
            ]
        )->toArray();
    }

    public function index(UserRequest $request)
    {
        return User::all()->toArray();
    }
}