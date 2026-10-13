<x-layouts.auth.unified>
    <div
        x-data="{
            tab: '{{ $errors->has('name') || $errors->has('password_confirmation') || ($tab ?? '') === 'register' || request()->routeIs('register') ? 'register' : 'login' }}',
            showLoginPassword: false,
            showRegisterPassword: false,
            showRegisterConfirm: false,
            passwordInput: '',
            confirmPasswordInput: '',
            setTab(newTab) {
                this.tab = newTab;
                const url = new URL(window.location);
                url.pathname = newTab === 'register' ? '/register' : '/login';
                window.history.replaceState({}, '', url);
            }
        }"
        class="relative min-h-screen w-full flex flex-col items-center justify-center p-4 sm:p-6 lg:p-8 overflow-hidden bg-[#07090e]"
    >
        <!-- Background Ambient Glows -->
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -top-36 -left-36 h-[500px] w-[500px] rounded-full bg-indigo-600/20 blur-[130px] animate-pulse-subtle"></div>
            <div class="absolute -bottom-36 -right-36 h-[500px] w-[500px] rounded-full bg-violet-600/20 blur-[140px] animate-pulse-subtle" style="animation-delay: -3s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[450px] w-[450px] rounded-full bg-cyan-500/10 blur-[160px] pointer-events-none"></div>

            <!-- Subtle Dot Grid Texture -->
            <svg class="absolute inset-0 h-full w-full stroke-white/[0.04] [mask-image:radial-gradient(100%_100%_at_center,white_20%,transparent_75%)]" aria-hidden="true">
                <defs>
                    <pattern id="auth-grid-dots" width="32" height="32" patternUnits="userSpaceOnUse" x="50%" y="0">
                        <circle cx="2" cy="2" r="1" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#auth-grid-dots)" />
            </svg>
        </div>

        <!-- Centered Card Container -->
        <div class="relative z-10 w-full max-w-[460px] mx-auto">

            <!-- Top Brand Logo -->
            <div class="flex flex-col items-center justify-center text-center mb-6">
                <a href="{{ route('home') }}" class="group flex flex-col items-center gap-3 focus:outline-none">
                    <!-- <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-500 p-0.5 shadow-lg shadow-indigo-500/30 group-hover:shadow-indigo-500/50 transition-all duration-300">
                        <div class="flex h-full w-full items-center justify-center rounded-[14px] bg-[#0c101b]">
                            <svg class="h-6 w-6 text-indigo-400 group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 12 2 2 4-4" />
                                <rect width="18" height="18" x="3" y="3" rx="4" />
                            </svg>
                        </div>
                    </div> -->
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-white font-sans">{{ 'Task Management' }}</h1>
                        <!-- <p class="text-xs text-slate-400 font-medium">Streamlined Workspace</p> -->
                    </div>
                </a>
            </div>

            <!-- Main Auth Card -->
            <div class="relative rounded-3xl bg-slate-900/90 backdrop-blur-2xl border border-slate-800/90 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.8)] p-6 sm:p-9 overflow-hidden">
                <!-- Top Highlight Glow -->
                <div class="absolute inset-x-0 top-0 h-[1.5px] bg-gradient-to-r from-transparent via-indigo-500/80 to-transparent"></div>

                <!-- Segmented Pill Tabs Switcher -->
                <div class="relative p-1 bg-slate-950/80 rounded-2xl border border-slate-800/90 mb-6 flex select-none">
                    <!-- Sliding Indicator -->
                    <div
                        class="absolute top-1 bottom-1 w-[calc(50%-4px)] rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 shadow-md shadow-indigo-500/25 transition-all duration-300 ease-out"
                        :class="tab === 'login' ? 'left-1' : 'left-[calc(50%+2px)]'"
                    ></div>

                    <!-- Sign In Tab -->
                    <button
                        type="button"
                        @click="setTab('login')"
                        class="relative z-10 flex-1 py-2.5 text-center text-sm font-semibold rounded-xl transition-colors duration-200 flex items-center justify-center gap-2 focus:outline-none cursor-pointer"
                        :class="tab === 'login' ? 'text-white' : 'text-slate-400 hover:text-slate-200'"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Sign In
                    </button>

                    <!-- Create Account Tab -->
                    <button
                        type="button"
                        @click="setTab('register')"
                        class="relative z-10 flex-1 py-2.5 text-center text-sm font-semibold rounded-xl transition-colors duration-200 flex items-center justify-center gap-2 focus:outline-none cursor-pointer"
                        :class="tab === 'register' ? 'text-white' : 'text-slate-400 hover:text-slate-200'"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <line x1="19" y1="8" x2="19" y2="14"/>
                            <line x1="22" y1="11" x2="16" y2="11"/>
                        </svg>
                        Create Account
                    </button>
                </div>

                <!-- Session Status Notification -->
                @if (session('status'))
                    <div class="mb-5 p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs sm:text-sm font-medium flex items-center gap-2">
                        <svg class="h-4 w-4 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- ========================================================= -->
                <!-- TAB 1: LOGIN FORM (Pure Blade + LoginController POST)     -->
                <!-- ========================================================= -->
                <div x-show="tab === 'login'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                        @csrf

                        <!-- Email Address -->
                        <div class="space-y-1.5">
                            <label for="login-email" class="block text-xs font-semibold text-slate-300">Email Address</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                </div>
                                <input
                                    id="login-email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    placeholder="name@company.com"
                                    class="w-full rounded-xl bg-slate-950/60 border border-slate-700/60 pl-10 pr-3.5 py-2.5 text-sm text-white placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                                />
                            </div>
                            @error('email')
                                <p class="text-xs font-medium text-rose-400 mt-1 flex items-center gap-1">
                                    <svg class="h-3 w-3 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="login-password" class="block text-xs font-semibold text-slate-300">Password</label>
                            </div>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                    </svg>
                                </div>
                                <input
                                    id="login-password"
                                    name="password"
                                    :type="showLoginPassword ? 'text' : 'password'"
                                    required
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="w-full rounded-xl bg-slate-950/60 border border-slate-700/60 pl-10 pr-10 py-2.5 text-sm text-white placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                                />
                                <button
                                    type="button"
                                    @click="showLoginPassword = !showLoginPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500 hover:text-slate-300 focus:outline-none cursor-pointer"
                                    tabindex="-1"
                                >
                                    <svg x-show="!showLoginPassword" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <svg x-show="showLoginPassword" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                        <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                        <line x1="2" y1="2" x2="22" y2="22"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-xs font-medium text-rose-400 mt-1 flex items-center gap-1">
                                    <svg class="h-3 w-3 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center justify-between pt-1">
                            <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                                <input
                                    name="remember"
                                    type="checkbox"
                                    value="1"
                                    {{ old('remember') ? 'checked' : '' }}
                                    class="h-4 w-4 rounded-md border-slate-700 bg-slate-950 text-indigo-600 focus:ring-2 focus:ring-indigo-500/40 focus:ring-offset-0 cursor-pointer"
                                />
                                <span class="text-xs text-slate-300 font-medium">Remember me on this device</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="group relative w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-[0.99] shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 cursor-pointer"
                            >
                                <span class="flex items-center gap-2">
                                    Sign In
                                    <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"/>
                                        <path d="m12 5 7 7-7 7"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Switch to Register -->
                    <div class="mt-6 text-center text-xs text-slate-400">
                        Don't have an account yet?
                        <button
                            type="button"
                            @click="setTab('register')"
                            class="font-semibold text-indigo-400 hover:text-indigo-300 ml-1 transition-colors focus:outline-none cursor-pointer"
                        >
                            Create an account
                        </button>
                    </div>
                </div>

                <!-- ========================================================= -->
                <!-- TAB 2: REGISTER FORM (Pure Blade + LoginController POST)  -->
                <!-- ========================================================= -->
                <div x-show="tab === 'register'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                        @csrf

                        <!-- Full Name -->
                        <div class="space-y-1.5">
                            <label for="register-name" class="block text-xs font-semibold text-slate-300">Full Name</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </div>
                                <input
                                    id="register-name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    required
                                    autocomplete="name"
                                    placeholder="Full name"
                                    class="w-full rounded-xl bg-slate-950/60 border border-slate-700/60 pl-10 pr-3.5 py-2.5 text-sm text-white placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                                />
                            </div>
                            @error('name')
                                <p class="text-xs font-medium text-rose-400 mt-1 flex items-center gap-1">
                                    <svg class="h-3 w-3 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Work Email -->
                        <div class="space-y-1.5">
                            <label for="register-email" class="block text-xs font-semibold text-slate-300">Email Address</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                </div>
                                <input
                                    id="register-email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="name@company.com"
                                    class="w-full rounded-xl bg-slate-950/60 border border-slate-700/60 pl-10 pr-3.5 py-2.5 text-sm text-white placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                                />
                            </div>
                            @error('email')
                                <p class="text-xs font-medium text-rose-400 mt-1 flex items-center gap-1">
                                    <svg class="h-3 w-3 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Role Selector -->
                        <div class="space-y-1.5">
                            <label for="register-role" class="block text-xs font-semibold text-slate-300">Your Role</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 7h-7"/>
                                        <path d="M14 17H7"/>
                                        <circle cx="17" cy="17" r="3"/>
                                        <circle cx="7" cy="7" r="3"/>
                                    </svg>
                                </div>
                                <select
                                    id="register-role"
                                    name="role"
                                    class="w-full rounded-xl bg-slate-950/60 border border-slate-700/60 pl-10 pr-9 py-2.5 text-sm text-white transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 appearance-none cursor-pointer"
                                >
                                    <option value="Manager" {{ old('role') === 'Manager' ? 'selected' : '' }} class="bg-slate-900 text-white">Manager</option>
                                    <option value="Employee" {{ old('role') === 'Employee' ? 'selected' : '' }} class="bg-slate-900 text-white">Employee</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Password with Strength Meter -->
                        <div class="space-y-1.5">
                            <label for="register-password" class="block text-xs font-semibold text-slate-300">Password</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                    </svg>
                                </div>
                                <input
                                    id="register-password"
                                    name="password"
                                    x-model="passwordInput"
                                    :type="showRegisterPassword ? 'text' : 'password'"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Min 8 characters"
                                    class="w-full rounded-xl bg-slate-950/60 border border-slate-700/60 pl-10 pr-10 py-2.5 text-sm text-white placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                                />
                                <button
                                    type="button"
                                    @click="showRegisterPassword = !showRegisterPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500 hover:text-slate-300 focus:outline-none cursor-pointer"
                                    tabindex="-1"
                                >
                                    <svg x-show="!showRegisterPassword" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <svg x-show="showRegisterPassword" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                        <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                        <line x1="2" y1="2" x2="22" y2="22"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Password Strength Indicator -->
                            <div x-show="passwordInput.length > 0" x-transition class="space-y-1 pt-1">
                                <div class="grid grid-cols-4 gap-1.5 h-1.5">
                                    <div class="rounded-full transition-colors duration-300" :class="passwordStrength >= 1 ? (passwordStrength === 1 ? 'bg-rose-500' : (passwordStrength === 2 ? 'bg-amber-500' : (passwordStrength === 3 ? 'bg-yellow-400' : 'bg-emerald-500'))) : 'bg-slate-800'"></div>
                                    <div class="rounded-full transition-colors duration-300" :class="passwordStrength >= 2 ? (passwordStrength === 2 ? 'bg-amber-500' : (passwordStrength === 3 ? 'bg-yellow-400' : 'bg-emerald-500')) : 'bg-slate-800'"></div>
                                    <div class="rounded-full transition-colors duration-300" :class="passwordStrength >= 3 ? (passwordStrength === 3 ? 'bg-yellow-400' : 'bg-emerald-500') : 'bg-slate-800'"></div>
                                    <div class="rounded-full transition-colors duration-300" :class="passwordStrength >= 4 ? 'bg-emerald-500' : 'bg-slate-800'"></div>
                                </div>
                                <div class="flex items-center justify-between text-[11px]">
                                    <span class="text-slate-400">Strength:</span>
                                    <span class="font-semibold" :class="strengthColor" x-text="strengthLabel"></span>
                                </div>
                            </div>

                            @error('password')
                                <p class="text-xs font-medium text-rose-400 mt-1 flex items-center gap-1">
                                    <svg class="h-3 w-3 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-1.5">
                            <label for="register-password-confirmation" class="block text-xs font-semibold text-slate-300">Confirm Password</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/>
                                        <path d="m9 12 2 2 4-4"/>
                                    </svg>
                                </div>
                                <input
                                    id="register-password-confirmation"
                                    name="password_confirmation"
                                    x-model="confirmPasswordInput"
                                    :type="showRegisterConfirm ? 'text' : 'password'"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Repeat password"
                                    class="w-full rounded-xl bg-slate-950/60 border border-slate-700/60 pl-10 pr-10 py-2.5 text-sm text-white placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                                />
                                <button
                                    type="button"
                                    @click="showRegisterConfirm = !showRegisterConfirm"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500 hover:text-slate-300 focus:outline-none cursor-pointer"
                                    tabindex="-1"
                                >
                                    <svg x-show="!showRegisterConfirm" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <svg x-show="showRegisterConfirm" x-cloak class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                        <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                        <line x1="2" y1="2" x2="22" y2="22"/>
                                    </svg>
                                </button>
                            </div>
                            <div x-show="confirmPasswordInput.length > 0" x-transition class="pt-0.5">
                                <p x-show="passwordsMatch === true" class="text-[11px] font-semibold text-emerald-400 flex items-center gap-1">
                                    <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Passwords match
                                </p>
                                <p x-show="passwordsMatch === false" class="text-[11px] font-semibold text-rose-400 flex items-center gap-1">
                                    <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Passwords do not match
                                </p>
                            </div>
                            @error('password_confirmation')
                                <p class="text-xs font-medium text-rose-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="group relative w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-[0.99] shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 cursor-pointer"
                            >
                                <span class="flex items-center gap-2">
                                    Create Account
                                    <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"/>
                                        <path d="m12 5 7 7-7 7"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Switch to Login -->
                    <div class="mt-6 text-center text-xs text-slate-400">
                        Already have an account?
                        <button
                            type="button"
                            @click="setTab('login')"
                            class="font-semibold text-indigo-400 hover:text-indigo-300 ml-1 transition-colors focus:outline-none cursor-pointer"
                        >
                            Sign in instead
                        </button>
                    </div>
                </div>

                <!-- Security Trust Tag -->
                <!-- <div class="mt-6 pt-5 border-t border-slate-800/80 flex items-center justify-center gap-2 text-[11px] text-slate-500 font-medium">
                    <svg class="h-3.5 w-3.5 text-indigo-400/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <span>256-bit SSL Encrypted • Privacy Guaranteed</span>
                </div> -->

            </div>

        </div>
    </div>
</x-layouts.auth.unified>
