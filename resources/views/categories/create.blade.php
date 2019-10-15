@extends('layouts.app')

@section('content')


    <div class="card card-default">
        <div class="card-header">
            Create Category
        </div>
        <div class="card-body">
            <form action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="category ">
            </div>
            <div class="form-gropup">
                <button class="btn btn-success">Add Category</button>
            </div>
            </form>
        </div>
    </div>
@endsection
