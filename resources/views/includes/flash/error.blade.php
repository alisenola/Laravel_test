@if(session()->has('error'))
<div class="alert alert-warning text-center" role="alert">
    {{ session()->get('error') }}
</div>
@endif