@extends('layouts.dashboard')

@section('header', 'My Certificates')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <p class="text-slate-400">Manage your professional certifications and credential links.</p>
        <a href="{{ route('dashboard.certificates.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Certificate
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

    <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-400">
                <thead class="bg-white/5 text-xs uppercase font-medium text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Certificate</th>
                        <th class="px-6 py-4">Issuer</th>
                        <th class="px-6 py-4">Issued</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($certificates as $certificate)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-12 w-16 flex-shrink-0 mr-4 rounded-lg overflow-hidden bg-slate-800 border border-white/10">
                                        @if($certificate->image)
                                            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-slate-600">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2h-4.172a2 2 0 01-1.414-.586l-.828-.828A2 2 0 009.172 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-medium text-white">{{ $certificate->title }}</div>
                                        <div class="text-xs text-slate-500 mt-0.5">{{ $certificate->credential_id ?: 'No credential ID' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $certificate->issuer }}</td>
                            <td class="px-6 py-4">{{ optional($certificate->issue_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @if($certificate->credential_url)
                                    <a href="{{ $certificate->credential_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-slate-400 hover:text-indigo-400 transition-colors p-1" title="Open Credential">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656m-1.414-7.07a6 6 0 010 8.484m-1.414-9.9a8 8 0 010 11.314M7 7h.01M7 17h.01" />
                                        </svg>
                                    </a>
                                @endif
                                <a href="{{ route('dashboard.certificates.edit', $certificate->id) }}" class="inline-flex items-center text-slate-400 hover:text-white transition-colors p-1" title="Edit">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('dashboard.certificates.destroy', $certificate->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this certificate?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center text-slate-400 hover:text-red-400 transition-colors p-1" title="Delete">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2h-4.172a2 2 0 01-1.414-.586l-.828-.828A2 2 0 009.172 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-base font-medium text-slate-400">No certificates found</p>
                                    <p class="text-sm mt-1">Get started by adding your first certificate.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($certificates->hasPages())
            <div class="px-6 py-4 border-t border-white/5 bg-white/5">
                {{ $certificates->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
