@extends('layouts.dashboard')

@section('header', 'Edit Experience')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('dashboard.experiences.index') }}" class="text-slate-400 hover:text-white transition-colors mr-4 flex items-center">
             <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
             Back to Experience
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

    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-8">
        <form action="{{ route('dashboard.experiences.update', $experience->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Role & Company -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-400 mb-2">Job Role / Title</label>
                    <input type="text" name="role" id="role" value="{{ old('role', $experience->role) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="e.g. Senior Developer">
                </div>
                <div>
                    <label for="company" class="block text-sm font-medium text-slate-400 mb-2">Company Name</label>
                    <input type="text" name="company" id="company" value="{{ old('company', $experience->company) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="e.g. Tech Corp">
                </div>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div>
                    <label for="start_date" class="block text-sm font-medium text-slate-400 mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $experience->start_date ? \Carbon\Carbon::parse($experience->start_date)->format('Y-m-d') : '') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-slate-400 mb-2">End Date (Leave empty if current)</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y-m-d') : '') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-slate-400 mb-2">Description</label>
                <textarea name="description" id="description" rows="5" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="Describe your responsibilities and achievements...">{{ old('description', $experience->description) }}</textarea>
            </div>

            <!-- Submit -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 px-8 rounded-xl shadow-lg shadow-indigo-500/20 transition-all transform hover:scale-105">
                    Update Experience
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
