<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>سجلات ResultOrder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2>سجلات ResultOrder</h2>

    @if($resultOrders->count())
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom du client</th>
                <th>ID</th>
                <th>Source Table</th>
                <th>Action</th>
                <th>Source ID</th>
                <th>Cart ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Quantite</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultOrders as $item)
            <tr>
                <td>{{ $item->nom ?? '-' }} {{ $item->prenom ?? '' }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->source_table }}</td>
                <td>{{ $item->action }}</td>
                <td>{{ $item->source_id }}</td>
                <td>{{ $item->cart_id }}</td>
                <td>{{ $item->title ?? '-' }}</td>
                <td>{{ $item->price ? number_format($item->price, 2) : '-' }}</td>
                <td>{{ $item->quantite ?? '-' }}</td>
                <td>{{ $item->Total ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $resultOrders->links() }}

    @else
        <p class="alert alert-info">لا توجد سجلات لعرضها.</p>
    @endif
</div>

</body>
</html>
