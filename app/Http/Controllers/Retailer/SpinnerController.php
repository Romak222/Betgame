<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Retailer;
use App\Services\SpinnerService;
use Exception;
use Illuminate\Http\Request;

class SpinnerController extends Controller
{
    public function __construct(
        protected SpinnerService $spinnerService
    ) {}

    public function index()
    {
        $game = $this->spinnerService->getActiveGame();
        $round = $this->spinnerService->getOpenRound();

        $retailer = Retailer::where('user_id', auth()->id())->first();
        $wallet = $retailer?->wallet;

        return view('retailer.spinner.index', compact('game', 'round', 'retailer', 'wallet'));
    }

    public function placeBet(Request $request)
    {
        $request->validate([
            'bets' => 'required|array|min:1',
            'bets.*.number' => 'required|integer|min:0|max:9',
            'bets.*.amount' => 'required|numeric|min:1',
        ]);

        try {
            $retailer = Retailer::where('user_id', auth()->id())->firstOrFail();

            $result = $this->spinnerService->placeBet($retailer, $request->bets);

            return response()->json([
                'success' => true,
                'message' => 'Bet placed successfully',
                'round_no' => $result['round']->round_no,
                'total_amount' => $result['total_amount'],
                'wallet_balance' => $retailer->wallet?->fresh()?->balance ?? 0,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}