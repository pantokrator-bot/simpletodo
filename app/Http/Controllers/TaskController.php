<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Validator;

class TaskController extends Controller
{
    public function index()
    {
        $check_admin = 0;
        $tasks = Task::latest()->get();
        return view('welcome',compact('tasks', 'check_admin'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ["required"],
                'email' => ["required"],
                'task' => ["required"]
            ]
        );
        if($validator->fails())
        {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }
        $post = Task::create([
            'name' => $request->name,
            'email' => $request->email,
            'task' => $request->task,
        ]);
        return redirect()->back();
    }

    public function admin_login(Request $request)
    {
        $tasks = Task::latest()->get();
        $validator = Validator::make(
            $request->all(),
            [
                'admin_name' => ["required"],
                'password' => ["required"],
            ]
        );
        if($validator->fails())
        {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }
        if($request->admin_name != "admin")
        {
            return [
                "status" => false,
                "errors" => "Wrong admin name"
            ];
        }
        if($request->password != "123")
        {
            return [
                "status" => false,
                "errors" => "Wrong password"
            ];
        }
        $check_admin = 1;
        return view('welcome',compact('check_admin','tasks'))->render();
    }

    public function admin_edit(Request $request)
    {

        $check_admin = 1;
        $post = Task::find($request->task_id);
        $post->is_admin = boolval($request->status);
        $post->task = $request->edit_task;;
        $post->save();
        $tasks = Task::latest()->get();
        return view('welcome',compact('check_admin','tasks'))->render();
    }

}
