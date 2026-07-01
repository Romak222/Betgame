$(function () {

    let selectedAmount = 0;

    let betQueue = {};

    /*==============================
      Select Amount
    ==============================*/

    $(document).on("click", ".chip-btn", function () {

        $(".chip-btn").removeClass("active");

        $(this).addClass("active");

        selectedAmount = parseInt($(this).data("amount"));

    });

    /*==============================
      Click Number Card
    ==============================*/

    $(document).on("click", ".number-card", function () {

        if (selectedAmount === 0) {

            Swal.fire({

                icon: "warning",

                title: "Select Amount",

                text: "Please select amount first."

            });

            return;

        }

        let number = $(this).data("number");

        if (betQueue[number]) {

            betQueue[number] += selectedAmount;

        } else {

            betQueue[number] = selectedAmount;

        }

        updateUI();

    });

    /*==============================
      Remove Bet
    ==============================*/

    $(document).on("click", ".remove-bet", function () {

        let number = $(this).data("number");

        delete betQueue[number];

        updateUI();

    });

    /*==============================
      Update UI
    ==============================*/

    function updateUI() {

        let total = 0;

        $(".number-total").html("₹0");

        for (let number in betQueue) {

            total += betQueue[number];

            $('.number-card[data-number="' + number + '"] .number-total')

                .html("₹" + betQueue[number]);

        }

        $("#totalAmount").html("₹" + total);

        let html = "";

        if (Object.keys(betQueue).length === 0) {

            html = '<div class="empty-bet">No Bets Added</div>';

        } else {

            $.each(betQueue, function (number, amount) {

                html += `

                <div class="bet-row">

                    <div>

                        <strong>${number}</strong>

                    </div>

                    <div>

                        ₹${amount}

                    </div>

                    <div>

                        <button

                            class="remove-bet"

                            data-number="${number}">

                            ✕

                        </button>

                    </div>

                </div>

                `;

            });

        }
        $("#betCount").html(
            Object.keys(betQueue).length
        );

        $("#summaryAmount").html(
            "₹" + total
        );

        $("#betQueue").html(html);

    }

});