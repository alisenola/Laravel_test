@if($errors->any())
<div class="alert alert-warning text-center" role="alert">
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>

@endif