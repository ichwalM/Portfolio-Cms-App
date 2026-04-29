<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WallApp;
use Illuminate\Http\Request;

class WallAppApiController extends Controller
{
    public function index()
    {
        $wallApps = WallApp::latest()->get();
        
        $wallApps->transform(function ($app) {
            if ($app->icon) {
                $app->icon = asset('storage/' . $app->icon);
            }
            return $app;
        });
        
        return response()->json([
            'success' => true,
            'data' => $wallApps
        ]);
    }
}
