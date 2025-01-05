@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
   <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category List</h1>
    </div>

        <div class="d-flex justify-content-around ">
            <div class=" card col-4 h-25">
                <div class="card-body">
                    <form class="my-3" method="POST" action="{{route('category#create')}}">
                        @csrf
                    @if (session('insertMessage'))
                        <div class="alert alert-light alert-dismissible fade show col-6 offset-7" role="alert">
                            <strong class="text-warning"><i class="bi bi-check-circle-fill"></i> {{session('insertMessage')}}</strong>
                            <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Catetory</label>
                        <input type="text" name="category" value="{{old('category')}}" class="form-control @error('category')
                            is-invalid
                        @enderror" id="exampleInputPassword1" placeholder="Category">
                        @error('category')
                            <div class="invalid-feedback">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </form>
                </div>
            </div>

                <div class="col-6">
                <table class="table">
                    <thead>
                    <tr class="bg-light">
                        <th scope="col">ID</th>
                        <th scope="col" class="col-5">Name</th>
                        <th colspan="2" class="col-5" scope="col">
                        @if (session('deleteMessage'))
                            <span class="alert alert-dismissible fade show " role="alert">
                                <strong class="text-danger">{{session('deleteMessage')}} No.{{session('deleteID')}}</strong>
                                <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </span>
                        @endif
                        @if (session('updateMessage'))
                        <span class="alert alert-dismissible fade show " role="alert">
                            <strong class="text-danger">{{session('updateMessage')}} No.{{session('updateID')}}</strong>
                            <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </span>
                        @endif
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->name}}</td>
                        <td>
                            <a href="{{route('category#delete',$item->id)}}">Delete</a>
                        </td>
                        <td>
                            <a href="{{route('category#edit',$item->id)}}">Edit</a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                </div>
        </div>
</div>
@endsection
