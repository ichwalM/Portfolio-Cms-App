<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'blogs' => Blog::count(),
            'skills' => Skill::count(),
            'experiences' => Experience::count(),
            'visits' => Visit::distinct('ip_address')->count('ip_address'),
            'contact_unread' => ContactMessage::where('status', 'unread')->count(),
        ];

        $latestProjects = Project::query()
            ->latest()
            ->take(5)
            ->get(['id', 'title', 'slug', 'published_at', 'created_at']);

        $latestBlogs = Blog::query()
            ->latest()
            ->take(5)
            ->get(['id', 'title', 'slug', 'published_at', 'created_at']);

        $latestMessages = ContactMessage::query()
            ->latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'subject', 'status', 'created_at']);

        $since = now()->subDays(13)->startOfDay();
        $visitCounts = Visit::query()
            ->where('created_at', '>=', $since)
            ->selectRaw('DATE(created_at) as day, COUNT(DISTINCT ip_address) as count')
            ->groupBy('day')
            ->pluck('count', 'day');

        $visitSeries = collect(range(13, 0))
            ->map(function (int $daysAgo) use ($visitCounts) {
                $day = now()->subDays($daysAgo)->toDateString();

                return [
                    'day' => $day,
                    'label' => now()->subDays($daysAgo)->format('d'),
                    'count' => (int) ($visitCounts[$day] ?? 0),
                ];
            })
            ->values();

        // Ensure user has an API Key if not already
        // Optional: auto-generate on visit, but let's stick to manual generation button for now
        // or just pass the current key
        
        return view('dashboard.index', compact('stats', 'latestProjects', 'latestBlogs', 'latestMessages', 'visitSeries'));
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
