@extends('layouts.dashboard')

@section('header', 'New Post')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('dashboard.blogs.index') }}" class="text-slate-400 hover:text-white transition-colors mr-4 flex items-center">
             <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
             Back to Blog
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Content -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-400 mb-2">Post Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="Enter post title...">
                        </div>
                        
                        <div>
                            <label for="slug" class="block text-sm font-medium text-slate-400 mb-2">Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="post-slug">
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-slate-400 mb-2">Content</label>
                            <textarea name="content" id="content" rows="15" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors font-mono text-sm leading-relaxed" placeholder="Write your post content here (Markdown/HTML supported)...">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Meta & Media -->
            <div class="space-y-6">
                <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Featured Image</h3>
                    <div class="w-full border-2 border-dashed border-white/10 rounded-xl p-8 text-center transition-colors hover:border-indigo-500/50 cursor-pointer relative bg-slate-950/50">
                        <input type="file" name="thumbnail" id="thumbnail" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <svg class="mx-auto h-12 w-12 text-slate-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="mt-1 text-sm text-slate-400">Upload cover image</p>
                        <p class="mt-1 text-xs text-slate-500">PNG, JPG up to 10MB</p>
                    </div>
                </div>

                <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Additional Photos <span class="text-xs text-slate-500 font-normal">(Optional)</span></h3>
                    <div class="w-full border-2 border-dashed border-white/10 rounded-xl p-8 text-center transition-colors hover:border-indigo-500/50 cursor-pointer relative bg-slate-950/50">
                        <input type="file" name="additional_photos[]" id="additional_photos" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <svg class="mx-auto h-12 w-12 text-slate-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="mt-1 text-sm text-slate-400">Upload documentation/gallery images</p>
                        <p class="mt-1 text-xs text-slate-500">Select multiple images (PNG, JPG up to 10MB each)</p>
                    </div>
                </div>

                <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Publishing</h3>
                    <div class="flex items-center space-x-3 mb-4">
                        <input type="checkbox" name="published_at" id="published_at" value="{{ now()->format('Y-m-d') }}" class="w-5 h-5 rounded border-white/20 bg-slate-950 text-indigo-500 focus:ring-indigo-500">
                        <label for="published_at" class="text-sm font-medium text-slate-300">Publish immediately</label>
                    </div>
                    <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        Publish Post
                    </button>
                    <a href="{{ route('dashboard.blogs.index') }}" class="block w-full text-center mt-3 text-sm text-slate-500 hover:text-white transition-colors">Save as Draft</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const title = document.getElementById('title');
    const slug = document.getElementById('slug');
    title.addEventListener('input', function() {
        slug.value = title.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    });
</script>
@endsection
