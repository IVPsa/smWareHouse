@extends('layouts.app')

<form action="#" class="form-inline">
   @csrf
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name">
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

@section('content')
@endsection
