@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class=" card col-8 offset-2 h-25">
            <div class="card-hearder py-3 bg-light">
                <div class=" text-center fs-3 text-dark">
                    Account Information
                </div>
            </div>
            <div class="card-body row">
               <div class="col-3 ml-5">
                <img class="img-profile img-thumbnail" src="{{asset(Auth::user()->profile == null ? 'admin/img/undraw_profile.svg': 'image/'. Auth::user()->profile )}}">
               </div>
               <div class="col-4 ml-5">
                    <div class="row m-3">
                        <div class="">Name:</div>
                        <div class="ml-2 text-dark">{{Auth::user()->name == null ? Auth::user()->nickname :Auth::user()->name }} </div>
                    </div>
                    <div class="row m-3">
                        <div class="">Email:</div>
                        <div class="ml-2 text-dark">{{Auth::user()->email}} </div>
                    </div>
                    <div class="row m-3">
                        <div class="">Phone:</div>
                        <div class="ml-2 text-dark">{{Auth::user()->phone}} </div>
                    </div>
                    <div class="row m-3">
                        <div class="">Address:</div>
                        <div class="ml-2 text-dark">{{Auth::user()->addrress}} </div>
                    </div>
                    <div class="row m-3">
                        <div class="">Role:</div>
                        <div class="ml-2 fs-4 text-danger">{{Auth::user()->role}} </div>
                    </div>
               </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <p><a href="{{route('admin#home')}}">Back</a></p>
            <div class=" ">
                <a href="{{route('account#edit')}}"><button class="btn btn-outline-primary m-2"  title="Edit Profile"><i class="bi bi-pencil-square"></i></button></a>
                <a href="{{route('password')}}"><button class="btn btn-outline-primary m-2"  title="Change Password"><i class="bi bi-key-fill"></i></button></a>
            </div>
            </div>

        </div>

    </div>
@endsection
