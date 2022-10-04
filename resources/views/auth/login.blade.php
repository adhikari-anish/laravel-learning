@extends('layout.app')
@section('content')
  <form action="{{ route('login') }}" method="POST">
    @csrf

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
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" value="{{ old('remember') ? 'checked' : '' }}">
        <label for="remember" class="form-check-label">Remember me</label>
      </div>

    </div>


    <button type="submit" class="btn btn-primary btn-block">Login</button>

  </form>
@endsection