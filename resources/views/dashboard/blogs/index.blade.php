@extends('layouts.dashboard')

@section('header', 'Blog Posts')

@section('content')
<div class="space-y-6">
    <!-- Page Header and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <p class="text-slate-400">Write and manage articles to share your knowledge.</p>
        <a href="{{ route('dashboard.blogs.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Write New Post
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl overflow-hidden group hover:bg-white/5 transition-all flex flex-col h-full">
                <!-- Thumbnail -->
                <div class="h-48 w-full bg-slate-800 overflow-hidden relative">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-600">
                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2">
                         @if($post->published_at)
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-emerald-500/90 text-white shadow-sm">
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold bg-slate-500/90 text-white shadow-sm">
                                Draft
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-lg font-semibold text-white mb-2 line-clamp-2 leading-tight group-hover:text-indigo-400 transition-colors">{{ $post->title }}</h3>
                    <p class="text-slate-400 text-sm mb-4 line-clamp-3 flex-1">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                    
                    <div class="pt-4 border-t border-white/5 flex items-center justify-between mt-auto">
                        <span class="text-xs text-slate-500">{{ $post->created_at->format('M d, Y') }}</span>
                        <div class="flex space-x-2">
                             <a href="{{ route('dashboard.blogs.edit', $post->id) }}" class="p-1.5 text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                            <form action="{{ route('dashboard.blogs.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                 <div class="text-center py-24 text-slate-500 bg-slate-900/50 rounded-2xl border border-white/5">
                    <div class="flex flex-col items-center justify-center">
                         <svg class="w-16 h-16 mb-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h3 class="text-xl font-medium text-white mb-2">No posts yet</h3>
                        <p class="text-slate-400 max-w-sm mx-auto mb-6">Start your blog by creating your first article.</p>
                        <a href="{{ route('dashboard.blogs.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                            Write First Post
                        </a>
                    </div>
                 </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
        <div class="px-6 py-4">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
