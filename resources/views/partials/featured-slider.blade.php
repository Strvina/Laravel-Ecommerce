@if($featured->count())
<div id="featuredCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner rounded shadow-sm">
        @foreach($featured as $key => $kuce)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('images/' . $kuce->image) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $kuce->name }}">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h4>{{ $kuce->name }}</h4>
                <p>{{ Str::limit($kuce->description, 60) }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif
