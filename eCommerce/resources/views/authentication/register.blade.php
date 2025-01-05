@extends('authentication.master')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">

            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" action="{{route('register')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="Name">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control form-control-user" id="exampleLastName"
                                    placeholder="Phone Number">
                                @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Email Address">
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="Password">
                                @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" name="password_confirmation" class="form-control form-control-user"
                                    id="exampleRepeatPassword" placeholder="Repeat Password">
                                @error('password_confirmation')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                        <hr>

                    </form>
                    <hr>

                    <div class="text-center">
                        <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
