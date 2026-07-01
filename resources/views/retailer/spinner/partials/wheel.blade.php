<div class="wheel-section">

    <div class="wheel-card">

        <div class="wheel-header">
            Spin Wheel
        </div>

        <div class="wheel-body">

            <div class="wheel-container">
                <div class="wheel-pointer"></div>

                <canvas id="spinWheel" width="500" height="500"></canvas>

                <div class="wheel-center">
                    <div>IC</div>
                    <small>CLASSIC</small>
                </div>
            </div>

            <div class="round-card">
                <div class="round-row">
                    <strong>Round</strong>
                    <span>{{ $round->round_no ?? '----' }}</span>
                </div>

                <div class="round-row">
                    <strong>Status</strong>
                    <span id="roundStatus">OPEN</span>
                </div>

                <div class="round-row">
                    <strong>Time</strong>
                    <span id="wheelTimer">02:00</span>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-title">Current Bets</div>

                <div class="summary-row">
                    <span>Numbers</span>
                    <strong id="betCount">0</strong>
                </div>

                <div class="summary-row">
                    <span>Amount</span>
                    <strong id="summaryAmount">₹0</strong>
                </div>
            </div>

        </div>

    </div>

</div>