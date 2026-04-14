@extends('layouts.dashboard')

@section('header', 'Edit Certificate')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center">
        <a href="{{ route('dashboard.certificates.index') }}" class="text-slate-400 hover:text-white transition-colors mr-4 flex items-center">
             <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
             Back to Certificates
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

    <form action="{{ route('dashboard.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Certificate Details</h3>
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-400 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $certificate->title) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="issuer" class="block text-sm font-medium text-slate-400 mb-2">Issuer</label>
                        <input type="text" name="issuer" id="issuer" value="{{ old('issuer', $certificate->issuer) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                    </div>
                    <div>
                        <label for="issue_date" class="block text-sm font-medium text-slate-400 mb-2">Issue Year (Optional)</label>
                        <input type="number" name="issue_date" id="issue_date" value="{{ old('issue_date', $certificate->issue_date) }}" min="1900" max="2099" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="e.g. 2024">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="credential_id" class="block text-sm font-medium text-slate-400 mb-2">Credential ID (Optional)</label>
                        <input type="text" name="credential_id" id="credential_id" value="{{ old('credential_id', $certificate->credential_id) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                    </div>
                    <div>
                        <label for="credential_url" class="block text-sm font-medium text-slate-400 mb-2">Credential URL (Optional)</label>
                        <input type="url" name="credential_url" id="credential_url" value="{{ old('credential_url', $certificate->credential_url) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Certificate Image (Optional)</h3>
            @if($certificate->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $certificate->image) }}" alt="Current certificate image" class="max-w-xs rounded-lg border border-white/10">
                    <p class="text-xs text-slate-500 mt-2">Current image</p>
                </div>
            @endif

            <div class="w-full border-2 border-dashed border-white/10 rounded-xl p-8 text-center transition-colors hover:border-indigo-500/50 cursor-pointer relative bg-slate-950/50">
                <input type="file" name="image" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <svg class="mx-auto h-12 w-12 text-slate-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="mt-1 text-sm text-slate-400">Upload new image to replace current one</p>
                <p class="mt-1 text-xs text-slate-500">PNG, JPG, GIF up to 10MB</p>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('dashboard.certificates.index') }}" class="px-5 py-3 text-sm text-slate-400 hover:text-white transition-colors">Cancel</a>
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 px-8 rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                Update Certificate
            </button>
        </div>
    </form>
</div>
@endsection
