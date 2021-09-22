@extends('layout')

@section('content')

@include('includes.errors') 

<form id="project_form" action="{{ route('project.update', [ 'id' => $edit_project->id ]) }}" method="POST">
    {{ csrf_field() }}

<label class="form-label">Edit Project <i class="bi bi-pencil-square"></i></label>

<div class="row">
    <div class="col-md-8">
		<div class="mb-3">
			<input type="text" class="form-control" id="project" name="name" value="{{ $edit_project->project_name }}">
		</div>
	</div>


	<div class="col-md-4">
		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit" onclick="return validateForm()">
			<a class="btn btn-secondary" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
		</div>
	</div>
</div>

</form>

@stop


