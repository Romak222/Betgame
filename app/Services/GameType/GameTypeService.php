<?php

namespace App\Services\GameType;

use App\Models\GameType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GameTypeService
{
    /**
     * DataTable Listing
     */
    public function datatable(): JsonResponse
    {
        $query = GameType::query()->latest();

        return DataTables::eloquent($query)

            ->addIndexColumn()

            ->addColumn('status_badge', function (GameType $gameType) {

                return $gameType->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';

            })

            ->addColumn('action', function (GameType $gameType) {

                return '
                    <a href="' . route('admin.game-types.show', $gameType) . '" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a href="' . route('admin.game-types.edit', $gameType) . '" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button
                        type="button"
                        class="btn btn-danger btn-sm btn-delete"
                        data-id="' . $gameType->id . '">
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
     * Store Game Type
     */
    public function create(array $data): GameType
    {
        return DB::transaction(function () use ($data) {

            return GameType::create([

                'name'        => strtoupper(trim($data['name'])),

                'code'        => strtoupper(trim($data['code'])),

                'description' => $data['description'] ?? null,

                'sort_order'  => $data['sort_order'],

                'is_active'   => $data['is_active'],

                'created_by'  => auth()->id(),

            ]);

        });
    }

    /**
     * Get Game Type
     */
    public function get(GameType $gameType): GameType
    {
        return $gameType;
    }

    /**
     * Update Game Type
     */
    public function update(GameType $gameType, array $data): GameType
    {
        return DB::transaction(function () use ($gameType, $data) {

            $gameType->update([

                'name'        => strtoupper(trim($data['name'])),

                'code'        => strtoupper(trim($data['code'])),

                'description' => $data['description'] ?? null,

                'sort_order'  => $data['sort_order'],

                'is_active'   => $data['is_active'],

                'updated_by'  => auth()->id(),

            ]);

            return $gameType->fresh();

        });
    }

    /**
     * Delete Game Type
     */
    public function delete(GameType $gameType): void
    {
        DB::transaction(function () use ($gameType) {

            $gameType->delete();

        });
    }
}