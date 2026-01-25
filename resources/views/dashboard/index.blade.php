@extends('layouts.dashboard')

@section('header', 'Overview')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Projects Stat -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-24 h-24 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Total Projects</p>
                <p class="text-3xl font-bold text-white mt-2">{{ $stats['projects'] }}</p>
            </div>
        </div>

        <!-- Blogs Stat -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-24 h-24 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Blog Posts</p>
                <p class="text-3xl font-bold text-white mt-2">{{ $stats['blogs'] }}</p>
            </div>
        </div>

        <!-- Visits Stat -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-24 h-24 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Unique Visits</p>
                <p class="text-3xl font-bold text-white mt-2">{{ $stats['visits'] }}</p>
            </div>
        </div>

        <!-- Experience Stat -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-24 h-24 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Experience</p>
                <p class="text-3xl font-bold text-white mt-2">{{ $stats['experiences'] }}</p>
            </div>
        </div>
    </div>

    <!-- API Key Section -->
    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold text-white">API Configuration</h3>
                <p class="text-sm text-slate-400 mt-1">Manage your API access key. This key is required to access data endpoints.</p>
            </div>
            <form action="{{ route('dashboard.generate-key') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-xl hover:bg-indigo-500 hover:text-white transition-all text-sm font-medium">
                    {{ auth()->user()->api_key ? 'Regenerate Key' : 'Generate Key' }}
                </button>
            </form>
        </div>

        <div class="bg-slate-950/50 border border-white/5 rounded-xl p-4">
            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Your API Key</label>
            <div class="flex items-center space-x-4">
                <code class="flex-1 bg-black/30 text-white font-mono text-sm px-4 py-3 rounded-lg border border-white/5 break-all">
                    {{ auth()->user()->api_key ?? 'No API Key generated yet' }}
                </code>
                @if(auth()->user()->api_key)
                <button onclick="navigator.clipboard.writeText('{{ auth()->user()->api_key }}')" class="p-2 text-slate-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors" title="Copy to clipboard">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>
                </button>
                @endif
            </div>
            <div class="mt-4 flex items-start space-x-2 text-xs text-amber-400/80 bg-amber-500/5 p-3 rounded-lg border border-amber-500/10">
                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p>Keep your API key secure. Authentication requires sending this key in the <code class="text-white">X-API-KEY</code> header or <code class="text-white">api_key</code> query parameter.</p>
            </div>
        </div>
    </div>
</div>
@endsection
