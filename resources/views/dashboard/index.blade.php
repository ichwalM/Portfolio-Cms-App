@extends('layouts.dashboard')

@section('header', 'Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
            <svg class="w-24 h-24 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-400">Total Projects</p>
            <p class="text-3xl font-bold text-white mt-2">12</p>
        </div>
        <div class="mt-4 flex items-center text-sm text-green-400">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            <span>+2 this month</span>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
            <svg class="w-24 h-24 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-400">Blog Posts</p>
            <p class="text-3xl font-bold text-white mt-2">8</p>
        </div>
        <div class="mt-4 flex items-center text-sm text-green-400">
             <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            <span>New post published</span>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
            <svg class="w-24 h-24 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-400">Total Visits</p>
            <p class="text-3xl font-bold text-white mt-2">2.4k</p>
        </div>
        <div class="mt-4 flex items-center text-sm text-green-400">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            <span>+12% this week</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activity -->
    <div class="lg:col-span-2 bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Recent Projects</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-400">
                <thead class="bg-white/5 text-xs uppercase font-medium text-slate-300">
                    <tr>
                        <th class="px-4 py-3 rounded-l-lg">Project Name</th>
                        <th class="px-4 py-3">Tech Stack</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 rounded-r-lg text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 font-medium text-white">Portfolio Website</td>
                        <td class="px-4 py-3">Laravel, Tailwind</td>
                        <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-xs bg-green-500/20 text-green-400">Published</span></td>
                        <td class="px-4 py-3 text-right text-indigo-400 hover:text-indigo-300 cursor-pointer">Edit</td>
                    </tr>
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 font-medium text-white">E-Commerce App</td>
                        <td class="px-4 py-3">React, Node.js</td>
                        <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-xs bg-yellow-500/20 text-yellow-400">Draft</span></td>
                        <td class="px-4 py-3 text-right text-indigo-400 hover:text-indigo-300 cursor-pointer">Edit</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
        <div class="space-y-3">
             <button class="w-full flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-indigo-500/50 transition-all group">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <span class="ml-3 font-medium text-slate-300 group-hover:text-white">Add Project</span>
                </div>
                <svg class="w-5 h-5 text-slate-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>

             <button class="w-full flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-purple-500/50 transition-all group">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </div>
                    <span class="ml-3 font-medium text-slate-300 group-hover:text-white">Write Post</span>
                </div>
                 <svg class="w-5 h-5 text-slate-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
    </div>
</div>
@endsection
