<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user', 'admin')->latest()->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
        ]);

        Task::create([
            'admin_id' => Auth::id(),
            'user_id' => $request->user_id,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil diberikan.');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('role', 'user')->get();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Tugas berhasil dihapus.');
    }
}
