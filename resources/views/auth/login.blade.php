@extends('main')
@section('content')
<title>Login - TEST</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section>
    <div class="cards">
        <div class="card">
            <h3>Have account?</h3>
            <form method="post" action="{{ route('post.login') }}">
                @csrf
                <div class="form-row"><label for="fc_1">Login *</label>
                    <input id="fc_1" name="username" required="" autofocus="">
                </div>
                <div class="form-row"><label for="fc_2">Password *</label>
                    <input id="fc_2" name="password" type="password" minlength="8" required="">
                </div>
                <div class="form-row">
                    <button class="submit-btn" type="submit"><i class="fas fa-key"></i> Sign in</button>
            </form>
        </div>
        <div class="card">
            <h3>No account?</h3>
            <p><a href="{{ route('register') }}" class="button"><i class="fas fa-user"></i> Create new account</a></p>
        </div>
    </div>
</section>
@stop