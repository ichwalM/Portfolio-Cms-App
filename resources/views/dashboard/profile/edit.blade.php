@extends('layouts.dashboard')

@section('header', 'Edit Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Basic Info Card -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-8">
            <h2 class="text-lg font-semibold text-white mb-6">Basic Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Hero Image Upload -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-400 mb-2">Hero Image</label>
                    <div class="flex items-center space-x-6">
                        @if($profile->hero_image)
                            <img src="{{ asset('storage/' . $profile->hero_image) }}" alt="Hero" class="w-32 h-32 object-cover rounded-xl border border-white/10">
                        @else
                            <div class="w-32 h-32 bg-white/5 rounded-xl border border-white/10 flex items-center justify-center text-slate-500">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="hero_image" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-500/10 file:text-indigo-400 hover:file:bg-indigo-500/20 transition-all cursor-pointer">
                            <p class="mt-2 text-xs text-slate-500">JPG, PNG or GIF up to 10MB</p>
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-400 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="John Doe">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-400 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="john@example.com">
                </div>

                <!-- Resume Link -->
                <div class="md:col-span-2">
                    <label for="resume_link" class="block text-sm font-medium text-slate-400 mb-2">Resume URL</label>
                    <input type="url" name="resume_link" id="resume_link" value="{{ old('resume_link', $profile->resume_link) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="https://example.com/resume.pdf">
                </div>

                <!-- Bio -->
                <div class="md:col-span-2">
                    <label for="bio" class="block text-sm font-medium text-slate-400 mb-2">Bio / About Me</label>
                    <textarea name="bio" id="bio" rows="4" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="Tell us about yourself...">{{ old('bio', $profile->bio) }}</textarea>
                </div>

                <!-- Open to Work -->
                <div class="md:col-span-2 relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="open_work" name="open_work" type="checkbox" value="1" {{ old('open_work', $profile->open_work) ? 'checked' : '' }} class="h-4 w-4 bg-slate-950 border-white/10 rounded text-indigo-500 focus:ring-indigo-500 transition-colors">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="open_work" class="font-medium text-white">Open to Work</label>
                        <p class="text-slate-400">Enable this to show that you are available for new opportunities.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Links Card -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-8">
            <h2 class="text-lg font-semibold text-white mb-6">Social Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">GitHub</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </div>
                        <input type="url" name="social_links[github]" value="{{ old('social_links.github', $profile->social_links['github'] ?? '') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl pl-10 pr-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="https://github.com/username">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">LinkedIn</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </div>
                        <input type="url" name="social_links[linkedin]" value="{{ old('social_links.linkedin', $profile->social_links['linkedin'] ?? '') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl pl-10 pr-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="https://linkedin.com/in/username">
                    </div>
                </div>

                <!-- Instagram -->
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Instagram</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465 1.067-.047 1.407-.06 4.123-.06h.08zm3.543 1.374c-1.063-.047-1.407-.06-3.856-.06-2.427 0-2.793.013-3.864.063-1.062.05-1.636.223-2.022.372a2.915 2.915 0 00-1.057.69 2.915 2.915 0 00-.69 1.057c-.15.385-.323.959-.372 2.022-.05 1.07-.063 1.437-.063 3.864 0 2.446.013 2.793.063 3.864.05 1.062.223 1.636.372 2.022.195.503.453.896.844 1.288.391.391.784.649 1.288.844.385.15.959.323 2.022.372 1.07.05 1.437.063 3.864.063 2.446 0 2.793-.013 3.864-.063 1.062-.05 1.636-.223 2.022-.372a2.915 2.915 0 001.057-.69 2.915 2.915 0 00.69-1.057c.15-.385.323-.959.372-2.022.05-1.07.063-1.437.063-3.864 0-2.446-.013-2.793-.063-3.864-.05-1.062-.223-1.636-.372-2.022a2.915 2.915 0 00-1.057-.69 2.915 2.915 0 00-.69-1.057c-.387-.152-.962-.325-2.026-.374z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M12.309 6.874a5.201 5.201 0 00-5.187 5.208 5.201 5.201 0 005.187 5.208 5.201 5.201 0 005.187-5.208 5.201 5.201 0 00-5.187-5.208zm0 8.421a3.212 3.212 0 110-6.425 3.212 3.212 0 010 6.425z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M16.942 5.864a1.212 1.212 0 11-2.424 0 1.212 1.212 0 012.424 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="url" name="social_links[instagram]" value="{{ old('social_links.instagram', $profile->social_links['instagram'] ?? '') }}" class="w-full bg-slate-950 border border-white/10 rounded-xl pl-10 pr-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="https://instagram.com/username">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 px-8 rounded-xl shadow-lg shadow-indigo-500/20 transition-all transform hover:scale-105">
                Save Changes
            </button>
        </div>
    </form>

    <div class="my-8 border-t border-white/5"></div>

    <form action="{{ route('dashboard.profile.account.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Account Settings Card -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 rounded-2xl p-8">
            <h2 class="text-lg font-semibold text-white mb-6">Account Settings</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Login Name -->
                <div class="md:col-span-2">
                    <label for="account_name" class="block text-sm font-medium text-slate-400 mb-2">Login Name</label>
                    <input type="text" name="account_name" id="account_name" value="{{ old('account_name', auth()->user()->name) }}" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="Admin Name">
                    @error('account_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-400 mb-2">New Password (Optional)</label>
                    <input type="password" name="password" id="password" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="New Password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-400 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="Confirm Password">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 px-8 rounded-xl shadow-lg shadow-indigo-500/20 transition-all transform hover:scale-105">
                Update Account
            </button>
        </div>
    </form>
</div>
@endsection
