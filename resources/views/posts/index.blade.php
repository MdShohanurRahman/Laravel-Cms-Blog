@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success float-right">Add Posts</a>
</div>

<div class="card card-default">
    <div class="card-header">
        Posts
    </div>
    
</div>

@endsection
