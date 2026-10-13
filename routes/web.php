<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes handled directly by LoginController
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register', [LoginController::class, 'store'])->name('register.store');
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
Route::get('manager/dashboard', function () {
    $stats = [
        'total' => Task::count(),
        'todo' => Task::where('status', 'todo')->count(),
        'in_progress' => Task::where('status', 'in_progress')->count(),
        'completed' => Task::where('status', 'completed')->count(),
        'urgent' => Task::where('priority', 'Urgent')->count(),
    ];
    $recentTasks = Task::latest()->take(6)->get();
    $developersCount = User::where('role', 'Developer')->orWhere('role', 'developer')->count();

    return view('manager.dashboard', compact('stats', 'recentTasks', 'developersCount'));
})->middleware(['auth'])->name('manager.dashboard');

Route::get('dashboard', function () {
    $stats = [
        'total' => Task::where('assigned_to', Auth::user()->id)->count(),
        'todo' => Task::where('status', 'todo')->where('assigned_to', Auth::user()->id)->count(),
        'in_progress' => Task::where('status', 'in_progress')->where('assigned_to', Auth::user()->id)->count(),
        'completed' => Task::where('status', 'completed')->where('assigned_to', Auth::user()->id)->count(),
        'urgent' => Task::where('priority', 'Urgent')->where('assigned_to', Auth::user()->id)->count(),
    ];
    $recentTasks = Task::latest()->take(6)->get();

    return view('dashboard', compact('stats', 'recentTasks'));
})->middleware(['auth'])->name('dashboard');

Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus')
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('create-task', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('create-task', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('view-task', [TaskController::class, 'index'])->name('tasks.index');
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
