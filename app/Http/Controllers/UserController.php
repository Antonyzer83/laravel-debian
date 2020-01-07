<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            ['antony', 'castaner', 'antony@mail.fr', 'bio']
        ];

        return view('user.index', ['users' => $data]);
    }
}
