@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')

<h2 class="mb-4">🛒 Your Cart</h2>

@if($cartItems->isEmpty())
    <div class="alert alert-info">
        Your cart is empty.
    </div>
@else
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Dog</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($cartItems as $item)
            <tr id="cart-row-{{ $item->id }}" data-id="{{ $item->id }}">
                <td>
                    <img src="{{ asset('images/' . $item->kuce->image) }}" width="60" class="rounded me-2">
                    {{ $item->kuce->name }}
                </td>

                <td>€{{ $item->kuce->price }}</td>

                <td>
                    <input
                        type="number"
                        class="form-control form-control-sm cart-quantity"
                        value="{{ $item->quantity }}"
                        min="1"
                        style="width:70px"
                        data-id="{{ $item->id }}"
                    >
                </td>

                <td class="item-subtotal" id="subtotal-{{ $item->id }}">
                    €{{ $item->kuce->price * $item->quantity }}
                </td>

                <td>
                    <button class="btn btn-sm btn-danger remove-item" data-id="{{ $item->id }}">
                        Remove
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h4>Total: €<span id="cartTotal">{{ $total }}</span></h4>
    </div>
@endif

@endsection

@section('scripts')
<script src="{{ asset('js/cart-quantity.js') }}"></script>
<script src="{{ asset('js/cart-remove.js') }}"></script>
@endsection
