<?php

namespace App\Services\GameRound;

use App\Models\Game;
use App\Models\GameRound;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Result;
use App\Services\Bet\WinnerService;
class GameRoundService
{
    /**
     * DataTable
     */
    public function datatable()
    {
        return DataTables::eloquent(

            GameRound::query()
        ->with('game')
        ->orderByDesc('id')
        

        )

        ->addIndexColumn()

        ->addColumn('game', function ($row) {

            return $row->game->name;

        })

        ->addColumn('status_badge', function ($row) {

            switch ($row->status) {

                case 'OPEN':
                    return '<span class="badge bg-success">OPEN</span>';

                case 'CLOSED':
                    return '<span class="badge bg-warning">CLOSED</span>';

                default:
                    return '<span class="badge bg-danger">RESULT</span>';
            }

        })
        ->editColumn('result', function ($row) {

    return $row->result ?? '-';

})

        ->addColumn('action', function ($row) {

        $buttons = '';

        // OPEN Round
        if ($row->status === 'OPEN') {

    $buttons .= '

    <button
        class="btn btn-warning btn-sm btn-close-round"
        data-id="'.$row->id.'">

        <i class="fas fa-lock"></i>

        Close

    </button>

    ';

}

        // CLOSED Round
        elseif ($row->status === 'CLOSED') {

            $buttons .= '

            <button
                class="btn btn-success btn-sm btn-result"
                data-id="'.$row->id.'">

                <i class="fas fa-trophy"></i>

                Declare Result

            </button>

            ';

    }

  // RESULT Round
elseif ($row->status === 'RESULT') {

    $buttons .= '

    <span class="badge bg-success">

        Completed

    </span>

    ';

}

$buttons .= '

<button
    class="btn btn-danger btn-sm btn-delete"
    data-id="'.$row->id.'">

    <i class="fas fa-trash"></i>

</button>

';

return $buttons;

})
        ->editColumn('start_time', function ($row) {

            return $row->start_time->format('d-m-Y H:i');

        })

        ->editColumn('end_time', function ($row) {

            return $row->end_time->format('d-m-Y H:i');

        })

        ->rawColumns([
            'status_badge',
            'action'
        ])

        ->make(true);

    }

    /**
     * Create Round
     */
 public function create(Game $game)
{
    return DB::transaction(function () use ($game) {

        $openRound = GameRound::where('game_id', $game->id)
            ->where('status', 'OPEN')
            ->first();

        if ($openRound) {
            throw new \Exception('An open round already exists for this game.');
        }

        return GameRound::create([

            'game_id'     => $game->id,

            'round_no'    => now()->format('YmdHis'),

            'start_time'  => now(),

            'end_time'    => now()->addMinutes($game->round_duration),

            'status'      => 'OPEN',

        ]);

    });
}


/**
 * Close Round
 */
public function close(GameRound $round)
{
    if ($round->status !== 'OPEN') {

        throw new \Exception(
            'Only OPEN rounds can be closed.'
        );

    }

    $round->update([

        'status' => 'CLOSED',

    ]);

    return $round;
}

/**
 * Declare Result
 */
public function declareResult(
    GameRound $round,
    int $result
)
{
    if ($round->status !== 'CLOSED') {

        throw new \Exception(
            'Only CLOSED rounds can declare result.'
        );

    }

    return DB::transaction(function () use ($round, $result) {

        // Update round
        $round->update([

            'status'             => 'RESULT',

            'result'             => $result,

            'result_declared_at' => now(),

            'declared_by'        => auth()->id(),

        ]);

        // Save Result History
        Result::create([

            'game_round_id' => $round->id,

            'winning_value' => $result,

        ]);
        $this->winnerService->process($round);

        return $round;

    });

}


public function __construct(
    protected WinnerService $winnerService
) {}

}