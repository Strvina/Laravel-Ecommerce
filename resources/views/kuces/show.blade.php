@extends('layouts.app')

@section('title', $kuce->name . ' - Dog Marketplace')

@section('content')
    <div class="card shadow-sm dog-card mx-auto" style="max-width: 600px;">
        <img src="{{ asset('images/' . $kuce->image) }}" class="card-img-top" alt="{{ $kuce->name }}">
        <div class="card-body">
            <h2 class="card-title">{{ $kuce->name }}</h2>
            <hr>
            <p><strong>Breed:</strong> {{ $kuce->breed }}</p>
            <hr>
            <p><strong>Price:</strong> €{{ $kuce->price }}</p>
            <hr>
            <p>{{ $kuce->description }}</p>

           <button class="btn btn-sm btn-outline-success mt-2 add-to-cart"
        data-id="{{ $kuce->id }}"
        data-url="{{ route('cart.add', $kuce->id) }}">
    Add to Cart
</button>
 <a href="{{ route('kuces.index') }}" class="btn btn-sm btn-outline-primary mt-2 back-to-list">Back to List</a>

        </div>
    </div>
@endsection
