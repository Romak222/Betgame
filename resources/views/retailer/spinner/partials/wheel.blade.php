<div class="wheel-section">

    <div class="wheel-card">

        <div class="wheel-header">

            Spinner

        </div>

        <div class="wheel-body">

            <div class="wheel-area">

                <div class="wheel-pointer"></div>

                <div class="wheel-container">

                    <svg
                        id="spinnerWheel"
                        viewBox="0 0 600 600">

                        <g id="wheelGroup"></g>

                        <circle
                            cx="300"
                            cy="300"
                            r="60"
                            class="wheel-center"/>

                        <text
                            x="300"
                            y="308"
                            text-anchor="middle"
                            class="wheel-center-text">

                            IC

                        </text>

                    </svg>

                </div>

            </div>

        </div>

    </div>

    <div class="round-card">

        <div class="round-row">

            <span>

                Round

            </span>

            <strong>

                {{ $round->round_no ?? '----' }}

            </strong>

        </div>

        <div class="round-row">

            <span>

                Status

            </span>

            <strong
                id="roundStatus">

                OPEN

            </strong>

        </div>

        <div class="round-row">

            <span>

                Time

            </span>

            <strong
                id="countdown">

                02:00

            </strong>

        </div>

    </div>

    <div class="summary-card">

        <div class="summary-title">

            Current Bets

        </div>

        <div class="summary-row">

            Numbers

            <strong
                id="betCount">

                0

            </strong>

        </div>

        <div class="summary-row">

            Amount

            <strong
                id="summaryAmount">

                ₹0

            </strong>

        </div>

    </div>

</div>