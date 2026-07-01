<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameRound;
use App\Services\GameRound\GameRoundService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GameRoundController extends Controller
{
    public function __construct(
        protected GameRoundService $service
    ) {}

    public function index()
    {
        $games = Game::orderBy('name')->get();

        return view(
            'admin.rounds.index',
            compact('games')
        );
    }

    public function datatable()
    {
        return $this->service->datatable();
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => ['required', 'exists:games,id']
        ]);

        try {

            $game = Game::findOrFail($request->game_id);

            $this->service->create($game);

            return response()->json([
                'success' => true,
                'message' => 'Round created successfully.'
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function destroy(GameRound $round): JsonResponse
    {
        $round->delete();

        return response()->json([
            'success' => true,
            'message' => 'Round deleted successfully.'
        ]);
    }

        public function close(GameRound $round)
    {
        try {

            $this->service->close($round);

            return response()->json([

                'success' => true,

                'message' => 'Round closed successfully.'

            ]);

        } catch (\Throwable $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ],500);

        }
    }

    public function declareResult(Request $request, GameRound $round)
{
    $request->validate([

        'result' => [
            'required',
            'integer',
            'between:0,9'
        ]

    ]);

    try {

        $this->service->declareResult(
            $round,
            $request->result
        );

        return response()->json([

            'success' => true,

            'message' => 'Result declared successfully.'

        ]);

    } catch (\Throwable $e) {

        return response()->json([

            'success' => false,

            'message' => $e->getMessage()

        ],500);

    }
}
}