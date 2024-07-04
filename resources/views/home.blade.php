@extends('layouts.app')

@section('content')
@include('flash::message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 5%;">
            <div class="card-header">{{ __('Create a new task') }}</div>
            <div class="card-body">
                <form  action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row gx-1 justify-content-center">
                            <div class="col-lg-2 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter task..." required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="form-group">
                                    <select id="priority" name="priority" class="form-select" required>
                                        <option value="top">Top Priority</option>
                                        <option value="middle">Middle Priority</option>
                                        <option value="low">Less Priority</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6" style="padding-top:6px;">
                                <div class="form-group">
                                    <input type="date" id="deadline" name="deadline" class="datepicker" required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>

            <div class="card" style="margin-bottom: 5%">
                <div class="card-header d-flex justify-content-between align-items-center">

                    {{ __('To do list') }}
                    <div>
                        <form action="">
                            <input type="text" value="{{$search}}" class="form-control" name="search" placeholder="Search"></input>
                        </form>
                    </div>
 
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="task-list" id="task-list">
                        <!-- Tasks will be added here dynamically -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $key => $task)
                                <tr>
                                    <td>{{$task->title}}</td>
                                    <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;">{{$task->description}}</td>
                                    <td>{{$task->priority}}</td>
                                    <td>{{$task->deadline}}</td>
                                    <td>
                                        @if ($task->done)
                                            <a class="btn btn-secondary" href="{{route('tasks.mark_as_done', ['task_id' => $task->id])}}">Mark as pending</a><br>

                                        @else
                                            <a class="btn btn-success" href="{{route('tasks.mark_as_done', ['task_id' => $task->id])}}">Mark as done</a><br>
                                        @endif
                                        <a class="btn btn-warning" href="{{route('tasks.edit', ['task_id' => $task->id])}}">Edit</a><br>
                                        <a class="btn btn-danger" href="{{route('tasks.delete', ['task_id' => $task->id])}}">Delete</a><br>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          
                            </table>
                            <div class="mt-6">
                            <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                {{$tasks->appends(request()->input())->links('pagination::bootstrap-4')}}
                            </ul>
                            </nav>
                            </div>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role == 'admin')
                @include('admin.users_table')
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#createTask').click(function(e){
        console.log("hola");
    e.preventDefault(); 
    $.ajax({
        url: '{{url("create_task")}}',
        data: $("#task-form").serialize(),
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            alert("okay");
        }, 
        error: function(){
              alert("failure From php side!!! ");
         }
        }); 
        });
</script>
@endpush

