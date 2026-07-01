<?php

namespace App\Services\Game;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GameService
{
    /**
     * DataTable
     */
    public function datatable(): JsonResponse
    {
        $query = Game::with('gameType')
            ->latest();

        return DataTables::eloquent($query)

            ->addIndexColumn()

            ->addColumn('game_type', function (Game $game) {
                return $game->gameType?->name;
            })

            ->addColumn('status_badge', function (Game $game) {

                return $game->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';

            })

            ->addColumn('action', function (Game $game) {

                return '

                    <a href="'.route('admin.games.show',$game).'"
                       class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a href="'.route('admin.games.edit',$game).'"
                       class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button
                        class="btn btn-danger btn-sm btn-delete"
                        data-id="'.$game->id.'">

                        <i class="fas fa-trash"></i>

                    </button>

                ';

            })

            ->rawColumns([
                'status_badge',
                'action'
            ])

            ->make(true);
    }

    /**
     * Store
     */
    public function create(array $data): Game
    {
        return DB::transaction(function () use ($data) {

            return Game::create([

                'game_type_id' => $data['game_type_id'],

                'name' => strtoupper(trim($data['name'])),

                'code' => strtoupper(trim($data['code'])),

                'open_time' => $data['open_time'],

                'close_time' => $data['close_time'],

                'result_time' => $data['result_time'],

                'round_duration' => $data['round_duration'],

                'min_bid' => $data['min_bid'],

                'max_bid' => $data['max_bid'],

                'sort_order' => $data['sort_order'],

                'is_active' => $data['is_active'],

                'created_by' => auth()->id(),

            ]);

        });
    }

    /**
     * Find
     */
    public function get(Game $game): Game
    {
        return $game->load('gameType');
    }

    /**
     * Update
     */
    public function update(Game $game, array $data): Game
    {
        DB::transaction(function () use ($game, $data) {

            $game->update([

                'game_type_id' => $data['game_type_id'],

                'name' => strtoupper(trim($data['name'])),

                'code' => strtoupper(trim($data['code'])),

                'open_time' => $data['open_time'],

                'close_time' => $data['close_time'],

                'result_time' => $data['result_time'],

                'min_bid' => $data['min_bid'],

                'max_bid' => $data['max_bid'],

                'sort_order' => $data['sort_order'],

                'is_active' => $data['is_active'],

                'updated_by' => auth()->id(),

            ]);

        });

        return $game->fresh();
    }

    /**
     * Delete
     */
    public function delete(Game $game): void
    {
        DB::transaction(function () use ($game) {

            $game->delete();

        });
    }
}