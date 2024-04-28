<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Role;
use App\Models\User;

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
        $roles = Role::all()->where('state', '1')->count();
        $users = User::all()->where('state', '1')->count();
        $levels = Level::all()->where('state', '1')->count();
        return view('home', compact('roles','users', 'levels'));
    }
}
