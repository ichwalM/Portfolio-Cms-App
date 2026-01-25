<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;

class VisitApiController extends Controller
{
    public function store(Request $request)
    {
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['message' => 'Visit recorded'], 201);
    }
}
