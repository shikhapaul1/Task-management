<x-layouts.app>
    <div class="max-w-7xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Top Greeting Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-zinc-200/80 dark:border-zinc-800">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 mb-1">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Developer Workspace
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white flex items-center gap-2.5">
                    Welcome back, {{ auth()->user()->name ?? 'Developer' }} 👋
                </h1>
            </div>
            <div class="flex items-center gap-3">
                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 rounded-xl shadow-md shadow-indigo-500/25 transition-all"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <path d="M14 2v6h6"/>
                    </svg>
                    View All Tasks
                </a>
            </div>
        </div>

        <!-- 4 Primary Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Tasks -->
            <div class="group rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-5 shadow-xs hover:shadow-md hover:border-indigo-500/30 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Tasks</span>
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 text-base group-hover:scale-110 transition-transform">
                        📁
                    </span>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-3xl font-extrabold text-zinc-900 dark:text-white">{{ $stats['total'] ?? 0 }}</span>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">Total tasks in system</div>
            </div>

            <!-- In Progress -->
            <div class="group rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-5 shadow-xs hover:shadow-md hover:border-amber-500/30 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">In Progress</span>
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 text-base group-hover:scale-110 transition-transform">
                        ⚡
                    </span>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-3xl font-extrabold text-amber-600 dark:text-amber-400">{{ $stats['in_progress'] ?? 0 }}</span>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">Active tasks in development</div>
            </div>

            <!-- To Do -->
            <div class="group rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-5 shadow-xs hover:shadow-md hover:border-zinc-400/30 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">To Do</span>
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-base group-hover:scale-110 transition-transform">
                        📌
                    </span>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-3xl font-extrabold text-zinc-900 dark:text-white">{{ $stats['todo'] ?? 0 }}</span>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">Pending in backlog</div>
            </div>

            <!-- Completed -->
            <div class="group rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-5 shadow-xs hover:shadow-md hover:border-emerald-500/30 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Completed</span>
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 text-base group-hover:scale-110 transition-transform">
                        ✅
                    </span>
                </div>
                <div class="mt-3 flex items-baseline justify-between">
                    <span class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ $stats['completed'] ?? 0 }}</span>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">Completed tasks</div>
            </div>
        </div>

    </div>
</x-layouts.app>
