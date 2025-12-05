<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
</head>
<body>
 <h1>Bienvenue, {{ $user->firstName }} {{ $user->lastName}}</h1>

<h2>Vos commandes</h2>

<!-- Form البحث بالتاريخ -->
<form method="GET" action="{{ route('user.index') }}" class="mb-3 d-flex gap-2">
    <input type="text" name="date" class="form-control" placeholder="JJ/MM/AAAA" value="{{ request('date') }}">
    <button type="submit" class="btn btn-primary">🔍 Rechercher</button>
</form>


@if($orders->isEmpty())
    <p>Aucune commande trouvée.</p>
@else
    <table border="1" class="table table-striped">
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Total</th>
            <th>Date</th>
        </tr>

        @foreach($orders as $order)
        <tr>
            <td>{{ $order->nom }}</td>
            <td>{{ $order->prenom }}</td>
            <td>{{ $order->email }}</td>
            <td>{{ $order->adresse }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ number_format($order->totalgenerale, 2) }} DH</td>
            <td>{{ $order->created_at->format('d/m/Y') }}</td>
        </tr>
        @endforeach
    </table>
@endif

</body>
</html>
