<?php

namespace App\Http\Controllers;

use App\Models\Norm;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GaleriNormaController extends Controller
{
    /**
     * Show the gallery of the four social norms.
     */
    public function index(Request $request): View
    {
        UserActivity::complete($request->user()->id, 'galeri');

        return view('galeri-norma', [
            'norms' => Norm::orderBy('sort_order')->get(),
        ]);
    }
}
