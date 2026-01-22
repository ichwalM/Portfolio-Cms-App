@extends('layouts.dashboard')

@section('header', 'My Skills')

@section('content')
<div class="space-y-8">
    <!-- Page Header and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <p class="text-slate-400">Showcase your technical expertise and proficiency levels.</p>
        <a href="{{ route('dashboard.skills.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Skill
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

    @if($skills->count() > 0)
        @foreach($skills as $category => $categorySkills)
            <div>
                <h3 class="text-lg font-semibold text-white mb-4 pl-1">{{ $category }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($categorySkills as $skill)
                        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl group hover:bg-white/5 transition-all relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-indigo-500/10 flex items-center justify-center border border-indigo-500/20 text-indigo-400">
                                     @if($skill->icon)
                                        <img src="{{ asset('storage/' . $skill->icon) }}" class="w-8 h-8 object-contain">
                                     @else
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                     @endif
                                </div>
                                <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('dashboard.skills.edit', $skill->id) }}" class="text-slate-400 hover:text-white p-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </a>
                                    <form action="{{ route('dashboard.skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Delete this skill?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-400 p-1">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <h4 class="text-base font-medium text-white mb-2">{{ $skill->name }}</h4>
                            
                            <div class="relative w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                                <div class="absolute top-0 left-0 h-full bg-indigo-500 rounded-full" style="width: {{ $skill->proficiency }}%"></div>
                            </div>
                            <div class="flex justify-between mt-2 text-xs text-slate-500">
                                <span>Proficiency</span>
                                <span>{{ $skill->proficiency }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="px-6 py-24 text-center text-slate-500 bg-slate-900/50 rounded-2xl border border-white/5">
            <div class="flex flex-col items-center justify-center">
                <svg class="w-16 h-16 mb-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <h3 class="text-xl font-medium text-white mb-2">No skills added yet</h3>
                <p class="text-slate-400 max-w-sm mx-auto mb-6">Start building your technical profile by adding your key skills and technologies.</p>
                <a href="{{ route('dashboard.skills.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                    Add Your First Skill
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
