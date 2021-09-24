@extends('layout')


@section('styles')

@stop


@section('content')

@include('includes.errors') 

<form id="task_form" action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="col-md-8">
        <label class="form-label">Create new task <i class="bi bi-plus"></i></label>

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Enter Task Title" name="task_title">
        </div>

        <label class="form-label">Add Project Files (png,gif,jpeg,jpg,txt,pdf,doc) <i class="bi bi-file-earmark"></i></label>
		<div class="mb-3">
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

        <div class="mb-3">
            <textarea class="form-control my-editor" rows="10" id="task" name="task"></textarea>
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Assign to Project <i class="bi bi-pin-angle"></i></label>
            <select name="project_id" class="form-control selectpicker" data-style="btn-primary" style="width:100%;">
                @foreach( $projects as $project )
                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                 @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Assign to: <i class="bi bi-person-fill"></i></label>
            <select id="user" name="user" class="form-control selectpicker" data-style="btn-info" style="width:100%;">
				@foreach ( $users as $user)
					<option value="{{ $user->id }}">{{ $user->name }}</option>
				@endforeach

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Priority <i class="bi bi-exclamation-triangle"></i></label>
            <select name="priority" class="form-control selectpicker" data-style="btn-info" style="width:100%;">
              <option value="0">Normal</option>
              <option value="1">High</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Due Date <i class="bi bi-calendar-event"></i></label>
            <input type="datetime-local" class="form-control" name="duedate">
        </div>

        <div class="btn-group">
            <input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
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





