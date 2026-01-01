@extends('layouts.app')

@section('title', 'Home - Dog Marketplace')

@section('content')
@include('partials.featured-slider')

<!-- Filter & Search Form Partial -->
@include('partials.kuce-filter-form', [
    'breed' => request('breed'),
    'featured' => request('featured'),
    'price_min' => request('price_min'),
    'price_max' => request('price_max'),
    'sort' => request('sort')
])

<!-- Dogs Grid & Pagination Partial -->
<div id="kuceGrid">
    @include('partials.kuce-grid', ['kuces'=>$kuces])
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/utils/debounce.js') }}"></script>
<script src="{{ asset('js/kuce-search.js') }}"></script>
<script src="{{ asset('js/kuce-filter.js') }}"></script>
<script src="{{ asset('js/cart-toast.js') }}"></script>
@endsection
