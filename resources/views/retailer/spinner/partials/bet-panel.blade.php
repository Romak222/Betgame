<div class="bet-panel">

    <div class="panel-header">
        <h4>Select Number</h4>
    </div>

    <div class="number-grid">
        @for($i = 0; $i <= 9; $i++)
            <div class="number-card" data-number="{{ $i }}">
                <div class="number-value">{{ $i }}</div>
                <div class="number-total">₹0</div>
            </div>
        @endfor
    </div>

    <div class="panel-header" style="margin-top:20px;">
        <h4>Select Amount</h4>
    </div>

    <div class="amount-grid">
        @foreach([10, 20, 50, 100, 200, 500, 1000, 2000] as $amount)
            <button class="chip-btn" data-amount="{{ $amount }}">
                ₹{{ $amount }}
            </button>
        @endforeach
    </div>

    <div class="current-bets">
        <div class="bets-header">Current Bet Queue</div>

        <div id="betQueue">
            <div class="empty-bet">No Bets Added</div>
        </div>

        <div class="bet-total">
            Total: <strong id="totalAmount">₹0</strong>
        </div>
    </div>

  <button
    class="place-bet-btn"
    id="placeBetBtn">
    PLACE BET
</button>

</div>