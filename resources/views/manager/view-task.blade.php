<x-layouts.app>
    <div class="max-w-7xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8 space-y-6" x-data="{
        selectedTask: null,
        openModal: false,
        viewDetails(task) {
            this.selectedTask = task;
            this.openModal = true;
        }
    }">

        <!-- Top Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-zinc-200/80 dark:border-zinc-800">
            <div>
                <!-- <nav class="flex items-center gap-2 text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-1.5">
                    <a href="{{ route('manager.dashboard') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Manager Dashboard</a>
                    <span class="text-zinc-300 dark:text-zinc-600">/</span>
                    <span class="text-zinc-700 dark:text-zinc-300">Tasks</span>
                    <span class="text-zinc-300 dark:text-zinc-600">/</span>
                    <span class="text-indigo-600 dark:text-indigo-400 font-semibold">All Tasks</span>
                </nav> -->
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white flex items-center gap-2.5">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-md shadow-indigo-500/20 text-lg">
                            📊
                        </span>
                        Created Tasks
                    </h1>
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 border border-indigo-200/50 dark:border-indigo-800/50">
                        {{ $tasks->total() ?? count($tasks) }} Total
                    </span>
                </div>
            </div>
            @if(Auth::user()->role == 'Manager')
            <div class="flex items-center gap-3 self-start sm:self-auto">
                <a
                    href="{{ route('tasks.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-[0.99] rounded-xl shadow-md shadow-indigo-500/25 transition-all"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="m12 5 7 7-7 7"/>
                    </svg>
                    Create Task
                </a>
            </div>
            @endif
        </div>

        <!-- Quick Summary Stats -->
      

        <!-- Filter & Search Controls -->
        <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-4 shadow-xs">
            <form action="{{ route('tasks.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center">
                <!-- Search Box -->
                <div class="relative sm:col-span-2 lg:col-span-4">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-zinc-400">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search tasks by title, description, or assigned developer..."
                        class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 pl-10 pr-4 py-2.5 text-xs sm:text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all"
                    />
                </div>

                <!-- Status Filter -->
                <div class="lg:col-span-2">
                    <select
                        name="status"
                        class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 px-3 py-2.5 text-xs sm:text-sm text-zinc-900 dark:text-white focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                    >
                        <option value="all">All Statuses</option>
                        <option value="todo" {{ request('status') === 'todo' ? 'selected' : '' }}>📌 To Do</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>⚡ In Progress</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                    </select>
                </div>

                <!-- Priority Filter -->
                <div class="lg:col-span-2">
                    <select
                        name="priority"
                        class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 px-3 py-2.5 text-xs sm:text-sm text-zinc-900 dark:text-white focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                    >
                        <option value="all">All Priorities</option>
                        <option value="Low" {{ request('priority') === 'Low' ? 'selected' : '' }}>🟢 Low</option>
                        <option value="Medium" {{ request('priority') === 'Medium' ? 'selected' : '' }}>🟡 Medium</option>
                        <option value="High" {{ request('priority') === 'High' ? 'selected' : '' }}>🟠 High</option>
                        <option value="Urgent" {{ request('priority') === 'Urgent' ? 'selected' : '' }}>🔴 Urgent</option>
                    </select>
                </div>

                <!-- Assigned To Filter -->
                <div class="lg:col-span-2">
                    <select
                        name="assigned_to"
                        class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 px-3 py-2.5 text-xs sm:text-sm text-zinc-900 dark:text-white focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                    >
                        <option value="all">All Assignees</option>
                        @if (isset($developers))
                            @foreach ($developers as $dev)
                                <option value="{{ $dev->name }}" {{ request('assigned_to') === $dev->name ? 'selected' : '' }}>
                                    👤 {{ $dev->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="sm:col-span-2 lg:col-span-2 flex items-center gap-2">
                    <button
                        type="submit"
                        class="flex-1 px-4 py-2.5 text-xs font-semibold rounded-xl bg-indigo-600 text-white hover:bg-indigo-500 active:scale-[0.98] transition-all text-center"
                    >
                        Filter
                    </button>
                    @if (request()->hasAny(['search', 'status', 'priority', 'assigned_to']))
                        <a
                            href="{{ route('tasks.index') }}"
                            class="px-3 py-2.5 text-xs font-semibold rounded-xl bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-center"
                        >
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Main Tasks Table Card -->
        <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-xs overflow-hidden">
            @if ($tasks->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <!-- Table Head -->
                        <thead>
                            <tr class="border-b border-zinc-200 dark:border-zinc-800 bg-zinc-50/75 dark:bg-zinc-800/50 text-[11px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                <th scope="col" class="py-3.5 px-4 w-12 text-center">#</th>
                                <th scope="col" class="py-3.5 px-4 min-w-[200px]">Task Title & Scope</th>
                                <th scope="col" class="py-3.5 px-4 min-w-[130px]">Status</th>
                                <th scope="col" class="py-3.5 px-4 min-w-[110px]">Priority</th>
                                <th scope="col" class="py-3.5 px-4 min-w-[140px]">Progress</th>
                                <th scope="col" class="py-3.5 px-4 min-w-[170px]">Assigned To</th>
                                <th scope="col" class="py-3.5 px-4 min-w-[130px]">Assigned By</th>
                                <th scope="col" class="py-3.5 px-4 min-w-[160px]">Schedule & Timeline</th>
                                <th scope="col" class="py-3.5 px-4 w-28 text-center">Actions</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="divide-y divide-zinc-200/60 dark:divide-zinc-800/60">
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition-colors group">
                                    <!-- ID -->
                                    <td class="py-4 px-4 text-center font-mono text-xs text-zinc-400">
                                        {{ $task->id }}
                                    </td>

                                    <!-- Task Title & Description -->
                                    <td class="py-4 px-4">
                                        <div class="font-semibold text-zinc-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $task->title }}
                                        </div>
                                        @if ($task->description)
                                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5 line-clamp-1 max-w-sm">
                                                {{ $task->description }}
                                            </p>
                                        @endif
                                        <!-- Mini Badges for breakdown items if present -->
                                        <div class="flex items-center gap-1.5 mt-1.5 flex-wrap">
                                            @if ($task->todo_work)
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-medium bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 border border-indigo-200/40 dark:border-indigo-800/40">
                                                    Checklist
                                                </span>
                                            @endif
                                            @if ($task->pending_work)
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-medium bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 border border-amber-200/40 dark:border-amber-800/40">
                                                    Blockers
                                                </span>
                                            @endif
                                            @if ($task->daily_update)
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-medium bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200/40 dark:border-emerald-800/40">
                                                    Update Log
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="py-4 px-4">
                                        @php
                                            $statusColors = [
                                                'todo' => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 border-zinc-200 dark:border-zinc-700',
                                                'in_progress' => 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                                                'completed' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
                                            ];
                                            $statusLabels = [
                                                'todo' => '📌 To Do',
                                                'in_progress' => '⚡ In Progress',
                                                'completed' => '✅ Completed',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusColors[$task->status] ?? $statusColors['todo'] }}">
                                            {{ $statusLabels[$task->status] ?? ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>

                                    <!-- Priority Badge -->
                                    <td class="py-4 px-4">
                                        @php
                                            $priorityColors = [
                                                'Low' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
                                                'Medium' => 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                                                'High' => 'bg-orange-50 text-orange-700 dark:bg-orange-950/40 dark:text-orange-300 border-orange-200 dark:border-orange-800',
                                                'Urgent' => 'bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-300 border-rose-200 dark:border-rose-800',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold border {{ $priorityColors[$task->priority] ?? 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 border-zinc-200' }}">
                                            {{ $task->priority ?? 'Normal' }}
                                        </span>
                                    </td>

                                    <!-- Progress Percent -->
                                    <td class="py-4 px-4">
                                        <div class="space-y-1 max-w-[130px]">
                                            <div class="flex items-center justify-between text-[11px] font-semibold text-zinc-700 dark:text-zinc-300">
                                                <span>{{ $task->progress_percent ?? 0 }}%</span>
                                                @if ((int) $task->progress_percent >= 100)
                                                    <span class="text-emerald-600 dark:text-emerald-400 text-[10px]">Done</span>
                                                @endif
                                            </div>
                                            <div class="h-1.5 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                                <div
                                                    class="h-full bg-gradient-to-r from-indigo-500 to-emerald-400 rounded-full transition-all duration-300"
                                                    style="width: {{ min(100, max(0, (int) $task->progress_percent)) }}%"
                                                ></div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Assigned To -->
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2.5">
                                            @php
                                                $devName = $task->getUserUsername?->name ?? $task->assigned_to_name ?? $task->assigned_to;
                                                $devName = !empty($devName) ? $devName : 'Unassigned';
                                            @endphp
                                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white text-xs font-bold shadow-xs">
                                                {{ strtoupper(substr($devName, 0, 1)) }}
                                            </span>
                                            <div class="truncate max-w-[140px]">
                                                <span class="font-bold text-zinc-900 dark:text-white block text-xs truncate" title="{{ $devName }}">
                                                    {{ $devName }}
                                                </span>
                                                <span class="text-[10px] text-zinc-400 font-medium">Developer</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Assigned By -->
                                    <td class="py-4 px-4">
                                        @php
                                            $mgrName = $task->getUsergetUsername?->name ?? $task->assigned_by_name ?? $task->assigned_by;
                                            $mgrName = !empty($mgrName) ? $mgrName : 'Manager';
                                        @endphp
                                        <div class="flex items-center gap-1.5 text-xs">
                                            <span class="font-medium text-zinc-700 dark:text-zinc-300 truncate max-w-[110px]" title="{{ $mgrName }}">
                                                {{ $mgrName }}
                                            </span>
                                        </div>
                                          <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-500 text-[10px]">
                                                Manager
                                            </span>
                                    </td>

                                    <!-- Schedule & Dates -->
                                    <td class="py-4 px-4 text-xs">
                                        <div class="space-y-0.5">
                                            @if ($task->due_date)
                                                @php
                                                    $isOverdue = \Carbon\Carbon::parse($task->due_date)->isPast() && $task->status !== 'completed';
                                                @endphp
                                                <div class="flex items-center gap-1.5">
                                                    <span class="text-zinc-400 text-[11px]">Due:</span>
                                                    <span class="font-medium {{ $isOverdue ? 'text-rose-600 dark:text-rose-400 font-bold' : 'text-zinc-800 dark:text-zinc-200' }}">
                                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                                    </span>
                                                    @if ($isOverdue)
                                                        <span class="text-[9px] font-bold uppercase tracking-wide px-1 py-0.2 rounded bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400">
                                                            Overdue
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-zinc-400">No deadline</span>
                                            @endif

                                            @if ($task->start_date)
                                                <div class="text-[11px] text-zinc-400">
                                                    Start: {{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Actions Column -->
                                    <td class="py-4 px-4 text-center">
                                        <button
                                            type="button"
                                            @click="viewDetails({{ Js::from($task) }})"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-lg bg-zinc-100 hover:bg-indigo-50 dark:bg-zinc-800 dark:hover:bg-indigo-950/50 text-zinc-700 hover:text-indigo-600 dark:text-zinc-300 dark:hover:text-indigo-400 transition-colors cursor-pointer border border-zinc-200/60 dark:border-zinc-700/60"
                                        >
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                            Details
                                        </button>

                                        
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <select
                                                name="status"
                                                onchange="this.form.submit()"
                                                class="rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm
                                                    dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
                                            >
                                                <option value="todo"
                                                    {{ $task->status == 'todo' ? 'selected' : '' }}>
                                                    Todo
                                                </option>

                                                <option value="in_progress"
                                                    {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                                    In Progress
                                                </option>

                                                <option value="completed"
                                                    {{ $task->status == 'completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>
                                            </select>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($tasks->hasPages())
                    <div class="p-4 border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/20">
                        {{ $tasks->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="py-16 px-4 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-500 dark:text-indigo-400 text-3xl mb-4">
                        📋
                    </div>
                    <h3 class="text-base font-bold text-zinc-900 dark:text-white">No tasks created yet</h3>
                    <p class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 mt-1 max-w-sm mx-auto">
                        Get started by creating your first task. You can assign developers, set priorities, and track daily updates.
                    </p>
                    <div class="mt-6">
                        <a
                            href="{{ route('tasks.create') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 rounded-xl shadow-md shadow-indigo-500/25 transition-all"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                            Create Your First Task
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Comprehensive Task Detail Modal -->
        <div
            x-show="openModal"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <!-- Background Backdrop -->
            <div
                x-show="openModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="openModal = false"
                class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity"
            ></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    x-show="openModal"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
                >
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/40">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-lg">
                                📋
                            </span>
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">
                                    Task #<span x-text="selectedTask?.id"></span>
                                </span>
                                <h3 class="text-lg font-bold text-zinc-900 dark:text-white" x-text="selectedTask?.title"></h3>
                            </div>
                        </div>
                        <button
                            @click="openModal = false"
                            class="rounded-xl p-2 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 6 6 18M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body: All Task Details -->
                    <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto">
                        <!-- Key Pill Indicators -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <!-- Status -->
                            <div class="p-3 rounded-2xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/60 dark:border-zinc-700/60">
                                <span class="text-[10px] uppercase font-bold text-zinc-400 block">Status</span>
                                <span class="text-xs font-bold text-zinc-900 dark:text-white capitalize" x-text="selectedTask?.status?.replace('_', ' ')"></span>
                            </div>

                            <!-- Priority -->
                            <div class="p-3 rounded-2xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/60 dark:border-zinc-700/60">
                                <span class="text-[10px] uppercase font-bold text-zinc-400 block">Priority</span>
                                <span class="text-xs font-bold text-zinc-900 dark:text-white" x-text="selectedTask?.priority || 'Normal'"></span>
                            </div>

                            <!-- Assigned To -->
                            <div class="p-3 rounded-2xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/60 dark:border-zinc-700/60">
                                <span class="text-[10px] uppercase font-bold text-zinc-400 block">Assigned To</span>
                                <span class="text-xs font-bold text-zinc-900 dark:text-white truncate block" x-text="selectedTask?.assigned_to_name || selectedTask?.assigned_to || 'None'"></span>
                            </div>

                            <!-- Progress -->
                            <div class="p-3 rounded-2xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200/60 dark:border-zinc-700/60">
                                <span class="text-[10px] uppercase font-bold text-zinc-400 block">Progress</span>
                                <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400" x-text="(selectedTask?.progress_percent || 0) + '%'"></span>
                            </div>
                        </div>

                        <!-- Progress Bar Visual -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400">
                                <span>Overall Completion Meter</span>
                                <span class="font-bold text-zinc-900 dark:text-white" x-text="(selectedTask?.progress_percent || 0) + '%'"></span>
                            </div>
                            <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                <div
                                    class="h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-emerald-400 rounded-full transition-all duration-300"
                                    :style="'width: ' + (selectedTask?.progress_percent || 0) + '%'"
                                ></div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-1.5" x-show="selectedTask?.description">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">Description</h4>
                            <div class="p-4 rounded-2xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-200/60 dark:border-zinc-800 text-xs sm:text-sm text-zinc-700 dark:text-zinc-300 whitespace-pre-wrap" x-text="selectedTask?.description"></div>
                        </div>

                        <!-- Dates & Timeline Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-200/60 dark:border-zinc-800">
                                <span class="text-[10px] uppercase font-bold text-zinc-400 block">Start Date</span>
                                <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200" x-text="selectedTask?.start_date || 'Not set'"></span>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-200/60 dark:border-zinc-800">
                                <span class="text-[10px] uppercase font-bold text-zinc-400 block">Due Date</span>
                                <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200" x-text="selectedTask?.due_date || 'No deadline'"></span>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-200/60 dark:border-zinc-800">
                                <span class="text-[10px] uppercase font-bold text-zinc-400 block">Completed Date</span>
                                <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200" x-text="selectedTask?.completed_at || 'In progress'"></span>
                            </div>
                        </div>

                        <!-- Assigned By -->
                        <div class="text-xs text-zinc-500 dark:text-zinc-400">
                            <span>Assigned By:</span>
                            <span class="font-semibold text-zinc-900 dark:text-white" x-text="selectedTask?.assigned_by_name || selectedTask?.assigned_by || 'Manager'"></span>
                        </div>

                        <!-- Work Items & Checklist -->
                        <div class="space-y-1.5" x-show="selectedTask?.todo_work">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 flex items-center gap-2">
                                <span>📝 To-Do Work Items</span>
                            </h4>
                            <div class="p-4 rounded-2xl bg-indigo-50/50 dark:bg-indigo-950/20 border border-indigo-200/40 dark:border-indigo-900/40 text-xs sm:text-sm text-zinc-800 dark:text-zinc-200 whitespace-pre-wrap font-mono leading-relaxed" x-text="selectedTask?.todo_work"></div>
                        </div>

                        <!-- Pending Work / Blockers -->
                        <div class="space-y-1.5" x-show="selectedTask?.pending_work">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400 flex items-center gap-2">
                                <span>⚠️ Pending Work / Blockers</span>
                            </h4>
                            <div class="p-4 rounded-2xl bg-amber-50/50 dark:bg-amber-950/20 border border-amber-200/40 dark:border-amber-900/40 text-xs sm:text-sm text-zinc-800 dark:text-zinc-200 whitespace-pre-wrap leading-relaxed" x-text="selectedTask?.pending_work"></div>
                        </div>

                        <!-- Daily Update Log -->
                        <div class="space-y-1.5" x-show="selectedTask?.daily_update">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 flex items-center gap-2">
                                <span>💬 Daily Update / Standup Log</span>
                            </h4>
                            <div class="p-4 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/40 dark:border-emerald-900/40 text-xs sm:text-sm text-zinc-800 dark:text-zinc-200 whitespace-pre-wrap leading-relaxed" x-text="selectedTask?.daily_update"></div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="p-4 border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/40 flex items-center justify-end">
                        <button
                            type="button"
                            @click="openModal = false"
                            class="px-5 py-2 text-xs font-bold rounded-xl bg-zinc-900 hover:bg-zinc-800 dark:bg-zinc-100 dark:hover:bg-zinc-200 text-white dark:text-zinc-900 transition-colors"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>
