<?php
namespace App\Http\Controllers;

use Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
}
}
