@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>USERS</h1>
    </div>
</div>


<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus"></i>&nbsp;Add New User</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Enter User Information</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
        <form id="task_form" action="{{ route('user.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <label class="form-label">Create new User <i class="bi bi-plus"></i></label>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter User Full Name" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter User Email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Enter User Password" name="password">
                        </div>

                </div>

                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label">Set Status <i class="bi bi-info-circle"></i></label>
                        <select name="admin" class="form-control">
                            <option value="0" selected>Disabled (default)</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <input class="btn btn-primary" type="submit" value="Submit" >
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>


        </form>
       </div>

    </div>

  </div>
</div>
<!--  END modal  -->





<table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$users->isEmpty() ) 
    <tbody>
    @foreach ( $users as $user)
    @if ( $user->id == 1 )  @continue 
    @endif
      <tr>
        <td><a href="{{ route('user.list', ['id'=> $user->id] ) }}">{{ $user->name }}</a></td>

        <td>{{ $user->email }}</td>
    
        <td>
            @if ( !$user->admin )
                <a href="{{ route('user.activate', ['id' => $user->id]) }}" class="btn btn-warning"> Activate User</a>
            @else
                <a href="{{ route('user.disable', ['id' => $user->id]) }}" class="btn btn-warning"> Disable User</a>
                <span class="badge bg-success">Active</span>
            @endif
        </td>
        <td>
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
 
            <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger" onclick="return ConfirmDelete();"><i class="bi bi-trash"></i></a>

        </td>
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>There are no users yet</em></p>
@endif


</table>



@stop

<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a User will also delete all tasks associated.");
  if (x)
      return true;
  else
    return false;
}




</script>  


