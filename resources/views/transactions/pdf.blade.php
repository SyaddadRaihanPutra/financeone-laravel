<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Transactions Report</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ $transaction->description ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
