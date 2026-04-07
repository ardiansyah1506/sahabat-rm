<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('admin')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('user.tasks', compact('tasks'));
    }

    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update(['status' => 'completed']);
        return back()->with('success', 'Tugas berhasil diselesaikan!');
    }
}
