@extends('layout')

@section('content')

<!--
<strong>Debug vars:</strong><br>
task_view->project->id :  {{ $task_view->project->id }} <br>
task_view->project->project_name: {{ $task_view->project->project_name }}  <br>
task_view->id: {{ $task_view->id }}<br>
-->


<div class="col-md-8">
    <h1>{{ $task_view->task_title }}</h1>

    <div class="mb-3">
        <label class="form-label">Description:</label>
        <p>{!! $task_view->task !!}</p>
    </div>
        

    <div class="btn-group">
        <a href="{{ route('task.edit', ['id' => $task_view->id ]) }}" class="btn btn-primary">Edit</a>
        <a class="btn btn-secondary" href="{{ route('task.show') }}">Go Back</a>
    </div>

    <div class="row my-3">
        @if( count($images_set) > 0 ) 
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">Uploaded Images</div>
                    <div class="card-body">
                        <ul id="images_col">
                            @foreach ( $images_set as $image )
                                <li> 
                                    <a href="<?php echo asset("images/$image") ?>" data-lightbox="images-set">
                                        <img class="img-responsive" src="<?php echo asset("images/$image") ?>">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


        
        @if( count($files_set) > 0 ) 
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header"> Uploaded Files</div>
                    <div class="card-body">
                        <ul id="images_col">
                            @foreach ( $files_set as $file )
                                <li> 
                                    <a target="_blank" href="<?php echo asset("images/$file") ; ?>">{{ $file }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


    </div>



</div>

<div class="col-md-4">


    <div class="card mb-3">
        <div class="card-header">Project</div>
        <div class="card-body">
            <span>
                <a href="{{ route('task.list', [ 'projectid' => $task_view->project->id ]) }}">{{ $task_view->project->project_name }}</a>
            </span>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Priority</div>
        <div class="card-body">
            @if ( $task_view->priority == 0 )
                <span class="badge bg-info">Normal</span>
            @else
                <span class="badge bg-danger">High</span>
            @endif
        </div>
    </div>



    <div class="card mb-3">
        <div class="card-header">Created</div>
        <div class="card-body">
            {{ $formatted_from }} 
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Due Date</div>
        <div class="card-body">
            {{ $formatted_to }} 
        </div>
    </div>


    <div class="card mb-3">
        <div class="card-header">Status</div>
        <div class="card-body">
            @if ( $task_view->completed == 0 )
                <span class="badge bg-warning">Open</span>
                @if ( $is_overdue )
                    <span class="badge bg-danger">Overdue</span>
                @else
                    <p><br>{{ $diff_in_days }} days left to complete this task</p>
                @endif                
            @else
                <span class="badge bg-success">Closed</span>
            @endif
        </div>
    </div>

</div>

@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@stop


@section('scripts')
    <script src="{{ asset('js/lightbox.min.js') }}"></script>  

@stop


