@extends('layout')

@section('content')

@include('includes.errors') 

<form id="project_form" action="{{ route('project.store') }}" method="POST">
    {{ csrf_field() }}

<label class="form-label">Create a new Project <i class="bi bi-plus"></i></label>

<div class="row">
    <div class="col-md-8">
		<div class="mb-3">
			<input type="text" class="form-control" id="project" name="project">
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

<script>
function validateForm() {
	console.log("VALIDATE FORM CLICKED") ;
	var project = document.forms["project_form"]["project"].value;

	if ( !project.length ) {
		swal("Enter Project Name", "" , "warning") ;
		document.getElementById("project").focus();
		return false;
	}
}

</script>

