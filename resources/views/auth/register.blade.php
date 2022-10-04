@extends('layout.app')
@section('content')
  <form action="{{ route('register') }}" method="POST">
    @csrf

   

    <div class="form-group">
      <label for="">Name</label>
      <input type="text" name="name" value="{{ old('name') }}" required class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
      
      @if ($errors->has('name'))
    
        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
      @endif
    </div>

    <div class="form-group">
      <label for="">Email</label>
      <input name="email" value="{{ old('email') }}" required class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">

      @if ($errors->has('email'))
      <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
    @endif
    </div>

    <div class="form-group">
      <label for="">Password</label>
      <input type="password" name="password" required class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">

      @if ($errors->has('password'))
      <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
    @endif
    </div>

    <div class="form-group">
      <label for="">Retyped Password</label>
      <input type="password" name="password_confirmation" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary btn-block">Register</button>

  </form>
@endsection