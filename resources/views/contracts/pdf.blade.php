<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Housing Rental Agreement</title>
    <style>
        body {
            font-family: "Helvetica", Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }

        h1,
        h2 {
            text-align: center;
            margin: 0 0 10px 0;
            padding: 10px 0;
        }

        .section {
            margin-top: 20px;
        }

        .info-block p {
            margin: 5px 0;
        }

        .signature-wrapper {
            margin-top: 60px;
            width: 100%;
        }

        .signature-box {
            width: 45%;
            display: inline-block;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            padding-top: 5px;
            font-weight: bold;
        }

        .date-line {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <h1><u>Student Housing Agreement</u></h1>
    <p style="text-align: center;">This agreement is entered into on <strong>{{ $contract->created_at->format('F d, Y') }}</strong></p>

    <div class="section">
        <div class="info-block">
            <p><strong>Student Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Property Name:</strong> {{ $property->name }}</p>
            <p><strong>Room Number:</strong> {{ $booking->assigned_room_number }}</p>
            <p><strong>Address:</strong> {{ $property->address ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="section">
        <p>
            The rental term starts on <strong>{{ $booking->check_in_date->format('F d, Y') }}</strong>
            and ends on <strong>{{ $booking->check_out_date->format('F d, Y') }}</strong>,
            covering a duration of <strong>{{ $booking->duration_months }} months</strong>.
        </p>
    </div>

    <div class="section">
        <p><strong>Monthly Rent:</strong> ${{ number_format($booking->monthly_rent, 2) }}</p>
        <p><strong>Security Deposit:</strong> ${{ number_format($booking->security_deposit, 2) }}</p>
        <p><strong>Total Contract Value:</strong> ${{ number_format($booking->total_amount, 2) }}</p>
    </div>

    <div class="section">
        <p>
            The room key will be handed over to the student on <strong>{{ optional($booking->key_handover_date)->format('F d, Y') ?? 'TBD' }}</strong>.
        </p>
    </div>

    <div class="section">
        <p>
            The student agrees to the following terms and conditions:
        </p>
        <ul>
            <li>The student must comply with all property rules and regulations.</li>
            <li>Subleasing or sharing the property is strictly prohibited.</li>
            <li>The student is responsible for any damages caused during their stay.</li>
            <li>Monthly rent must be paid on time.</li>
            <li>Early termination may result in forfeiture of the deposit or additional fees.</li>
            <li>Security deposit will be refunded upon successful checkout and property inspection.</li>
        </ul>
    </div>

    <div class="section">
        <p class="date-line"><strong>Date:</strong></p>

        <div class="signature-wrapper">
            <div class="signature-box">
                <div class="signature-line">Student Signature</div>
            </div>

            <div class="signature-box" style="float: right;">
                <div class="signature-line">Landlord Signature</div>
            </div>
        </div>
    </div>

</body>

</html>