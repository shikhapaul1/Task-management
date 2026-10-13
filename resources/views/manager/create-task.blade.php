<x-layouts.app>
    <div class="max-w-6xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Header & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-zinc-200/80 dark:border-zinc-800">
            <div>
                <nav class="flex items-center gap-2 text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-1.5">
                    <a href="{{ route('manager.dashboard') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Manager Dashboard</a>
                    <span class="text-zinc-300 dark:text-zinc-600">/</span>
                    <span class="text-zinc-700 dark:text-zinc-300">Tasks</span>
                    <span class="text-zinc-300 dark:text-zinc-600">/</span>
                    <span class="text-indigo-600 dark:text-indigo-400 font-semibold">New Task</span>
                </nav>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-md shadow-indigo-500/20 text-lg">
                        ✨
                    </span>
                    Create New Task
                </h1>
            </div>
            <div class="flex items-center gap-3 self-start sm:self-auto">
                <a
                    href="{{ route('manager.dashboard') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800/80 border border-zinc-200 dark:border-zinc-700/80 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-all shadow-xs hover:shadow-sm"
                >
                    <svg class="w-4 h-4 text-zinc-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Success Toast Notification -->
        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-800 dark:text-emerald-300 flex items-center justify-between gap-3 shadow-xs"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-500 text-white shadow-sm">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Success</p>
                        <p class="text-xs opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
                <button @click="show = false" class="text-emerald-700 dark:text-emerald-300 hover:opacity-75 transition-opacity">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Validation Errors Box -->
        @if ($errors->any())
            <div class="p-5 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-700 dark:text-rose-300 space-y-2 shadow-xs">
                <div class="flex items-center gap-2.5 font-semibold text-sm">
                    <svg class="w-5 h-5 shrink-0 text-rose-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Please correct the following errors before submitting:
                </div>
                <ul class="list-disc list-inside space-y-1 text-xs pl-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Task Creation Form -->
        <form
            action="{{ route('tasks.store') }}"
            method="POST"
            x-data="{
                progress: {{ old('progress_percent', 0) }},
                status: '{{ old('status', 'todo') }}',
                priority: '{{ old('priority', 'Medium') }}'
            }"
            class="space-y-8"
        >
            @csrf

            <!-- Card 1: Task Core Information -->
            <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
                            1
                        </span>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Task Details</h2>
                        </div>
                    </div>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">
                        Required
                    </span>
                </div>

                <!-- Title -->
                <div class="space-y-1.5">
                    <label for="title" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                        Task Title <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="e.g. Implement OAuth single sign-on integration"
                        class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                    />
                    @error('title')
                        <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="description" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Description
                        </label>
                        <span class="text-xs text-zinc-400">Markdown supported</span>
                    </div>
                    <textarea
                        name="description"
                        id="description"
                        rows="3"
                        placeholder="Describe the objectives, user story, scope, and technical notes..."
                        class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Card 2: Status, Priority & Live Progress -->
            <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 font-semibold text-sm">
                            2
                        </span>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Workflow & State</h2>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Status -->
                    <div class="space-y-1.5">
                        <label for="status" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                name="status"
                                id="status"
                                x-model="status"
                                class="w-full appearance-none rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 pr-10 text-sm font-medium text-zinc-900 dark:text-white focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                            >
                                <option value="todo" {{ old('status', 'todo') === 'todo' ? 'selected' : '' }}>📌 To Do</option>
                                <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>⚡ In Progress</option>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-zinc-400">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @error('status')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div class="space-y-1.5">
                        <label for="priority" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Priority <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                name="priority"
                                id="priority"
                                x-model="priority"
                                class="w-full appearance-none rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 pr-10 text-sm font-medium text-zinc-900 dark:text-white focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                            >
                                <option value="Low" {{ old('priority') === 'Low' ? 'selected' : '' }}>🟢 Low Priority</option>
                                <option value="Medium" {{ old('priority', 'Medium') === 'Medium' ? 'selected' : '' }}>🟡 Medium Priority</option>
                                <option value="High" {{ old('priority') === 'High' ? 'selected' : '' }}>🟠 High Priority</option>
                                <option value="Urgent" {{ old('priority') === 'Urgent' ? 'selected' : '' }}>🔴 Urgent</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-zinc-400">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @error('priority')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Progress Percent -->
                    <div class="space-y-1.5 sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center justify-between">
                            <label for="progress_percent" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                                Progress (%)
                            </label>
                            <span
                                class="text-xs font-bold px-2.5 py-0.5 rounded-full border transition-all duration-200"
                                :class="progress >= 100 ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-600 dark:text-emerald-400' : progress > 0 ? 'bg-indigo-500/10 border-indigo-500/30 text-indigo-600 dark:text-indigo-400' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-500 border-transparent'"
                                x-text="progress + '% Completed'"
                            ></span>
                        </div>
                        <div class="space-y-2 pt-1.5">
                            <input
                                type="range"
                                min="0"
                                max="100"
                                step="5"
                                name="progress_percent"
                                id="progress_percent"
                                x-model="progress"
                                class="w-full h-2 bg-zinc-200 dark:bg-zinc-700 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                            />
                            <!-- Visual Progress Bar -->
                            <div class="h-2 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden border border-zinc-200/50 dark:border-zinc-700/50">
                                <div
                                    class="h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-emerald-400 rounded-full transition-all duration-150"
                                    :style="'width: ' + progress + '%'"
                                ></div>
                            </div>
                        </div>
                        @error('progress_percent')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Card 3: Team & Assignment -->
            <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 font-semibold text-sm">
                            3
                        </span>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Assignment & Ownership</h2>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Assigned To -->
                    <div class="space-y-1.5">
                        <label for="assigned_to" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Assigned To
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-zinc-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <input
                                list="assignee_suggestions"
                                type="text"
                                name="assigned_to"
                                id="assigned_to"
                                value="{{ old('assigned_to') }}"
                                placeholder="Select or type developer name / email..."
                                class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 pl-10 pr-4 py-3 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                            />
                            @if (isset($users) && $users->count() > 0)
                                <datalist id="assignee_suggestions">
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}"> {{ $u->name }}</option>
                                    @endforeach
                                </datalist>
                            @endif
                        </div>
                        @error('assigned_to')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assigned By -->
                    <div class="space-y-1.5">
                        <label for="assigned_by" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Assigned By
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-zinc-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>

                            {{-- Display manager name --}}
                            <input
                                type="text"
                                value="{{ auth()->user()->name }}"
                                placeholder="Manager"
                                class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 pl-10 pr-4 py-3 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:outline-none"
                                readonly
                            />

                            {{-- Submit manager ID --}}
                            <input
                                type="hidden"
                                name="assigned_by"
                                value="{{ auth()->id() }}"
                            />

                        </div>
                        @error('assigned_by')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Card 4: Timeline & Schedule -->
            <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 font-semibold text-sm">
                            4
                        </span>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Timeline & Scheduling</h2>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Start Date -->
                    <div class="space-y-1.5">
                        <label for="start_date" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Start Date
                        </label>
                        <div class="relative">
                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date', date('Y-m-d')) }}"
                                class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                            />
                        </div>
                        @error('start_date')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div class="space-y-1.5">
                        <label for="due_date" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Due Date
                        </label>
                        <div class="relative">
                            <input
                                type="date"
                                name="due_date"
                                id="due_date"
                                value="{{ old('due_date') }}"
                                class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                            />
                        </div>
                        @error('due_date')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Completed At -->
                    <div class="space-y-1.5">
                        <label for="completed_at" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">
                            Completed Date (Optional)
                        </label>
                        <div class="relative">
                            <input
                                type="date"
                                name="completed_at"
                                id="completed_at"
                                value="{{ old('completed_at') }}"
                                class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                            />
                        </div>
                        @error('completed_at')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Card 5: Execution, Breakdown & Updates -->
            <div class="rounded-2xl border border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400 font-semibold text-sm">
                            5
                        </span>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Work Breakdown & Status Updates</h2>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Todo Work -->
                    <div class="space-y-1.5">
                        <label for="todo_work" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 flex items-center justify-between">
                            <span>To-Do Work Items</span>
                            <span class="text-indigo-500 dark:text-indigo-400 text-[11px] font-medium lowercase">items to do</span>
                        </label>
                        <textarea
                            name="todo_work"
                            id="todo_work"
                            rows="4"
                            placeholder="• Build database migrations&#10;• Set up API endpoints&#10;• Write unit and feature tests"
                            class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                        >{{ old('todo_work') }}</textarea>
                        @error('todo_work')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pending Work -->
                    <div class="space-y-1.5">
                        <label for="pending_work" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 flex items-center justify-between">
                            <span>Pending Work</span>
                            <span class="text-amber-500 dark:text-amber-400 text-[11px] font-medium lowercase">dependencies</span>
                        </label>
                        <textarea
                            name="pending_work"
                            id="pending_work"
                            rows="4"
                            placeholder="• Awaiting client API keys&#10;• Pending architectural sign-off&#10;• Third-party webhook sync"
                            class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                        >{{ old('pending_work') }}</textarea>
                        @error('pending_work')
                            <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Daily Update -->
                <div class="space-y-1.5">
                    <label for="daily_update" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 flex items-center justify-between">
                        <span>Daily Update / Standup Log</span>
                        <span class="text-emerald-500 dark:text-emerald-400 text-[11px] font-medium lowercase">latest log</span>
                    </label>
                    <textarea
                        name="daily_update"
                        id="daily_update"
                        rows="3"
                        placeholder="Log daily progress remarks, standup notes, comments, or immediate next steps..."
                        class="w-full rounded-xl bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 px-4 py-3 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-indigo-500 focus:bg-white dark:focus:bg-zinc-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/15 transition-all"
                    >{{ old('daily_update') }}</textarea>
                    @error('daily_update')
                        <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Sticky Form Actions Bar -->
            <div class="flex items-center justify-between pt-2 pb-12">
                <a
                    href="{{ route('manager.dashboard') }}"
                    class="px-5 py-3 text-sm font-semibold text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-all shadow-xs"
                >
                    Cancel
                </a>

                <div class="flex items-center gap-3">
                    <button
                        type="reset"
                        class="px-4 py-3 text-sm font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-800 dark:hover:text-zinc-200 transition-colors"
                    >
                        Reset
                    </button>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2.5 px-7 py-3 text-sm font-bold text-white bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 active:scale-[0.99] rounded-xl shadow-lg shadow-indigo-500/25 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-indigo-500/30"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                            <path d="m12 5 7 7-7 7"/>
                        </svg>
                        Create Task
                    </button>
                </div>
            </div>
        </form>

    </div>
</x-layouts.app>
