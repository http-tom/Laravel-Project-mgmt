@extends('layout')

@section('content')

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>ALL TASKS</h1>
    </div>

    <div class="col-md-6">
        <form action="{{ route('task.search') }}" class="navbar-form" role="search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search in Tasks..." name="search_task">
                <button type="submit" class="btn btn-secondary">
                    <i class="bi bi-search">
                        <span class="visually-hidden">Search...</span>
                    </i>
                </button>
            </div>
        </form>
    </div> 

</div>

<?php
$dir = isset($direction) && $direction == 'asc' ? 'desc' : 'asc';
?>

@if ( !$tasks->isEmpty() )
<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Created</th>
            <th><a href="{{ route('task.sort', [ 'key' => 'task' ]) }}">Task Title <i class="bi bi-sort-alpha-down"></i> </a></th>
            <th>Assigned To / Project</th>
            <th><a href="{{ route('task.sort', [ 'key' => 'due', 'dir' => $dir ]) }}">Due <i class="bi bi-sort-alpha-down"></i> </a></th>
            <th><a href="{{ route('task.sort', [ 'key' => 'priority' ]) }}">Priority <i class="bi bi-sort-alpha-down"></i> </a></th>
            <th><a href="{{ route('task.sort', [ 'key' => 'completed' ]) }}">Status <i class="bi bi-sort-alpha-down"></i> </a></th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    @foreach ( $tasks as $task)
      <tr>
        <td>{{ Carbon\Carbon::parse($task->created_at)->format('m-d-Y') }}</td>
        <td>{{ $task->task_title }} </td>

        <td>
         
            @foreach( $users as $user) 
                @if ( $user->id == $task->user_id )
                    <a href="{{ route('user.list', [ 'id' => $user->id ]) }}">{{ $user->name }}</a>
                @endif
            @endforeach
            <span class="badge bg-success bg-gradient p-2">{{ $task->project->project_name }}</span>

        </td>
        <td>
            @if ( !$task->completed )
                {{ $task->duedate }}
            @else
                &nbsp;
            @endif
        </td>

        <td class="text-center">
            @if ( $task->priority == 0 )
                <span class="badge bg-info">Normal</span>
            @else
                <span class="badge bg-danger">High</span>
            @endif
            @if ( !$task->completed )
                <br/><div class="badge bg-danger">{{ ( $task->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</div>
            @else
            @endif
        </td>
        <td class="text-center">
            @if ( !$task->completed )
                <a href="{{ route('task.completed', ['id' => $task->id]) }}" class="btn btn-warning"> Mark as completed</a>
                {{-- <span class="badge bg-danger">{{ ( $task->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</span> --}}
            @else
                <span class="badge bg-success">Completed</span>
            @endif
  
            

        </td>
        <td style="width:10%;">
            <!-- <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary">Edit</a>  -->
            <a href="{{ route('task.view', ['id' => $task->id]) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
            <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>

        </td>
      </tr>

    @endforeach
    </tbody>

    {{ $tasks->links() }}

</table>
</div>


<a href="/admin/tasks/download/csv" class="btn btn-primary">Download</a>

@else 
    <p><em>There are no tasks assigned yet</em></p>
@endif


@stop