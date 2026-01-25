@extends('layouts.dashboard')

@section('header', 'About Section')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Success Message -->
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-400 rounded-xl bg-green-500/10 border border-green-500/20">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-slate-900/50 backdrop-blur-sm border border-white/5 rounded-2xl p-6">
        <form action="{{ route('dashboard.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Photo -->
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2">About Photo</label>
                <div class="flex items-center space-x-6">
                    <div class="shrink-0">
                        @if($about->photo)
                            <img class="h-32 w-32 object-cover rounded-xl border border-white/10" src="{{ asset('storage/' . $about->photo) }}" alt="About photo">
                        @else
                            <div class="h-32 w-32 rounded-xl bg-slate-800 border border-white/10 flex items-center justify-center text-slate-500">
                                No Photo
                            </div>
                        @endif
                    </div>
                    <label class="block">
                        <span class="sr-only">Choose profile photo</span>
                        <input type="file" name="photo" class="block w-full text-sm text-slate-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-indigo-500/10 file:text-indigo-400
                            hover:file:bg-indigo-500/20
                            transition-all cursor-pointer
                        "/>
                        <p class="mt-1 text-xs text-slate-500">WebP, PNG, JPG up to 10MB</p>
                    </label>
                </div>
            </div>

            <!-- University -->
            <div>
                <label for="university" class="block text-sm font-medium text-slate-400 mb-2">University</label>
                <input type="text" name="university" id="university" value="{{ old('university', $about->university) }}" 
                    class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none" placeholder="University Name">
                @error('university')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- GPA -->
            <div>
                <label for="gpa" class="block text-sm font-medium text-slate-400 mb-2">GPA</label>
                <input type="number" step="0.01" min="0" max="4.00" name="gpa" id="gpa" value="{{ old('gpa', $about->gpa) }}" 
                    class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none" placeholder="3.50">
                @error('gpa')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-slate-400 mb-2">Description</label>
                <textarea name="description" id="description" rows="6" 
                    class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none" placeholder="About description...">{{ old('description', $about->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end pt-4 border-t border-white/5">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium rounded-xl hover:shadow-lg hover:shadow-indigo-500/20 transition-all duration-200 transform hover:-translate-y-0.5">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
