@extends('layout')

@section('content')


<h1>Displaying Results for:  "{{ $value }}" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Task Title</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$tasks->isEmpty() ) 
    <tbody>
    @foreach ( $tasks as $task)
      <tr>
        <td>{{ $task->task_title }} </td>
        <td>
            @if ( $task->priority == 0 )
                <span class="badge bg-info">Normal</span>
            @else
                <span class="badge bg-danger">High</span>
            @endif
        </td>
        <td>
            @if ( !$task->completed )
                <a href="{{ route('task.completed', ['id' => $task->id]) }}" class="btn btn-warning"> Mark as completed</a>
            @else
                <span class="badge bg-success">Completed</span>
            @endif
        </td>
        <td>
            <!-- <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary"> edit </a> -->
            <a href="{{ route('task.view', ['id' => $task->id]) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
            <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>

        </td>
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>No match found</em></p>
@endif


</table>



    <div class="btn-group">
        <a class="btn btn-secondary" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
    </div>



@stop