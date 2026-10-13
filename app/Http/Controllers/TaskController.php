<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->role == 'Developer')
        {
            $query = Task::with(['getUsergetUsername', 'getUserUsername'])->where('assigned_to', Auth::user()->id)->latest();
        }
        else
        {
            $query = Task::with(['getUsergetUsername', 'getUserUsername'])->latest();
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('assigned_to', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority') && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('assigned_to') && $request->assigned_to !== 'all') {
            $query->where('assigned_to', 'like', "%{$request->assigned_to}%");
        }

        $tasks = $query->paginate(10)->withQueryString();
        $developers = User::where('role', 'Developer')->orWhere('role', 'developer')->get();

        $stats = [
            'total' => Task::count(),
            'todo' => Task::where('status', 'todo')->count(),
            'in_progress' => Task::where('status', 'in_progress')->count(),
            'completed' => Task::where('status', 'completed')->count(),
        ];

        return view('manager.view-task', compact('tasks', 'stats', 'developers'));
    }

    public function create()
    {
        $users = User::whereRole('developer')->get();

        return view('manager.create-task', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:todo,in_progress,completed',
            'priority' => 'required|string',
            'assigned_to' => 'nullable|string|max:255',
            'assigned_by' => 'nullable|string|max:255',
            'progress_percent' => 'nullable|numeric|min:0|max:100',
            'daily_update' => 'nullable|string',
            'todo_work' => 'nullable|string',
            'pending_work' => 'nullable|string',
            'start_date' => 'nullable|date',
            'completed_at' => 'nullable|date',
        ]);

        $validated['created_by'] = auth()->user()?->name ?? 'Manager';
        $validated['assigned_by'] = $validated['assigned_by'] ?? auth()->user()?->name ?? 'Manager';

        Task::create($validated);

        return redirect()->route('tasks.create')->with('success', 'Task created successfully!');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['todo', 'in_progress', 'completed']),
            ],
        ]);

        $task->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Task status updated successfully.');
    }
    

}
