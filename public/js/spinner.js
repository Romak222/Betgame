$(function () {

    let selectedAmount = 0;
    let betQueue = {};
    let isSpinning = false;
    let currentRotation = 0;

    const numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    const canvas = document.getElementById("spinWheel");
    const ctx = canvas ? canvas.getContext("2d") : null;

    /* ==============================
       DRAW WHEEL
    ============================== */
    function drawWheel(rotation = 0) {
        if (!ctx) return;

        const size = canvas.width;
        const center = size / 2;
        const radius = center - 10;
        const slice = (Math.PI * 2) / numbers.length;

        ctx.clearRect(0, 0, size, size);
        ctx.save();

        ctx.translate(center, center);
        ctx.rotate(rotation);

        numbers.forEach((num, index) => {
            const start = index * slice;
            const end = start + slice;

            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx.arc(0, 0, radius, start, end);
            ctx.closePath();

            ctx.fillStyle = index % 2 === 0 ? "#C58A00" : "#8B5A00";
            ctx.fill();

            ctx.strokeStyle = "#fff";
            ctx.lineWidth = 3;
            ctx.stroke();

            ctx.save();
            ctx.rotate(start + slice / 2);
            ctx.textAlign = "right";
            ctx.fillStyle = "#fff";
            ctx.font = "bold 42px Arial";
            ctx.fillText(num, radius - 35, 15);
            ctx.restore();
        });

        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, Math.PI * 2);
        ctx.lineWidth = 8;
        ctx.strokeStyle = "#FFD54F";
        ctx.stroke();

        ctx.restore();
    }

    drawWheel();

    /* ==============================
       SELECT AMOUNT
    ============================== */
    $(document).on("click", ".chip-btn", function () {
        if (isSpinning) return;

        $(".chip-btn").removeClass("active");
        $(this).addClass("active");

        selectedAmount = parseInt($(this).data("amount"));
    });

    /* ==============================
       SELECT NUMBER
    ============================== */
    $(document).on("click", ".number-card", function () {
        if (isSpinning) return;

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

    /* ==============================
       REMOVE BET
    ============================== */
    $(document).on("click", ".remove-bet", function () {
        if (isSpinning) return;

        let number = $(this).data("number");
        delete betQueue[number];

        updateUI();
    });

    /* ==============================
       UPDATE UI
    ============================== */
    function updateUI() {
        let total = 0;

        $(".number-card").removeClass("active");
        $(".number-total").html("₹0");

        for (let number in betQueue) {
            total += betQueue[number];

            $('.number-card[data-number="' + number + '"]')
                .addClass("active")
                .find(".number-total")
                .html("₹" + betQueue[number]);
        }

        $("#totalAmount").html("₹" + total);
        $("#summaryAmount").html("₹" + total);
        $("#betCount").html(Object.keys(betQueue).length);

        let html = "";

        if (Object.keys(betQueue).length === 0) {
            html = '<div class="empty-bet">No Bets Added</div>';
        } else {
            $.each(betQueue, function (number, amount) {
                html += `
                    <div class="bet-row">
                        <div><strong>Number ${number}</strong></div>
                        <div>₹${amount}</div>
                        <div>
                            <button class="remove-bet" data-number="${number}">
                                ✕
                            </button>
                        </div>
                    </div>
                `;
            });
        }

        $("#betQueue").html(html);
    }

    /* ==============================
       PLACE BET
    ============================== */
    $(document).on("click", "#placeBetBtn", function () {
        if (isSpinning) return;

        if (Object.keys(betQueue).length === 0) {
            Swal.fire({
                icon: "warning",
                title: "No Bet",
                text: "Please select number and amount first."
            });
            return;
        }

        let bets = [];

        $.each(betQueue, function (number, amount) {
            bets.push({
                number: parseInt(number),
                amount: amount
            });
        });

        $.ajax({
            url: "/retailer/spinner/place-bet",
            type: "POST",
            timeout: 10000,
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                bets: bets
            },
            beforeSend: function () {
                $("#placeBetBtn").prop("disabled", true).html("PLACING...");
            },
            success: function (response) {
                Swal.fire({
                    icon: response.success ? "success" : "error",
                    title: response.success ? "Bet Placed" : "Error",
                    text: response.message
                });
            },
            error: function (xhr) {
                console.log(xhr.responseJSON);

                let msg = "Bet not placed.";

                if (xhr.responseJSON?.message) {
                    msg = xhr.responseJSON.message;
                }

                if (xhr.responseJSON?.errors) {
                    msg = Object.values(xhr.responseJSON.errors).flat().join("\n");
                }
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: xhr.responseJSON?.message || xhr.statusText || "Bet not placed."
                });
            },
            complete: function () {
                $("#placeBetBtn").prop("disabled", false).html("PLACE BET");
            }
        });
    });

    /* ==============================
       SPIN ANIMATION
    ============================== */
    function startSpin() {
        isSpinning = true;

        $("#roundStatus").html("SPINNING");
        $("#placeBetBtn").prop("disabled", true).html("SPINNING...");

        let winner = Math.floor(Math.random() * 10);
        let sliceDegree = 360 / numbers.length;

        let winnerIndex = numbers.indexOf(winner);
        let targetDegree = 360 - (winnerIndex * sliceDegree) - (sliceDegree / 2);

        let extraSpins = 360 * 6;
        let finalDegree = extraSpins + targetDegree;

        let start = null;
        let duration = 4500;

        function animate(timestamp) {
            if (!start) start = timestamp;

            let progress = timestamp - start;
            let percent = Math.min(progress / duration, 1);

            let eased = easeOutCubic(percent);
            let degree = currentRotation + (finalDegree * eased);

            drawWheel(degree * Math.PI / 180);

            if (percent < 1) {
                requestAnimationFrame(animate);
            } else {
                currentRotation = (currentRotation + finalDegree) % 360;
                finishSpin(winner);
            }
        }

        requestAnimationFrame(animate);
    }

    function finishSpin(winner) {
        $("#roundStatus").html("RESULT: " + winner);

        $('.number-card[data-number="' + winner + '"]')
            .addClass("winner-number");

        Swal.fire({
            icon: "success",
            title: "Winning Number",
            html: `<h1>${winner}</h1>`,
            timer: 1800,
            showConfirmButton: false
        });

        setTimeout(function () {
            betQueue = {};
            selectedAmount = 0;
            isSpinning = false;

            $(".chip-btn").removeClass("active");
            $(".number-card").removeClass("winner-number");

            updateUI();

            $("#roundStatus").html("OPEN");
            $("#placeBetBtn").prop("disabled", false).html("PLACE BET");
        }, 2200);
    }

    function easeOutCubic(x) {
        return 1 - Math.pow(1 - x, 3);
    }

});
