<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Produits Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

    <div class="container mt-5">
        <h2 class="text-center mb-4">📜 Historique des modifications - Produits Shop</h2>

        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom du produit</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Taille</th>
                    <th>Stock</th>
                    <th>Action</th>
                    <th>Date de l'action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($historiques as $historique)
                    <tr>
                        <td>{{ $historique->id }}</td>
                        <td>{{ $historique->title }}</td>
                        <td>{{ $historique->content }}</td>
                        <td>{{ $historique->price }} DH</td>
                        <td>{{ $historique->size }}</td>
                        <td>{{ $historique->stock }}</td>
                        <td>
                            @if($historique->action === 'insert')
                                <span class="badge bg-success">Ajout</span>
                            @elseif($historique->action === 'update')
                                <span class="badge bg-warning text-dark">Modification</span>
                            @elseif($historique->action === 'delete')
                                <span class="badge bg-danger">Suppression</span>
                            @endif
                        </td>
                        <td>{{ $historique->action_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucune donnée trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
