<?php

namespace App\Http\Controllers;

use App\Https\Resources\User as UserResource;
use App\Model\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function selectUser(Request $request)
    {
        $q = $request->q;
        $users = User::where(function ($query) use ($q) {
            $query->where('email', 'like', '%' . $q . '%');
            $query->orWhere('mobile', 'like', '%' . $q . '%');
        })
            ->where('active', true)
            ->select(['id', 'email', 'mobile'])->take(30)->get();
        return UserResource::collection($users);
    }
}
