@extends('user.layout.master')

@section('content')
<div class="container-fluid py-5  hero-header">
    <div class=" card col-4 offset-4 ">
        <div class="card-hearder py-3 bg-light">
            <div class=" text-center fs-3 text-dark">
                Change Password
            </div>
        </div>
        <div class="card-body">
            <form class="mt-3" method="POST" action="{{route('password#update')}}">
                @csrf

                @if (session('updateSuccess'))
                <span class="alert alert-dismissible fade show d-flex justify-content-end" role="alert">
                    <strong class="text-warning">{{session('updateSuccess')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </span>
                @endif
                @if (session('updateFail'))
                <span class="alert alert-dismissible fade show d-flex justify-content-end" role="alert">
                    <strong class="text-danger">{{session('updateFail')}}</strong>

                </span>
                @endif

                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Old Password</label>
                    <input type="password" name="oldPassword" value="" class="form-control @error('oldPassword')
                        is-invalid
                    @enderror" id="exampleInputPassword1" placeholder="">
                    @error('oldPassword')
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

                <div class="d-flex justify-content-between">
                    <p class="mt-3"><a href="{{route('user#home')}}" class="mt-3">Back</a></p>
                    <div class=" ">
                        <button type="submit" class="btn btn-primary mt-3">Change</button>
                    </div>
                </div>
            </form>
        </div>


    </div>

</div>
@endsection
