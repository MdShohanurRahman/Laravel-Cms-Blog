@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success float-right">Add Posts</a>
</div>

<div class="card card-default">
    <div class="card-header">
        Posts
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <img src="{{ asset('images/posts/'. $post->image) }}"
                                width="50px" height="50px" alt="{{ $post->title }}" >
                        </td>
                        <td>{{$post->title}}</td>
                        <td>
                            <a href="" class="btn btn-info">Edit</a>
                            <a href="" class="btn btn-danger">Trash</a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
