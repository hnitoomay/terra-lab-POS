@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
   <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payment List</h1>
    </div>

        <div class="d-flex justify-content-between ">
            <div class=" card col-4 h-25">
                <div class="card-body">
                    <form class="my-3" method="POST" action="{{route('payment#create')}}">
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
                            <label for="exampleInputPassword1">Account Number</label>
                            <input type="text" name="accnumber" value="{{old('accnumber')}}" class="form-control @error('accnumber')
                                is-invalid
                            @enderror" id="exampleInputPassword1" placeholder="">
                                @error('accnumber')
                                    <div class="invalid-feedback">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleInputPassword1">Account Name</label>
                            <input type="text" name="accname" value="{{old('accname')}}" class="form-control @error('accname')
                                is-invalid
                            @enderror" id="exampleInputPassword1" placeholder="">
                                @error('accname')
                                    <div class="invalid-feedback">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleInputPassword1">Account Type</label>
                            <input type="text" name="acctype" value="{{old('acctype')}}" class="form-control @error('acctype')
                                is-invalid
                            @enderror" id="exampleInputPassword1" placeholder="">
                                @error('acctype')
                                    <div class="invalid-feedback">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </form>
                </div>
            </div>

                <div class="col-7">
                <table class="table">
                    <thead>
                    <tr class="bg-light">
                        <th scope="col">ID</th>
                        <th scope="col" class="col-4">Account Number</th>
                        <th scope="col" class="col-4">Account Name</th>
                        <th scope="col" class="col-5">Account Type</th>
                        <th colspan="2" class="col-5" scope="col">
                        @if (session('deleteMessage'))
                            <span class="alert alert-dismissible fade show " role="alert">
                                <strong class="text-danger">{{session('deleteMessage')}}</strong>
                                <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </span>
                        @endif
                        @if (session('updateMessage'))
                        <span class="alert alert-dismissible fade show " role="alert">
                            <strong class="text-danger">{{session('updateMessage')}}</strong>
                            <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </span>
                        @endif
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($payment as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->account_number}}</td>
                            <td>{{$item->account_name}}</td>
                            <td>{{$item->account_type}}</td>
                            <td>
                                <a href="{{route('payment#delete',$item->id)}}">Delete</a>
                            </td>
                            {{-- <td>
                                <a href="">Edit</a>
                            </td> --}}
                        </tr>

                    @endforeach


                    </tbody>
                </table>
                </div>
        </div>
</div>
@endsection
