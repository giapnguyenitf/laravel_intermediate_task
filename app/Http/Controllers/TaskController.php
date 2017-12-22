<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Session;
use App\Http\Requests\AddTaskRequest;
use App\User;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if (Auth::check()) {
            $tasks = $request->user()->tasks()->get();

            return view('tasks')
                ->with([
                    'tasks' => $tasks,
                ]);
        }

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTaskRequest $request)
    {
        try {
            $request->user()->tasks()
                ->create([
                'name' => $request->input('name'),
                ]);
            Session::flash('messages', trans('messages.add_task_success'));

            return redirect('/tasks');   
        } catch(Exception $e) {
            Session::flash('messages', trans('messages.add_task_fail'));

            return back()
                ->withErrors()
                ->withInput([
                    'name' => $request->input('name'),
                ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        $user = Auth::user();
        if ($user->can('delete', $task)) {
            if($task->delete()) {
                Session::flash('messages', trans('messages.delete_task_success'));
    
                return redirect('/tasks');
            } else {
                Session::flash('messages', trans('messages.delete_task_fail'));
                
                return back();
            }
        } else {
            return redirect('/tasks')
                ->with([
                    'messages' => trans('messages.can_not_delete'),
                ]);
        }
       
    }
}
