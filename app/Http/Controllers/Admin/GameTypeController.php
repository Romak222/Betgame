<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGameTypeRequest;
use App\Http\Requests\Admin\UpdateGameTypeRequest;
use App\Models\GameType;
use App\Services\GameType\GameTypeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class GameTypeController extends Controller
{
    /**
     * Game Type Service
     */
    protected GameTypeService $gameTypeService;

    /**
     * Constructor
     */
    public function __construct(GameTypeService $gameTypeService)
    {
        $this->gameTypeService = $gameTypeService;
    }

    /**
     * Listing Page
     */
    public function index(): View
    {
        return view('admin.game-types.index');
    }

    /**
     * AJAX DataTable
     */
    public function datatable(): JsonResponse
    {
        return $this->gameTypeService->datatable();
    }

    /**
     * Create Form
     */
    public function create(): View
    {
        return view('admin.game-types.create');
    }

    /**
     * Store Game Type
     */
    public function store(StoreGameTypeRequest $request): RedirectResponse
    {
        $this->gameTypeService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.game-types.index')
            ->with('success', 'Game Type created successfully.');
    }

    /**
     * Show Details
     */
    public function show(GameType $gameType): View
    {
        $gameType = $this->gameTypeService->get($gameType);

        return view('admin.game-types.show', compact('gameType'));
    }

    /**
     * Edit Form
     */
    public function edit(GameType $gameType): View
    {
        return view('admin.game-types.edit', compact('gameType'));
    }

    /**
     * Update Game Type
     */
    public function update(
        UpdateGameTypeRequest $request,
        GameType $gameType
    ): RedirectResponse {

        $this->gameTypeService->update(
            $gameType,
            $request->validated()
        );

        return redirect()
            ->route('admin.game-types.index')
            ->with('success', 'Game Type updated successfully.');
    }

    /**
     * Delete Game Type
     */
public function destroy(GameType $gameType): JsonResponse
{
    try {

        $this->gameTypeService->delete($gameType);

        return response()->json([
            'success' => true,
            'message' => 'Game Type deleted successfully.'
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);

    }
}
}