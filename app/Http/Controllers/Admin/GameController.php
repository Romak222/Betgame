<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGameRequest;
use App\Http\Requests\Admin\UpdateGameRequest;
use App\Models\Game;
use App\Models\GameType;
use App\Services\Game\GameService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    protected GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Listing Page
     */
    public function index(): View
    {
        return view('admin.games.index');
    }

    /**
     * DataTable
     */
    public function datatable(): JsonResponse
    {
        return $this->gameService->datatable();
    }

    /**
     * Create Page
     */
    public function create(): View
    {
        $gameTypes = GameType::active()
            ->orderBy('sort_order')
            ->get();

        return view('admin.games.create', compact('gameTypes'));
    }

    /**
     * Store
     */
    public function store(StoreGameRequest $request): RedirectResponse
    {
        $this->gameService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Game created successfully.');
    }

    /**
     * Show
     */
    public function show(Game $game): View
    {
        $game = $this->gameService->get($game);

        return view('admin.games.show', compact('game'));
    }

    /**
     * Edit
     */
    public function edit(Game $game): View
    {
        $gameTypes = GameType::active()
            ->orderBy('sort_order')
            ->get();

        return view('admin.games.edit', compact(
            'game',
            'gameTypes'
        ));
    }

    /**
     * Update
     */
    public function update(
        UpdateGameRequest $request,
        Game $game
    ): RedirectResponse {

        $this->gameService->update(
            $game,
            $request->validated()
        );

        return redirect()
            ->route('admin.games.index')
            ->with('success', 'Game updated successfully.');

    }

    /**
     * Delete
     */
    public function destroy(Game $game): JsonResponse
    {
        try {

            $this->gameService->delete($game);

            return response()->json([
                'success' => true,
                'message' => 'Game deleted successfully.'
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }
}