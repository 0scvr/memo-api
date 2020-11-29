<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{

     /**
     * Instantiate a new GameController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // put middleware to use here
        // $this->middleware('auth');
    }

    /**
     * Returns a list containing the user's previous games.
     */
    public function getPlayerHistory($player)
    {
        $result = DB::table('games')->where('player', $player)->get();

        // If the player doesn't exist or hasn't played any games send an error
        if (sizeof($result) < 1) {
            return response(null, 400);
        }

        return response()->json(['games' => $result], 200);
    }

    /**
     * Saves a game in the database.
     */
    public function saveGame(Request $request)
    {
        $player = $request->input('player');
        $flipCount = $request->input('flip_count');

        try {
            DB::table('games')->insert(
                ['player' => $player,
                'flip_count' => $flipCount,
                'inserted_at' => date('Y-m-d H:i:s')]
            );

            return response(null, 201);
        }
        catch (Exception $e) {
            return response(null, 400);
        }
    }
}
