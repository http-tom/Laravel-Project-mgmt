@extends('layout')

@section('content')


<h1>LIST OF ACTIVE PROJECTS</h1>

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus"></i>&nbsp;Add New Project</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Enter Project Title</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="project_form" action="{{ route('project.store') }}" method="POST">
            {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
            <div class="mb-3">
              <input type="text" class="form-control" id="project" name="project">
            </div>
          </div>

        </div>

        <div class="modal-footer d-flex">
          <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Close</button>
          <input class="btn btn-primary" type="submit" value="Submit">
        </div>

        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->



@if ( !$projects->isEmpty() ) 
<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Project Name</th>
        <th>Project Tasks List</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
    @foreach ( $projects  as $project)
      <tr>
        <td>{{ $project->project_name }} </td>
        <td>
           <a href="{{ route('task.list', [ 'projectid' => $project->id ]) }}">List all tasks</a>
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('project.edit', [ 'id' => $project->id ]) }}"><i class="bi bi-pencil-square"></i></a>          
          <a class="btn btn-danger" href="{{ route('project.delete', [ 'id' => $project->id ]) }}" Onclick="return ConfirmDelete();"><i class="bi bi-trash"></i></a>&nbsp;&nbsp;
        </td>

      </tr>

    @endforeach
    </tbody>
    
    
  </table>
</div>

<a href="/admin/projects/download/csv" class="btn btn-primary">Download</a>

@else 
    <p><em>There are no tasks assigned yet</em></p>
@endif


@stop


<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Project will also delete all tasks associated with this project");
  if (x)
      return true;
  else
    return false;
}




</script>  
