@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
@endif

@if(session('message'))
  <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  {{ session('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(session('message_error'))
  <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    {{ session('message_error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
