@extends('layouts.dashboard')

@section('header', 'Work Experience')

@section('content')
<div class="space-y-6">
    <!-- Page Header and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <p class="text-slate-400">Manage your professional background and work history.</p>
        <a href="{{ route('dashboard.experiences.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Experience
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

    <div class="relative border-l border-white/10 ml-4 space-y-8">
        @forelse($experiences as $experience)
            <div class="relative pl-8 group">
                <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-slate-800 border border-indigo-500 group-hover:bg-indigo-500 transition-colors"></div>
                
                <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6 hover:bg-white/5 transition-all w-full">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-start gap-4 mb-2">
                        <div>
                            <h3 class="text-lg font-semibold text-white">{{ $experience->role }}</h3>
                            <p class="text-indigo-400 font-medium">{{ $experience->company }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-medium text-slate-500 bg-slate-800 px-2 py-1 rounded-md border border-white/5">
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                            </span>
                             <div class="flex space-x-1 ml-2">
                                    <a href="{{ route('dashboard.experiences.edit', $experience->id) }}" class="text-slate-400 hover:text-white p-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </a>
                                    <form action="{{ route('dashboard.experiences.destroy', $experience->id) }}" method="POST" onsubmit="return confirm('Delete this experience?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-400 p-1">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                        </div>
                    </div>
                    
                    @if($experience->description)
                        <div class="text-slate-400 text-sm mt-2 leading-relaxed">
                            {!! nl2br(e($experience->description)) !!}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="pl-8">
                 <div class="text-center py-12 text-slate-500 bg-slate-900/50 rounded-2xl border border-white/5">
                    <p class="text-lg font-medium text-white mb-2">No experience added</p>
                    <p class="mb-4">Add your work history to show your career progression.</p>
                     <a href="{{ route('dashboard.experiences.create') }}" class="text-indigo-400 hover:text-indigo-300">Add Experience &rarr;</a>
                 </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($experiences->hasPages())
        <div class="px-6 py-4">
            {{ $experiences->links() }}
        </div>
    @endif
</div>
@endsection
