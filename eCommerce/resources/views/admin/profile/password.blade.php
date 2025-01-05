@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class=" card col-4 offset-4 h-25">
            <div class="card-body">
                <form class="mt-3" method="POST" action="{{route('password#change')}}">
                    @csrf

                    @if (session('updateSuccess'))
                    <span class="alert alert-dismissible fade show text-end" role="alert">
                        <strong class="text-warning">{{session('updateSuccess')}}</strong>
                        <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    </span>
                    @endif
                    @if (session('updateFail'))
                    <span class="alert alert-dismissible fade show d-flex justify-content-end" role="alert">
                        <strong class="text-danger">{{session('updateFail')}}</strong>
                        <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
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
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
            </div>
            <hr>
            <p><a href="{{route('account')}}">Back</a></p>
        </div>

    </div>
@endsection
