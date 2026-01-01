<div class="mb-4">
    <form id="filterForm" class="d-flex gap-2 flex-wrap">
        <input type="text" name="breed" placeholder="Search by breed" class="form-control w-auto" value="{{ $breed ?? '' }}">

        <select name="featured" class="form-control w-auto">
            <option value="">All</option>
            <option value="1" {{ ($featured ?? '')=='1'?'selected':'' }}>Featured</option>
        </select>

        <input type="number" name="price_min" placeholder="Min Price" class="form-control w-auto" value="{{ $price_min ?? '' }}">
        <input type="number" name="price_max" placeholder="Max Price" class="form-control w-auto" value="{{ $price_max ?? '' }}">

        <select name="sort" class="form-control w-auto">
            <option value="">Sort by</option>
            <option value="price_asc" {{ ($sort ?? '')=='price_asc'?'selected':'' }}>Price Low → High</option>
            <option value="price_desc" {{ ($sort ?? '')=='price_desc'?'selected':'' }}>Price High → Low</option>
        </select>
        <button type="button" id="resetFilters" class="btn btn-outline-secondary">
    ✖ Reset filters
</button>

    </form>
</div>
