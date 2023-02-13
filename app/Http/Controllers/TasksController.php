<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Http\Resources\TasksResource;
use App\Http\Requests\StoreTaskRequest;
use App\Models\User;
use App\Traits\HttpResponses;




class TasksController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(Task::all());
        // return Task::all();
        // return TasksResource::collection(
        //     Task::where("user_id", Auth::user()->id)->get()
        // );
         return TasksResource::collection(
            Task::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        // validate incoming request body
         $request->validated($request->all());



        $task = Task::create([
            "user_id" => Auth::user()->id,
            "name" => $request->name,
            "description" => $request->description,
            "priority" => $request->priority
        ]);

        return new TasksResource($task);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Task $task)
    {
        return $this->isNotAuthorized($task) ?  $this->isNotAuthorized($task) : new TasksResource($task);
        // return new TasksResource($task);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
         if (Auth::user()->id !== $task->user_id) {
            return $this->error("", "You are not authorized to make this request", 403);
        }
        $task->update($request->all());

        return new TasksResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        return $this->isNotAuthorized($task) ?  $this->isNotAuthorized($task) :$task->delete();
        // $task->delete();

        // return \response(null, 204);
    }

     public function getASingleTask(Task $task)
    {
        //
        // $task = Task::where("id", $id)->get();
        return new TasksResource($task);
    }

    private function isNotAuthorized($task) 
    {
        if (Auth::user()->id !== $task->user_id) {
            return $this->error("", "You are not authorized to make this request", 403);
        }
    }
}