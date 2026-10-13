<x-layouts.app>
    <div class="max-w-7xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Top Greeting Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-zinc-200/80 dark:border-zinc-800">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 mb-1">
                    <span class="inline-block h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    Manager Workspace
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white flex items-center gap-2.5">
                    Welcome back, {{ auth()->user()->name ?? 'Manager' }} 👋
                </h1>
            </div>
            <div class="flex items-center gap-3">
                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-all shadow-xs"
                >
                    <svg class="w-4 h-4 text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <path d="M14 2v6h6"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <line x1="10" y1="9" x2="8" y2="9"/>
                    </svg>
                    View All Tasks
                </a>
                <a
                    href="{{ route('tasks.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-[0.99] rounded-xl shadow-md shadow-indigo-500/25 transition-all"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M5 12h14"/>
                        <path d="m12 5 7 7-7 7"/>
                    </svg>
                    Create Task
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
                    <a href="{{ route('tasks.index') }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                        View all →
                    </a>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">All registered tasks in platform</div>
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
                    <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}" class="text-xs font-semibold text-amber-600 dark:text-amber-400 hover:underline">
                        Filter →
                    </a>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">Currently active & underway</div>
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
                    <a href="{{ route('tasks.index', ['status' => 'todo']) }}" class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 hover:underline">
                        Filter →
                    </a>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">Backlog and queued tasks</div>
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
                    <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400">
                        {{ ($stats['total'] ?? 0) > 0 ? round((($stats['completed'] ?? 0) / $stats['total']) * 100) : 0 }}% done
                    </span>
                </div>
                <div class="mt-2 text-[11px] text-zinc-400">Successfully closed tasks</div>
            </div>
        </div>

        <!-- Main Dashboard Content Split -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left 2 Cols: Recent Tasks -->
            <div class="lg:col-span-2 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 text-sm">
                            ⏱️
                        </span>
                        <h2 class="text-base font-bold text-zinc-900 dark:text-white">Recent Tasks</h2>
                    </div>
                    <a href="{{ route('tasks.index') }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                        View All ({{ $stats['total'] ?? 0 }}) →
                    </a>
                </div>

                @if (isset($recentTasks) && $recentTasks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="border-b border-zinc-200 dark:border-zinc-800 text-[10px] font-bold uppercase tracking-wider text-zinc-400">
                                    <th class="py-2.5 px-3">Task</th>
                                    <th class="py-2.5 px-3">Assigned To</th>
                                    <th class="py-2.5 px-3">Status</th>
                                    <th class="py-2.5 px-3">Priority</th>
                                    <th class="py-2.5 px-3">Progress</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800/60">
                                @foreach ($recentTasks as $task)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/40 transition-colors">
                                        <td class="py-3 px-3">
                                            <div class="font-semibold text-zinc-900 dark:text-white truncate max-w-[180px]">
                                                {{ $task->title }}
                                            </div>
                                            @if ($task->due_date)
                                                <div class="text-[10px] text-zinc-400">
                                                    Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-1.5">
                                                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-indigo-100 dark:bg-indigo-900/60 text-indigo-600 dark:text-indigo-400 text-[10px] font-bold">
                                                    {{ strtoupper(substr($task->assigned_to ?? 'U', 0, 1)) }}
                                                </span>
                                                <span class="font-medium text-zinc-800 dark:text-zinc-200 truncate max-w-[110px]" title="{{ $task->assigned_to }}">
                                                    {{ $task->assigned_to ?: 'Unassigned' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3">
                                            @php
                                                $statusColors = [
                                                    'todo' => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                                                    'in_progress' => 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300',
                                                    'completed' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $statusColors[$task->status] ?? $statusColors['todo'] }}">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-3">
                                            @php
                                                $priorityColors = [
                                                    'Low' => 'text-emerald-600 dark:text-emerald-400',
                                                    'Medium' => 'text-amber-600 dark:text-amber-400',
                                                    'High' => 'text-orange-600 dark:text-orange-400',
                                                    'Urgent' => 'text-rose-600 dark:text-rose-400 font-bold',
                                                ];
                                            @endphp
                                            <span class="text-[11px] font-medium {{ $priorityColors[$task->priority] ?? 'text-zinc-600' }}">
                                                {{ $task->priority ?? 'Normal' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-3">
                                            <div class="space-y-1 w-20">
                                                <div class="text-[10px] font-bold text-zinc-600 dark:text-zinc-300">{{ $task->progress_percent ?? 0 }}%</div>
                                                <div class="h-1.5 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                                    <div
                                                        class="h-full bg-gradient-to-r from-indigo-500 to-emerald-400 rounded-full"
                                                        style="width: {{ min(100, max(0, (int) $task->progress_percent)) }}%"
                                                    ></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-12 text-center space-y-3">
                        <div class="text-3xl">📋</div>
                        <p class="text-xs text-zinc-500">No tasks created yet.</p>
                        <a
                            href="{{ route('tasks.create') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 transition-colors"
                        >
                            Create First Task
                        </a>
                    </div>
                @endif
            </div>

            <!-- Right 1 Col: Quick Actions & Overview -->
         
        </div>

    </div>
</x-layouts.app>
