@if ($kuces->count())
    <div class="row">
        @foreach ($kuces as $kuce)
            <div class="col-md-4 mb-4">
                <div class="card dog-card shadow-sm h-100 position-relative">

                    @if($kuce->is_featured)
                        <span class="badge bg-warning text-dark position-absolute m-2"
                              style="top:0; right:0;">
                            Featured
                        </span>
                    @endif

                    <img src="{{ asset('images/' . $kuce->image) }}"
                         class="card-img-top"
                         alt="{{ $kuce->name }}">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $kuce->name }}</h5>
                        <hr>
                        <p><strong>Breed:</strong> {{ $kuce->breed }}</p>
                        <hr>
                        <p><strong>Price:</strong> €{{ $kuce->price }}</p>
                        <hr>
                        <p>{{ Str::limit($kuce->description, 80) }}</p>

                        <a href="{{ route('kuces.show', $kuce->id) }}"
                           class="btn btn-sm btn-outline-primary mt-auto">
                            View Details
                        </a>

                        <button class="btn btn-sm btn-outline-success mt-2 add-to-cart"
                                data-id="{{ $kuce->id }}"
                                data-url="{{ route('cart.add', $kuce->id) }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $kuces->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@else
    <!-- 🔥 NO RESULTS -->
    <div class="text-center py-5">
        <h4 class="text-muted">No results found 😕</h4>
        <p class="text-muted mb-4">
            Try adjusting your filters or reset them.
        </p>
    </div>
@endif
