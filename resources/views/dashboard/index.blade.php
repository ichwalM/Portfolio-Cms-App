@extends('layouts.dashboard')

@section('header', 'Overview')

@section('content')
<div class="mx-auto max-w-7xl space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm text-slate-400">Welcome back, <span class="font-medium text-slate-200">{{ auth()->user()->name }}</span></p>
            <p class="mt-1 text-xs text-slate-500">Manage content, traffic, and API access in one place.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('dashboard.projects.create') }}" class="dash-btn dash-btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Project
            </a>
            <a href="{{ route('dashboard.blogs.create') }}" class="dash-btn dash-btn-ghost">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Post
            </a>
            <a href="{{ route('dashboard.contacts.index') }}" class="dash-btn dash-btn-ghost">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
                Inbox
                @if(($stats['contact_unread'] ?? 0) > 0)
                    <span class="ml-1 inline-flex items-center rounded-full bg-amber-500/15 px-2 py-0.5 text-[11px] font-semibold text-amber-300 border border-amber-500/20">
                        {{ $stats['contact_unread'] }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
        <div class="dash-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Projects</p>
                <span class="dash-pill dash-pill-muted">Total</span>
            </div>
            <p class="mt-3 text-3xl font-semibold text-white">{{ $stats['projects'] }}</p>
        </div>
        <div class="dash-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Posts</p>
                <span class="dash-pill dash-pill-muted">Total</span>
            </div>
            <p class="mt-3 text-3xl font-semibold text-white">{{ $stats['blogs'] }}</p>
        </div>
        <div class="dash-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Skills</p>
                <span class="dash-pill dash-pill-muted">Total</span>
            </div>
            <p class="mt-3 text-3xl font-semibold text-white">{{ $stats['skills'] }}</p>
        </div>
        <div class="dash-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Experience</p>
                <span class="dash-pill dash-pill-muted">Total</span>
            </div>
            <p class="mt-3 text-3xl font-semibold text-white">{{ $stats['experiences'] }}</p>
        </div>
        <div class="dash-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Visits</p>
                <span class="dash-pill dash-pill-muted">Unique</span>
            </div>
            <p class="mt-3 text-3xl font-semibold text-white">{{ $stats['visits'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="dash-panel lg:col-span-2">
            <div class="dash-panel-header">
                <div>
                    <h3 class="text-sm font-semibold text-white">Traffic</h3>
                    <p class="mt-1 text-xs text-slate-500">Unique visits per day (last 14 days)</p>
                </div>
                <span class="dash-pill dash-pill-muted">{{ $visitSeries->sum('count') }} in range</span>
            </div>
            <div class="dash-panel-body">
                @php($max = max(1, (int) $visitSeries->max('count')))
                <div class="flex h-36 items-end gap-2">
                    @foreach($visitSeries as $point)
                        @php($pct = (int) round(($point['count'] / $max) * 100))
                        <div class="flex-1">
                            <div class="h-28 rounded-xl border border-white/10 bg-white/5 px-0.5 pb-0.5">
                                <div class="h-full w-full overflow-hidden rounded-[0.65rem] bg-black/20">
                                    <div class="w-full bg-gradient-to-t from-indigo-500/70 to-cyan-400/60" style="height: {{ $pct }}%"></div>
                                </div>
                            </div>
                            <div class="mt-2 flex items-center justify-between text-[10px] text-slate-500">
                                <span>{{ $point['label'] }}</span>
                                <span class="text-slate-400">{{ $point['count'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 flex items-start gap-2 rounded-xl border border-amber-500/15 bg-amber-500/5 px-4 py-3 text-xs text-amber-200/80">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p>Chart counts unique IPs per day. Visits with a missing IP are ignored in the unique count.</p>
                </div>
            </div>
        </div>

        <div class="dash-panel">
            <div class="dash-panel-header">
                <div>
                    <h3 class="text-sm font-semibold text-white">Inbox</h3>
                    <p class="mt-1 text-xs text-slate-500">Latest contact messages</p>
                </div>
                @if(($stats['contact_unread'] ?? 0) > 0)
                    <span class="dash-pill dash-pill-amber">{{ $stats['contact_unread'] }} unread</span>
                @else
                    <span class="dash-pill dash-pill-muted">All read</span>
                @endif
            </div>
            <div class="dash-panel-body">
                <div class="space-y-3">
                    @forelse($latestMessages as $msg)
                        @php($pill = $msg->status === 'replied' ? 'dash-pill-green' : ($msg->status === 'unread' ? 'dash-pill-amber' : 'dash-pill-muted'))
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">
                            <div class="flex items-center justify-between gap-3">
                                <p class="truncate text-sm font-medium text-slate-200">{{ $msg->subject ?: 'No subject' }}</p>
                                <span class="dash-pill {{ $pill }}">{{ ucfirst($msg->status) }}</span>
                            </div>
                            <div class="mt-1 flex items-center justify-between gap-3 text-xs text-slate-500">
                                <span class="truncate">{{ $msg->name }} · {{ $msg->email }}</span>
                                <span class="shrink-0">{{ $msg->created_at->format('d M') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-8 text-center text-sm text-slate-400">
                            No messages yet.
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('dashboard.contacts.index') }}" class="mt-4 inline-flex text-sm font-medium text-indigo-300 hover:text-indigo-200">
                    Open inbox
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div>
                    <h3 class="text-sm font-semibold text-white">Recent Projects</h3>
                    <p class="mt-1 text-xs text-slate-500">Latest updates</p>
                </div>
                <a href="{{ route('dashboard.projects.index') }}" class="text-sm font-medium text-indigo-300 hover:text-indigo-200">View all</a>
            </div>
            <div class="dash-panel-body">
                <div class="space-y-2">
                    @forelse($latestProjects as $project)
                        <a href="{{ route('dashboard.projects.edit', $project) }}" class="group flex items-center justify-between rounded-xl border border-white/10 bg-white/5 px-4 py-3 hover:bg-white/10 transition-colors">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-slate-200 group-hover:text-white">{{ $project->title }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">
                                    {{ $project->published_at ? 'Published' : 'Draft' }} · {{ $project->created_at->format('d M') }}
                                </p>
                            </div>
                            <svg class="h-4 w-4 shrink-0 text-slate-500 group-hover:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @empty
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-8 text-center text-sm text-slate-400">
                            No projects yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="dash-panel">
            <div class="dash-panel-header">
                <div>
                    <h3 class="text-sm font-semibold text-white">Recent Posts</h3>
                    <p class="mt-1 text-xs text-slate-500">Drafts and published</p>
                </div>
                <a href="{{ route('dashboard.blogs.index') }}" class="text-sm font-medium text-indigo-300 hover:text-indigo-200">View all</a>
            </div>
            <div class="dash-panel-body">
                <div class="space-y-2">
                    @forelse($latestBlogs as $blog)
                        <a href="{{ route('dashboard.blogs.edit', $blog) }}" class="group flex items-center justify-between rounded-xl border border-white/10 bg-white/5 px-4 py-3 hover:bg-white/10 transition-colors">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-slate-200 group-hover:text-white">{{ $blog->title }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">
                                    {{ $blog->published_at ? 'Published' : 'Draft' }} · {{ $blog->created_at->format('d M') }}
                                </p>
                            </div>
                            <svg class="h-4 w-4 shrink-0 text-slate-500 group-hover:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @empty
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-8 text-center text-sm text-slate-400">
                            No posts yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="dash-panel" x-data="{ copied: false }">
            <div class="dash-panel-header">
                <div>
                    <h3 class="text-sm font-semibold text-white">API Key</h3>
                    <p class="mt-1 text-xs text-slate-500">Used for /api/v1 endpoints</p>
                </div>
                <form action="{{ route('dashboard.generate-key') }}" method="POST">
                    @csrf
                    <button type="submit" class="dash-btn dash-btn-soft">
                        {{ auth()->user()->api_key ? 'Regenerate' : 'Generate' }}
                    </button>
                </form>
            </div>
            <div class="dash-panel-body space-y-3">
                <div class="rounded-xl border border-white/10 bg-black/20 p-4">
                    <div class="flex items-start gap-3">
                        <code class="min-w-0 flex-1 break-all font-mono text-sm text-slate-100">
                            {{ auth()->user()->api_key ?? 'No API Key generated yet' }}
                        </code>
                        @if(auth()->user()->api_key)
                            <button
                                type="button"
                                class="dash-btn dash-btn-ghost px-3 py-2"
                                title="Copy"
                                @click="navigator.clipboard.writeText('{{ auth()->user()->api_key }}'); copied = true; setTimeout(() => copied = false, 1200);"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        @endif
                    </div>
                    <div x-show="copied" x-transition.opacity class="mt-2 text-xs font-medium text-emerald-300">Copied to clipboard</div>
                </div>
                <div class="rounded-xl border border-white/10 bg-white/5 p-4 text-xs text-slate-400">
                    Send it via <span class="font-mono text-slate-200">X-API-KEY</span> header or <span class="font-mono text-slate-200">api_key</span> query parameter.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
