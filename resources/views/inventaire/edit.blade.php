@extends('layouts.app')

@section('title','Modifier Quantité')

@section('content')
<div class="container mt-4">
    <h2>Modifier Quantité</h2>

    <form action="{{ route('inventaire.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- عرض باقي الحقول readonly --}}
        <div class="mb-2">
            <label>Title</label>
            <input type="text" value="{{ $item->title }}" class="form-control" disabled>
        </div>

        <div class="mb-2">
            <label>Prix</label>
            <input type="text" value="{{ $item->price }}" class="form-control" disabled>
        </div>

        <div class="mb-2">
            <label>Taille</label>
            <input type="text" value="{{ $item->size }}" class="form-control" disabled>
        </div>

        <div class="mb-2">
            <label>Stock</label>
            <input type="number" value="{{ $item->stock }}" class="form-control" disabled>
        </div>

        {{-- الحقل القابل للتعديل --}}
        <div class="mb-2">
            <label>Quantité</label>
            <input type="number" name="quantite" value="{{ $item->quantite }}" class="form-control" min="0" required>
        </div>

        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ route('inventaire.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
