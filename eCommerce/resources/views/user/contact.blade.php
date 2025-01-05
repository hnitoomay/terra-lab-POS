@extends('user.layout.master')

@section('content')
<div class="container-fluid py-5  hero-header">
    <div class=" card col-4 offset-4 ">
        <div class="card-hearder py-3 bg-light">
            <div class=" text-center fs-3 text-dark">
                Contact Us
            </div>
        </div>
        <div class="card-body">
            <form class="mt-3" method="POST" action="{{route('contact#create')}}">
                @csrf

                @if (session('message'))
                <span class="alert alert-dismissible fade show d-flex justify-content-end" role="alert">
                    <strong class="text-warning">{{session('message')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </span>
                @endif

                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Title</label>
                    <input type="text" name="title" value="" class="form-control @error('title')
                        is-invalid
                    @enderror" id="exampleInputPassword1" placeholder="">
                    @error('title')
                        <div class="invalid-feedback">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Message</label>
                    <textarea name="message" id="" cols="30" rows="5" class="form-control @error('message')
                        is-invalid
                    @enderror"></textarea>
                    @error('message')
                        <div class="invalid-feedback">
                            <span class="text-danger">{{$message}}</span>
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <p class="mt-3"><a href="{{route('user#home')}}" class="mt-3">Back</a></p>
                    <div class=" ">
                        <button type="submit" class="btn btn-primary mt-3">Send</button>
                    </div>
                </div>
            </form>
        </div>


    </div>

</div>
@endsection
