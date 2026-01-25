<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => \App\Models\Project::count(),
            'blogs' => \App\Models\Blog::count(),
            'skills' => \App\Models\Skill::count(),
            'experiences' => \App\Models\Experience::count(),
            'visits' => \App\Models\Visit::distinct('ip_address')->count('ip_address'),
        ];

        // Ensure user has an API Key if not already
        // Optional: auto-generate on visit, but let's stick to manual generation button for now
        // or just pass the current key
        
        return view('dashboard.index', compact('stats'));
    }

    public function generateApiKey(Request $request)
    {
        $user = $request->user();
        $user->update([
            'api_key' => Str::uuid(),
        ]);

        return back()->with('success', 'API Key generated successfully!');
    }
}
