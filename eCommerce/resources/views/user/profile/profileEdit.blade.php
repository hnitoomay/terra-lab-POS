@extends('user.layout.master')

@section('content')
<div class="container-fluid py-5  hero-header">
    <div class=" card col-6 offset-3 ">
        <div class="card-hearder py-3 bg-light">
            <div class=" text-center fs-3 text-dark">
                Account Information
            </div>
        </div>
        <form action="{{route('user#update',Auth::user()->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body row">
                <input type="hidden" name="userID" value="{{Auth::user()->id}}">
                <div class="col-5 me-3 ">
                     <img class="img-profile img-thumbnail" src="{{asset(Auth::user()->profile == null ?'admin/img/undraw_profile.svg': 'image/'. Auth::user()->profile )}}">
                     <div class="form-group mt-3">
                         <label for="exampleInputPassword1">Change profile</label>
                         <input type="file" name="profile" value="" class="form-control @error('profile')
                             is-invalid
                         @enderror" id="" placeholder="">
                         @error('profile')
                             <div class="invalid-feedback">
                                 <span class="text-danger">{{$message}}</span>
                             </div>
                         @enderror
                     </div>
                </div>
                <div class="col-6 ml-5 bg-light rounded">

                         <div class="form-group mt-3">
                             <label for="exampleInputPassword1">Name</label>
                             <input type="text" name="name" value="{{old('name',Auth::user()->name)}}" class="form-control @error('name')
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
                             <input type="email" name="email" value="{{old('email',Auth::user()->email)}}" class="form-control @error('email')
                                 is-invalid
                             @enderror" id="" placeholder="">
                             @error('email')
                                 <div class="invalid-feedback">
                                     <span class="text-danger">{{$message}}</span>
                                 </div>
                             @enderror
                         </div>


                         <div class="form-group mt-3">
                             <label for="exampleInputPassword1">Phone</label>
                             <input type="text" name="phone" value="{{old('phone',Auth::user()->phone)}}" class="form-control @error('phone')
                                 is-invalid
                             @enderror" id="" placeholder="">
                             @error('phone')
                                 <div class="invalid-feedback">
                                     <span class="text-danger">{{$message}}</span>
                                 </div>
                             @enderror
                         </div>


                         <div class="form-group mt-3">
                             <label for="exampleInputPassword1">Address</label>
                             <input type="text" name="address" value="{{old('address',Auth::user()->addrress)}}" class="form-control" id="" placeholder="">

                         </div>

                </div>

             </div>
             <hr>
             <div class="d-flex justify-content-between">
                 <p><a href="{{route('user#profile')}}" class="m-3">Back</a></p>
             <div class=" ">
                 <a href=""><button class="btn btn-outline-primary m-2"  ><i class="bi bi-pencil-square"></i>Update</button></a>

             </div>
             </div>
        </form>


    </div>

</div>
@endsection
