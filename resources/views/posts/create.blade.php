@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">Create Post</div>
    <div class="card-body">
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" name="description" cols="5" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" class="form-control" name="content" cols="5" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" name="published_at" id="published_at">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="form-group">
                <button type='submit' class="btn btn-success">Create Post</button>
            </div>

        </form>
    </div>

</div>

@endsection