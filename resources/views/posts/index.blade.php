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
        @if ($posts->count()>0)
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th></th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset('images/posts/'. $post->image) }}" width="50px" height="50px"
                            alt="{{ $post->title }}">
                    </td>
                    <td>{{$post->title}}</td>

                <td>
                <a href="{{route('categories.edit',$post->category->id)}}">{{$post->category->name}}</a>
                </td>

                    @if($post->trashed())
                    <td>
                        <form action="{{ route('restore-posts', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info btn-sm">Restore</button>
                        </form>
                    </td>
                    @else
                    <td>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
                    </td>
                    @endif

                    <td>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#deletepost">
                            {{$post->trashed() ? 'Delete':'Trashed'}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="deletepost" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{$post->trashed() ? 'Delete':'Trashed'}} Post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center text-bold">
                                            Are you sure to {{$post->trashed() ? 'delete':'trashed'}} this
                                            Post ?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                {{$post->trashed() ? 'Delete':'Trashed'}}</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

        @else

        <h3 class="text-center">No post found</h3>

        @endif
    </div>

</div>

@endsection
