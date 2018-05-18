@if ($message = Session::get('success'))
<div class="alert alert-success" data-dismiss="alert" aria-label="Close" >
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <p>{{ $message }}</p>
</div>
@endif
