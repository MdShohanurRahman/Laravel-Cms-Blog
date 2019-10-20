@if (session()->has('success'))
<div class="alert alert-success">
    {{session()->get('success')}}
</div>
@endif


@if (session()->has('errors'))
<div class="alert alert-danger">
    {{session()->get('errors')}}
</div>
@endif
