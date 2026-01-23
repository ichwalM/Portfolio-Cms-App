<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = \App\Models\Blog::latest()->paginate(10);
        return view('dashboard.blogs.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|image|max:10240',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = 'blogs/' . uniqid() . '.webp';
            
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('blogs')) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('blogs');
            }

            \Intervention\Image\Laravel\Facades\Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['thumbnail'] = $filename;
        }

        \App\Models\Blog::create($validated);

        return redirect()->route('dashboard.blogs.index')->with('success', 'Post created successfully!');
    }

    public function edit(string $id)
    {
        $post = \App\Models\Blog::findOrFail($id);
        return view('dashboard.blogs.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $post = \App\Models\Blog::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:10240',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = 'blogs/' . uniqid() . '.webp';
            
            if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('blogs')) {
                \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('blogs');
            }

            \Intervention\Image\Laravel\Facades\Image::read($image)
                ->toWebp(80)
                ->save(storage_path('app/public/' . $filename));

            $validated['thumbnail'] = $filename;
        }

        $post->update($validated);

        return redirect()->route('dashboard.blogs.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(string $id)
    {
        $post = \App\Models\Blog::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post deleted successfully!');
    }
}
