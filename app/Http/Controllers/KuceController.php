<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuce;

class KuceController extends Controller
{
    // Show list of kuces with pagination, optional breed filter, and featured dogs
    public function index(Request $request)
    {
        $breed = $request->input('breed');

        // Query kuces
        $kucesQuery = Kuce::query();

        // Filter by breed if provided
        if ($breed) {
            $kucesQuery->where('breed', 'like', "%{$breed}%");
        }

        // Paginate 6 per page
        $kuces = $kucesQuery->paginate(6)->withQueryString();

        // Featured dogs (first 3)
        // Featured dogs (only those marked as featured)
// Featured dogs (only those marked as featured)
        $featured = Kuce::featured()->take(3)->get();

        // Return only grid for AJAX pagination requests
        if ($request->ajax()) {
            return view('partials.kuce-grid', compact('kuces'))->render();
        }

        return view('kuces.index', compact('kuces', 'featured', 'breed'));
    }

    // Show single kuca
    public function show($id)
    {
        $kuce = Kuce::findOrFail($id);
        return view('kuces.show', compact('kuce'));
    }

    public function search(Request $request)
    {
        $query = Kuce::query();

        if ($request->has('breed') && $request->breed != '') {
            $query->where('breed', 'LIKE', '%' . $request->breed . '%');
        }

        $kuces = $query->paginate(9); // paginacija može da ostane
        if ($request->ajax()) {
            return view('partials.kuce-grid', compact('kuces'))->render();
        }

        return view('kuces.index', compact('kuces'));
    }
    public function filter(Request $request)
    {
        $query = Kuce::query();

        if ($request->filled('breed')) {
            $query->where('breed', 'LIKE', '%' . $request->breed . '%');
        }
        if ($request->filled('featured') && $request->featured == '1') {
            $query->where('is_featured', true);
        }
        if ($request->filled('price_min'))
            $query->where('price', '>=', $request->price_min);
        if ($request->filled('price_max'))
            $query->where('price', '<=', $request->price_max);

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc')
                $query->orderBy('price', 'asc');
            if ($request->sort === 'price_desc')
                $query->orderBy('price', 'desc');
        }

        $kuces = $query->paginate(9)->withQueryString();

        // Ako je AJAX, vraća samo partial
        if ($request->ajax()) {
            return view('partials.kuce-grid', compact('kuces'))->render();
        }
        // inače full index view
        return view('kuces.index', compact('kuces'));
    }
}

