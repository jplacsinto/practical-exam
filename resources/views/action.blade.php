<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu dropdown-menu-right">

  	<a class="dropdown-item" href="{{ route('clients.edit', $user->id) }}" role="button">Edit</a>
	<a class="dropdown-item delete-confirm" href="#" data-id="{{$user->id}}" role="button">Delete</a>

  </div>
</div>