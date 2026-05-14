<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title>
        Invoice
    </title>

    <style>

        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 16px;
        }

        .label {
            color: gray;
            font-size: 12px;
        }

        .value {
            font-weight: bold;
            font-size: 16px;
        }

        .total {
            font-size: 24px;
            font-weight: bold;
            margin-top: 24px;
        }

    </style>

</head>

<body>

    <div class="title">
        GoRent Invoice
    </div>

    <div class="section">

        <div class="label">
            Invoice Number
        </div>

        <div class="value">
            {{ $booking->invoice_number }}
        </div>

    </div>

    <div class="section">

        <div class="label">
            Customer
        </div>

        <div class="value">
            {{ $booking->user->name }}
        </div>

    </div>

    <div class="section">

        <div class="label">
            GOR
        </div>

        <div class="value">
            {{ $booking->schedule->court->gor->name }}
        </div>

    </div>

    <div class="section">

        <div class="label">
            Court
        </div>

        <div class="value">
            {{ $booking->schedule->court->name }}
        </div>

    </div>

    <div class="section">

        <div class="label">
            Schedule
        </div>

        <div class="value">

            {{ $booking->schedule->schedule_date }}

            |

            {{ substr($booking->schedule->start_time, 0, 5) }}

            -

            {{ substr($booking->schedule->end_time, 0, 5) }}

        </div>

    </div>

    <div class="section">

        <div class="label">
            Payment Status
        </div>

        <div class="value">
            {{ strtoupper($booking->payment->status) }}
        </div>

    </div>

    <div class="total">

        Total:

        Rp

        {{ number_format($booking->total_price, 0, ',', '.') }}

    </div>

</body>
</html>