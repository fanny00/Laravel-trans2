<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class IngresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(User $user)
    {
        // dd($user->username);
        return view('ingresos', [
            'user' => $user
        ]);
    }
}