@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class=" card col-4 h-25">
            <div class="card-body">
                <form class="mt-3" method="POST" action="{{route('category#update',$categories->id)}}">
                    @csrf

                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Catetory</label>
                        <input type="text" name="category" value="{{old('category',$categories->name)}}" class="form-control @error('category')
                            is-invalid
                        @enderror" id="exampleInputPassword1" placeholder="Category">
                        @error('category')
                            <div class="invalid-feedback">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <hr>
            <p><a href="{{route('category#list')}}">Back</a></p>
        </div>

    </div>
@endsection
