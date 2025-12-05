<!DOCTYPE html>
<html>
<head>
    <title>Historique des Carts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Historique des Mouvements de Carts</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Cart ID</th>
                <th>Nom du client</th> <!-- هنا العمود الجديد -->
                <th>Action</th>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histroquecarts as $h)
                <tr>
                    <td>{{ $h->id }}</td>
                    <td>{{ $h->cart_id }}</td>
                    <td>{{ $h->user_name ?? 'N/A' }}</td> <!-- عرض اسم المشتري -->
                    <td>
                        <span class="badge {{ $h->action === 'INSERT' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $h->action }}
                        </span>
                    </td>
                    <td><img src="{{ $h->imager }}" width="40" height="40" /></td>
                    <td>{{ $h->title }}</td>
                    <td>{{ $h->content }}</td>
                    <td>{{ $h->size }}</td>
                    <td>{{ $h->price }}</td>
                    <td>{{ $h->quantite }}</td>
                    <td>{{ $h->Total }}</td>
                    <td>{{ $h->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
