<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function checkAuth()
    {
        $user = auth()->user();
        $data['user'] = $user;
        if ($user) {
            $data['login'] = true;
        }else{
            $data['login'] = false;
        }
        return response()->json($data, 200);
    }
}
