<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCase;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolioCases = PortfolioCase::query()
            ->with('coverMedia')
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('website.portfolio', compact('portfolioCases'));
    }

    public function show(PortfolioCase $portfolioCase): View
    {
        abort_unless($portfolioCase->is_active, 404);

        $portfolioCase->load(['mainMedia', 'secondaryMedia', 'sidebarMedia']);

        return view('website.portfolio-details', compact('portfolioCase'));
    }
}
