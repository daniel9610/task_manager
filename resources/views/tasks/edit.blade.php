@extends('layouts.app')
@section('content')
@include('flash::message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 5%;">
                <div class="card-header">{{ __('Update your task') }}</div>
                <div class="card-body">
                    <form action="{{ route('tasks.update') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control" id="task_id" name="task_id"
                                    value="{{$task->id}}" required hidden>
                        <input type="text" class="form-control" id="done" name="done"
                                    value="{{$task->done}}" required hidden>
                        <div class="container">
                            <div class="form-group taskForm">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$task->title}}"
                                    placeholder="Enter task..." required>
                            </div>
                            <div class="form-group taskForm">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{$task->description}}" placeholder="Description" required>
                            </div>
                            <div class="form-group taskForm">
                                <label for="priority">Priority</label>
                                <select id="priority" name="priority" class="form-select" value="{{$task->priority}}"
                                    required>
                                    <option value="top">Top Priority</option>
                                    <option value="middle">Middle Priority</option>
                                    <option value="low">Less Priority</option>
                                </select>
                            </div>
                            <div class="form-group taskForm">
                                <label for="deadline">Deadline</label>
                                <input type="date" id="deadline" name="deadline" class="datepicker"
                                    value="{{$task->deadline}}" required>
                            </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection