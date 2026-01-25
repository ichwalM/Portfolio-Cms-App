<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::firstOrCreate(
            ['id' => 1],
            ['description' => 'Description here', 'university' => 'University Name', 'gpa' => 0.00]
        );
        return view('dashboard.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'description' => 'nullable|string',
            'university' => 'nullable|string',
            'gpa' => 'nullable|numeric|between:0,4.00',
            'photo' => 'nullable|image|max:10240', // 10MB
        ]);

        $about = About::firstOrFail();
        
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = 'about/' . uniqid() . '.webp';
            
            if (!Storage::disk('public')->exists('about')) {
                Storage::disk('public')->makeDirectory('about');
            }

            Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['photo'] = $filename;
        }

        $about->update($validated);

        return back()->with('success', 'About section updated successfully!');
    }
}
