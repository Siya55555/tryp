<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking #{{ $booking->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .booking-details {
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Booking Confirmation</h1>
        <p>Booking Reference: #{{ $booking->id }}</p>
    </div>

    <div class="section">
        <h2>Booking Details</h2>
        <table>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($booking->status) }}</td>
            </tr>
            <tr>
                <th>Booking Date</th>
                <td>{{ $booking->booking_date->format('F d, Y') }}</td>
            </tr>
            <tr>
                <th>Number of People</th>
                <td>{{ $booking->number_of_people ?? '1' }}</td>
            </tr>
        </table>
    </div>

    @if($booking->bundle)
    <div class="section">
        <h2>Vacation Bundle</h2>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $booking->bundle->name }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>${{ number_format($booking->bundle->price, 2) }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $booking->bundle->short_description }}</td>
            </tr>
        </table>
    </div>
    @endif

    @if($booking->notes)
    <div class="section">
        <h2>Special Requests</h2>
        <p>{{ $booking->notes }}</p>
    </div>
    @endif
</body>
</html>