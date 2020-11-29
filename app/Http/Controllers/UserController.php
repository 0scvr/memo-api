<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Creates a new player in the database.
     */
    public function register(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        try {
            DB::table('players')->insert(
                ['username' => $username, 'password' => $password]
            );

            return response(null, 201);
        }
        catch (Exception $e) {
            return response(null, 400);
        }
    }

    /**
     * 
     */
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = DB::table('players')->where([
            ['username', '=', $username],
            ['password', '=', $password],
        ])->get();

        // If wrong credentials send an error
        if (sizeof($result) != 1) {
            return response(null, 400);
        }

        // TODO: send token?
        return response($result, 200);
    }
}
