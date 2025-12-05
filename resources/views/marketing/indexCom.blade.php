@extends('layouts.app')

@section('title', 'Dashboard Mondial – Statistiques des Vêtements')

@section('content')
<div class="container-fluid py-4">

    <!-- Title -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">🌍 Tableau de Bord Global des Vêtements</h1>
        <p class="text-muted">Ventes Mondiales – Hommes / Femmes / Mixte</p>
    </div>

    <!-- Cards -->
    <div class="row g-4 mb-4">

        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center">
                    <h5 class="text-secondary">Vêtements Hommes</h5>
                    <h1 class="fw-bold text-primary">{{ $menCount }}</h1>
                    <p class="text-muted">Produits disponibles</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center">
                    <h5 class="text-secondary">Vêtements Femmes</h5>
                    <h1 class="fw-bold text-danger">{{ $womenCount }}</h1>
                    <p class="text-muted">Produits disponibles</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center">
                    <h5 class="text-secondary">Mixte</h5>
                    <h1 class="fw-bold text-success">{{ $mixCount }}</h1>
                    <p class="text-muted">Produits en commun</p>
                </div>
            </div>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <h5 class="text-center">Bar Chart – Répartition Globale</h5>
                <canvas id="barChart" height="180"></canvas>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <h5 class="text-center">Pie Chart – Pourcentage</h5>
                <canvas id="pieChart" height="180"></canvas>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <h5 class="text-center">Line Chart – Tendance Mondiale</h5>
                <canvas id="lineChart" height="180"></canvas>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <h5 class="text-center">Doughnut Chart – Vision Générale</h5>
                <canvas id="donutChart" height="180"></canvas>
            </div>
        </div>

    </div>

    <!-- PRODUCT TABLE -->
    <div class="card shadow-lg border-0 rounded-4 mt-5">
        <div class="card-body p-4">
            <h3 class="mb-4 text-primary fw-bold">📦 Liste des produits</h3>

            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mix as $item)
                    <tr>
                        <td><img src="{{ $item['image'] }}" width="60" class="rounded"></td>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['category'] }}</td>
                        <td class="fw-bold">${{ $item['price'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const men = {{ $menCount }};
    const women = {{ $womenCount }};
    const mix = {{ $mixCount }};

    // BAR CHART
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Hommes', 'Femmes', 'Mixte'],
            datasets: [{
                data: [men, women, mix],
                backgroundColor: ['#007bff50', '#dc354550', '#28a74550'],
                borderColor: ['#007bff', '#dc3545', '#28a745'],
                borderWidth: 2
            }]
        }
    });

    // PIE CHART
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Hommes', 'Femmes', 'Mixte'],
            datasets: [{
                data: [men, women, mix],
                backgroundColor: ['#007bff', '#dc3545', '#28a745']
            }]
        }
    });

    // LINE CHART
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Homme', 'Femme', 'Mixte'],
            datasets: [{
                label: 'Tendance',
                data: [men, women, mix],
                borderColor: '#6610f2',
                borderWidth: 3,
                tension: 0.3
            }]
        }
    });

    // DONUT
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Hommes', 'Femmes', 'Mixte'],
            datasets: [{
                data: [men, women, mix],
                backgroundColor: ['#17a2b8', '#ffc107', '#6f42c1']
            }]
        }
    });
</script>

@endsection

