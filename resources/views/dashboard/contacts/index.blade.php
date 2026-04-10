@extends('layouts.dashboard')

@section('header', 'Contact Messages')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <p class="text-slate-400">Semua pesan yang masuk dari endpoint contact form frontend.</p>
        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
            Total {{ $messages->total() }} pesan
        </span>
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
                        <th class="px-6 py-4">Pengirim</th>
                        <th class="px-6 py-4">Subject</th>
                        <th class="px-6 py-4">Message</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($messages as $message)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <p class="font-medium text-white">{{ $message->name }}</p>
                                    <a href="mailto:{{ $message->email }}" class="text-xs text-indigo-400 hover:text-indigo-300 transition-colors">
                                        {{ $message->email }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                {{ $message->subject ?: '-' }}
                            </td>
                            <td class="px-6 py-4 max-w-lg">
                                <p class="text-slate-300 whitespace-pre-line break-words line-clamp-3">
                                    {{ $message->message }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $message->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('dashboard.contacts.destroy', $message->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pesan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center text-slate-400 hover:text-red-400 transition-colors p-1" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 mb-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-base font-medium text-slate-400">Belum ada pesan masuk</p>
                                    <p class="text-sm mt-1">Pesan dari endpoint contact akan tampil di halaman ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-white/5 bg-white/5">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
