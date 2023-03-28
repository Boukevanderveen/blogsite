<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;


class TasksController extends Controller
{
    function index(Task $task)
    {
        $tasks = Task::latest()->paginate(6);
        return view('tasks.index', ['tasks' => $tasks, 'task' => $task]);
    }

    function create(Task $task)
    {
        $this->authorize('create', $task);
        $users = User::All();
        $projects = Project::All();
        $statuses = Status::All();

        return view('tasks.create', ['users' => $users, 'statuses' => $statuses, 'projects' => $projects]);
    }

    function store(StoreTaskRequest $request, Task $task)
    {
        $this->authorize('create', $task);
        $Tasks = new Task;
        $Tasks->name = $request->name;
        $Tasks->description = $request->description;
        $Tasks->deadline = $request->deadline;
        $Tasks->project_id = $request->project;
        $Tasks->member_id = $request->assigned_to;
        $Tasks->status_id = $request->status;
        $Tasks->assigned_by_id = Auth::user()->id;
        $Tasks->completed = 0;
        $Tasks->save();
        return redirect('tasks')->with('message', 'Taak succesvol gecreëerd');
    }
    
    function edit(Task $task)
    {
        $this->authorize('update', $task);
        $users = User::All();
        $projects = Project::All();
        $statuses = Status::All();
        $project = Project::where('id', $task->project_id)->get();

        return view('tasks.edit', ['task' => $task, 'member' => $task->member, 'users' => $users, 'statuses' => $statuses, 'projects' => $projects, 'project' => $project]);
    }

    function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->project_id = $request->project;
        $task->member_id = $request->assigned_to;
        $task->status_id = $request->status;
        $task->assigned_by_id = Auth::user()->id;
        $task->completed = $request->is_open;
        $task->update();
        return back()->with('message', 'Taak succesvol bewerkt.');
    }

    function destroy(Request $request, Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return back()->with('message', 'Taak succesvol verwijderd.');
    }

    function adminIndex()
    {
        $tasks = Task::latest()->paginate(6);
        return view('admin.tasks.index', ['tasks' => $tasks]);
    }

    function adminCreate(Task $task)
    {
        $this->authorize('create', $task);
        $users = User::All();
        $projects = Project::All();
        $statuses = Status::All();

        return view('admin.tasks.create', ['users' => $users, 'statuses' => $statuses, 'projects' => $projects]);
    }

    function adminStore(StoreTaskRequest $request, Task $task)
    {
        $this->authorize('create', $task);
        $Tasks = new Task;
        $Tasks->name = $request->name;
        $Tasks->description = $request->description;
        $Tasks->deadline = $request->deadline;
        $Tasks->project_id = $request->project;
        $Tasks->member_id = $request->assigned_to;
        $Tasks->status_id = $request->status;
        $Tasks->assigned_by_id = Auth::user()->id;
        $Tasks->completed = 0;
        $Tasks->save();
        return redirect('admin/tasks')->with('message', 'Taak succesvol gecreëerd');
    }
    
    function adminEdit(Task $task)
    {
        $this->authorize('update', $task);
        $users = User::All();
        $projects = Project::All();
        $statuses = Status::All();
        $project = Project::where('id', $task->project_id)->get();

        return view('admin.tasks.edit', ['task' => $task, 'member' => $task->member, 'users' => $users, 'statuses' => $statuses, 'projects' => $projects, 'project' => $project]);
    }

    function adminUpdate(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->project_id = $request->project;
        $task->member_id = $request->assigned_to;
        $task->status_id = $request->status;
        $task->assigned_by_id = Auth::user()->id;
        $task->completed = $request->is_open;
        $task->update();
        return back()->with('message', 'Taak succesvol bewerkt.');
    }

    function adminDestroy(Request $request, Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return back()->with('message', 'Taak succesvol verwijderd.');
    }
}
