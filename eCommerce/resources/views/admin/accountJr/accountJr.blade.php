@extends('admin.layout.master')

@section('content')
    <div class="container-fluid d-flex justify-content-around">
        <div class=" card col-5 offset-2 my-3">
            <div class="card-hearder py-3 bg-light">
                <div class="text-center bg-light fs-3 text-dark">
                    <h3>Junior Admin Account</h3>
                </div>
            </div>

            <form action="{{route('adminJr#create')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body ">
                    @if (session('insertMessage'))
                    <div class="alert alert-light alert-dismissible fade show col-5 offset-7" role="alert">
                        <strong class="text-warning"><i class="bi bi-check-circle-fill"></i> {{session('insertMessage')}}</strong>
                        <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class=" rounded">

                             <div class="form-group mt-3">
                                 <label for="exampleInputPassword1">Name</label>
                                 <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name')
                                     is-invalid
                                 @enderror" id="" placeholder="">
                                 @error('name')
                                     <div class="invalid-feedback">
                                         <span class="text-danger">{{$message}}</span>
                                     </div>
                                 @enderror
                             </div>


                             <div class="form-group mt-3">
                                 <label for="exampleInputPassword1">Email</label>
                                 <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email')
                                     is-invalid
                                 @enderror" id="" placeholder="">
                                 @error('email')
                                     <div class="invalid-feedback">
                                         <span class="text-danger">{{$message}}</span>
                                     </div>
                                 @enderror
                             </div>

                             <div class="form-group mt-3">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="password" name="newPassword" value="" class="form-control @error('newPassword')
                                    is-invalid
                                @enderror" id="exampleInputPassword1" placeholder="">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" name="password-confirmation" value="" class="form-control @error('password-confirmation')
                                    is-invalid
                                @enderror" id="exampleInputPassword1" placeholder="">
                                @error('password-confirmation')
                                    <div class="invalid-feedback">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                            </div>


                    </div>

                 </div>
                 <hr>
                 <div class="d-flex justify-content-between">
                     <p><a href="{{route('account')}}">Back</a></p>
                 <div class=" ">
                     <a href=""><button class="btn btn-outline-primary m-2"  ><i class="bi bi-pencil-square"></i>ADD</button></a>

                 </div>
                 </div>
            </form>



        </div>
        <div class="mt-3">
            <a href="{{route('adminJr#list')}}"><button class="btn btn-secondary">Admin List</button></a>
        </div>
    </div>
@endsection
