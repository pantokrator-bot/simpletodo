<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simple Todo List</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito';
            }
            .header_form_login
            {
                display: flex;
                height: 250px;
                width: 200px;
                flex-direction: column;
            }
        </style>
    </head>
    <body class="antialiased">
    <header>
        <div class="container">
            <div class="header_form_login">
                @if($check_admin != 1)
                <form method="POST" action="{{route('admin_login')}}">
                    @csrf
                    <div class="form-group">
                        <label for="admin_name">Admin Name</label>
                        <input type="text" class="form-control" name="admin_name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                    @else
                    <p>U r log in</p>
                    <a href="/">Logout</a>
                    @endif
            </div>
        </div>
    </header>
        <div class="container">
            @if($check_admin != 1)
                <form method="GET" action="{{route('create-task')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" class="form-control" name="task" placeholder="Enter task">
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        @if($check_admin == 1)

                            <th scope="col">Edit</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if($check_admin != 1)
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$task->email}}</td>
                                <td>{{$task->task}}</td>
                                <td>@if($task->is_admin==1)  отредактировано администратором @endif</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$task->email}}</td>
                                <td>{{$task->task}}</td>
                                <td>@if($task->is_admin==1)  отредактировано администратором @endif</td>
                                <td>
                                    <form method="POST" action="{{route('admin_edit')}}">
                                        @csrf
                                        <input type="hidden" name="task_id" value={{$task->id}}"">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" @if($task->is_admin==1) checked @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_task">Edit task</label>
                                            <input type="text" class="form-control" name="edit_task" placeholder="Edit task">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>


                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

        </div>


    </body>
</html>
