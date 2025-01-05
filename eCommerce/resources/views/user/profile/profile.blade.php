@extends('user.layout.master')

@section('content')
<div class="container-fluid py-5  hero-header">
    <div class=" card col-6 offset-3 ">
        <div class="card-hearder py-3 bg-light">
            <div class=" text-center fs-3 text-dark">
                Account Information
            </div>
        </div>
        <div class="card-body row">
            <div class="col-2"></div>
           <div class="col-3 ml-5">
            <img class="img-profile img-thumbnail" src="{{asset(Auth::user()->profile == null ? 'admin/img/undraw_profile.svg': 'image/'. Auth::user()->profile )}}">
           </div>
           <div class="col-4 ml-5">
                <div class="d-flex m-3">
                    <div class="me-2 ">Name:</div>
                    <div class="me-2 text-dark">{{Auth::user()->name == null ? Auth::user()->nickname :Auth::user()->name }} </div>
                </div>
                <div class="d-flex m-3">
                    <div class="me-2 ">Email:</div>
                    <div class="ml-2 text-dark">{{Auth::user()->email}} </div>
                </div>
                <div class="d-flex m-3">
                    <div class="me-2 ">Phone:</div>
                    <div class="ml-2 text-dark">{{Auth::user()->phone}} </div>
                </div>
                <div class="d-flex m-3">
                    <div class="me-2 ">Address:</div>
                    <div class="ml-2 text-dark">{{Auth::user()->addrress}} </div>
                </div>

           </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <p><a href="{{route('user#home')}}" class="m-3">Back</a></p>
        <div class=" ">
            <a href="{{route('user#edit')}}"><button class="btn btn-outline-primary m-2"  title="Edit Profile"><i class="bi bi-pencil-square"></i></button></a>
            <a href=""><button class="btn btn-outline-primary m-2"  title="Change Password"><i class="bi bi-key-fill"></i></button></a>
        </div>
        </div>

    </div>

</div>
@endsection
