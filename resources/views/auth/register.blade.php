@extends('main')
@section('content')
<title>Register - TEST</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section>
    <h1>Create New Account</h1>
    <form method="post" action="{{ route('post.register') }}">
        @csrf
        <div class="form-row"><label for="fc_1">Username *</label>
            <input id="fc_1" name="username" required="" autofocus="" minlength="3" maxlength="40" class="">
        </div>
        @error('username')
        <p class="text-danger">{{ $errors->first('username') }}</p>
        @enderror
        <div class="form-row"><label for="fc_2">Password *</label>
            <input id="fc_2" name="password" type="password" minlength="8" required="">
        </div>
        <div class="form-row"><label for="fc_3">Repeat password *</label>
            <input id="fc_3" name="password_confirmation" type="password" minlength="8" required="">
        </div>
        <div class="form-row">
            <button class="submit-btn" type="submit">Create account</button>
        </div>
    </form>
</section>

@stop