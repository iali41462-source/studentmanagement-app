@extends('layouts.layout')
@section('content')

<div class="card">
  <div class="card-header">Edit Page</div>
  <div class="card-body">

      @if ($errors->any())
          <div class="alert alert-danger">
              <strong>There were some problems with your input.</strong>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

       <form action="{{ route('students.update', $student->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

          <input type="hidden" name="id" id="id" value="{{ $student->id }}" />

          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="form-control">
              @error('name')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>

          <div class="form-group">
              <label for="address">Address</label>
              <input type="text" name="address" id="address" value="{{ old('address', $student->address) }}" class="form-control">
              @error('address')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>

          <div class="form-group">
              <label for="mobile">Mobile</label>
              <input type="text" name="mobile" id="mobile" value="{{ old('mobile', $student->mobile) }}" class="form-control">
              @error('mobile')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>
            <div class="form-group">
                <label for="photo">Photo</label>
            <div>
                                           @if($student->photo)
    <img src="{{ asset('storage/' . $student->photo) }}"
         width="120"
         class="img-thumbnail mt-2">
@endif
            </div>
                <input type="file" name="photo" id="photo" class="form-control">
                @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror


          <button type="submit" class="btn btn-success">Update</button>
      </form>

  </div>
</div>
@stop
