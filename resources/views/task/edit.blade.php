@extends('layout')

@section('styles')
@stop


@section('content')


<form action="{{ route('task.update', [ 'id' => $task->id ] ) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
	<input type="hidden" name="task_id" value="{{ $task->id }}">

<!--
    @foreach( $projects as $project)
    <hr>
    	<strong>Project Name: </strong> {{ $project->project_name }} 
    	<strong>Project ID: </strong> {{ $project->id }} 
    	<strong>Task->Project->ID: </strong> {{  $task->project->id }}
    <hr>
    @endforeach
-->


    <div class="col-md-8">

    	<div class="mb-3">
    		<label class="form-label">Edit Task Title</label>
			<input type="text" class="form-control"  name="task_title" value="{{ $task->task_title }}">
		</div>

		<div class="mb-3">
        <label class="form-label">Add Project Files (png,gif,jpeg,jpg,txt,pdf,doc) <i class="bi bi-file-earmark"></i></label>
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

    	<div class="mb-3">
    		<label class="form-label">Edit task</label>
			<textarea class="form-control my-editor" rows="5" id="task" name="task">{{ $task->task }}</textarea>
		</div>

		<div class="mb-3">
		@if( count($taskfiles) > 0  )
		<label class="form-label">Files</label>
		<ul class="fileslist">
           	@foreach( $taskfiles as $file) 
			    <li>{{ $file->filename }} <span>&nbsp;&nbsp;</span> <a class="btn btn-danger" href="{{ route('task.deletefile', [ 'id' => $file->id]) }}">
					<i class="bi bi-trash"></i></a>
				</li>
			@endforeach
		</ul>
		@endif
       	</div>

	</div>

	<div class="col-md-4">


        <div class="mb-3">
			 <label class="form-label">Assigned to User <i class="bi bi-person-fill"></i></label>

              <select name="user_id" id="user_id" class="form-control">
                    @foreach( $users as $user)
                        <option value="{{ $user->id }}" 
                          @if( $task->user->id == $user->id )
                                selected
                          @endif
                          >{{ $user->name }}
                      	</option>
                    @endforeach
              </select>
        </div>

        <div class="mb-3">
			 <label class="form-label">Assigned to Project <i class="bi bi-pin-angle"></i></label>

              <select name="project_id" id="project_id" class="form-control">
                    @foreach( $projects as $project)
                        <option value="{{ $project->id }}" 
                          @if( $task->project->id == $project->id )
                                selected
                          @endif
                          >{{ $project->project_name }}
                      	</option>
                    @endforeach
              </select>
        </div>

	
		<div class="mb-3">
			<label class="form-label">Edit Priority <i class="bi bi-exclamation-triangle"></i></label>
			<select name="priority" class="form-control">
				@if( $task->priority == 0 )
			  		<option value="0" selected>Normal</option>
			  		<option value="1">High</option>
			    @else
			  		<option value="0">Normal</option>
			  		<option value="1" selected>High</option>
			  	@endif
			</select>
		</div>

		<div class="mb-3">
			<label class="form-label">Edit Status <i class="bi bi-info-circle"></i></label>
			<select name="completed" class="form-control">
				@if( $task->completed == 0 )
			  		<option value="0" selected>Not Completed</option>
			  		<option value="1">Completed</option>
			  	@else
			  		<option value="0">Not Completed</option>
			  		<option value="1" selected>Completed</option>
			  	@endif
			</select>
		</div>


        <div class="mb-3">
            <label class="form-label">Edit Due Date <i class="bi bi-calendar-event"></i></label>
     
			<input type="datetime-local" class="form-control" name="duedate" value="{{ date('Y-m-d\TH:i:s', strtotime($task->duedate)) }}">
        </div>


		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit">
			<a class="btn btn-secondary" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
		</div>
	</div>


</form>

@stop



@section('scripts')
<script src="{{ asset('js/moment.js') }}"></script> 
<?php
if(!empty(getenv('TINY_KEY')))
{
  ?>
<script src="https://cdn.tiny.cloud/1/<?=getenv('TINY_KEY')?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  var editor_config = {
    //path_absolute : "/",
    path_absolute:"{{ url('/') }}/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    },

    //  Add Bootstrap Image Responsive class for inserted images
    image_class_list: [
        {title: 'None', value: ''},
        {title: 'Bootstrap responsive image', value: 'img-responsive'},
    ]

  };

  tinymce.init(editor_config);
</script>
<?php
}
?>

@stop
