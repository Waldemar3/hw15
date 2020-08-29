@extends('layout')

@section('content')
    <form action="" method="post">
        @csrf
        <div class="form-group">
            @error('title')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
            <label for="title">Ad Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            @error('description')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>

            @enderror
            <label for="description">Ad Description</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="Create" />
    </form>
@endsection
