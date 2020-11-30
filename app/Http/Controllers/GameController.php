<?php

namespace App\Http\Controllers;

use Exception;
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
        // Use the auth middleware to authenticate all requests in this controller
		$this->middleware('auth');
	}

	/**
     * Returns a list containing the user's previous games.
     */
	public function getPlayerHistory(Request $request)
	{
		try {
			$player = $request->input('player');

			$result = DB::table('games')->where('player', $player)->get();

			if (sizeof($result) < 1) {
				throw new Exception("This player hasn't played any games yet.", 1);
			}

			return response()->json(['games' => $result], 200);
		} catch (\Exception $ex) {
			return response($ex->getMessage(), 400);
		}
	}

	/**
     * Saves a game in the database.
     */
	public function saveGame(Request $request)
	{
		try {
			$player = $request->input('player');
			$flipCount = $request->input('flip_count');

			DB::table('games')->insert(
				[
					'player' => $player,
					'flip_count' => $flipCount,
					'inserted_at' => date('Y-m-d H:i:s')
				]
			);

			return response(null, 201);
		} catch (\Exception $ex) {
			return response($ex->getMessage(), 400);
		}
	}
}
