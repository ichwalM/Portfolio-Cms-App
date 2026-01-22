@extends('layouts.dashboard')

@section('header', 'Add Skill')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('dashboard.skills.index') }}" class="text-slate-400 hover:text-white transition-colors mr-4 flex items-center">
             <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
             Back to Skills
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
        <form action="{{ route('dashboard.skills.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-slate-400 mb-2">Skill Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="e.g. Laravel">
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-slate-400 mb-2">Category</label>
                <select name="category" id="category" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                    <option value="" disabled selected>Select a category</option>
                    <option value="Frontend" {{ old('category') == 'Frontend' ? 'selected' : '' }}>Frontend Development</option>
                    <option value="Backend" {{ old('category') == 'Backend' ? 'selected' : '' }}>Backend Development</option>
                    <option value="DevOps" {{ old('category') == 'DevOps' ? 'selected' : '' }}>DevOps & Networking</option>
                    <option value="Tools" {{ old('category') == 'Tools' ? 'selected' : '' }}>Tools & Platforms</option>
                    <option value="Design" {{ old('category') == 'Design' ? 'selected' : '' }}>Design & UI/UX</option>
                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Proficiency -->
            <div>
                <label for="proficiency" class="block text-sm font-medium text-slate-400 mb-2">Proficiency (0-100%)</label>
                <input type="range" name="proficiency" id="proficiency" value="{{ old('proficiency', 50) }}" min="0" max="100" class="w-full h-2 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-indigo-500">
                <div class="flex justify-between text-xs text-slate-500 mt-2">
                    <span>Beginner</span>
                    <span id="proficiency-value" class="text-white font-medium">{{ old('proficiency', 50) }}%</span>
                    <span>Expert</span>
                </div>
            </div>

            <!-- Icon -->
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">Icon (Optional, Upload Image)</label>
                <input type="file" name="icon" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-500/10 file:text-indigo-400 hover:file:bg-indigo-500/20 transition-all cursor-pointer">
                <p class="mt-2 text-xs text-slate-500">SVG or PNG transparent recommended.</p>
            </div>

            <!-- Submit -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 px-8 rounded-xl shadow-lg shadow-indigo-500/20 transition-all transform hover:scale-105">
                    Save Skill
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const slider = document.getElementById('proficiency');
    const display = document.getElementById('proficiency-value');
    slider.addEventListener('input', function() {
        display.textContent = this.value + '%';
    });
</script>
@endsection
