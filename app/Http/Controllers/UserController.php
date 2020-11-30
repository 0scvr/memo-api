<?php

namespace App\Http\Controllers;

use Exception;
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
     * Creates a new player in the database and returns an API key.
     */
    public function register(Request $request)
    {
        try {
            $username = $request->input('username');
            $password = $request->input('password');
            $apiKey = parent::generateApiKey();
            
            DB::table('players')->insert(
                ['username' => $username, 'password' => $password, 'api_key' => $apiKey]
            );

            return response()->json(['api_key' => $apiKey], 201);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }

    /**
     * Checks a Player's credentials and returns his api key if valid.
     */
    public function login(Request $request)
    {
        try {
            $username = $request->input('username');
            $password = $request->input('password');

            $result = DB::table('players')->where([
                ['username', '=', $username],
                ['password', '=', $password],
            ])->get();

            if (sizeof($result) != 1) {
                throw new Exception("Wrong credentials!", 1);
            }
    
            // Returns the player's API key
            return response()->json(['api_key' => $result[0]->api_key], 200);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }
}
