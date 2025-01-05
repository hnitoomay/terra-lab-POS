@extends('user.layout.master')
@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5 ">
        <div class="container py-5">
            <!-- Cart Page Start -->
            <div class="container-fluid py-5">
                <div class="row justify-content-around">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header" style="color:#81c408">
                            <h5 style="color:#81c408"> Payment slip</h5>
                        </div>
                        <ul class="list-group m-3">
                            @foreach ($payment as $item)
                                <p class=""><b>{{ $item->account_type }}</b> ( Name: <b>{{ $item->account_name }}</b>
                                    )</p>
                                <span>Account: {{ $item->account_number }}</span>
                                <hr>
                            @endforeach

                        </ul>
                    </div>
                    <div class="card col-7 h-25">
                        <div class="card-header" style="color:#81c408">
                            <h5 style="color:#81c408"> Payment Option</h5>
                        </div>
                        <form action="{{ route('order#create') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body ">

                                <div class=" rounded">

                                    <div class="row">

                                        <div class="col">
                                            <input type="text" name="name"
                                                value="{{ Auth::user()->name }}"class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                                id="" placeholder="your name" disabled>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col">

                                            <input type="number" name="phone" value="{{old('phone')}}"
                                                class="form-control @error('phone')
                                        is-invalid
                                    @enderror"
                                                id="" placeholder="phone number" >
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            <input type="text" name="address" value="{{old('address')}}"
                                                class="form-control @error('address')
                                        is-invalid
                                    @enderror"
                                                id="exampleInputPassword1" placeholder="your address" >
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <select
                                                class="form-control @error('method')
                                            is-invalid
                                        @enderror"
                                                name="method" id="">
                                                <option value="">Choose type</option>
                                                @foreach ($payment as $item)
                                                    <option value="{{ $item->account_type }}" {{old('method') == $item->account_type ? 'selected': ''}}>{{ $item->account_type }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('method')
                                                <div class="invalid-feedback">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col">

                                            <input type="file" name="payslip" value=""
                                                class="form-control @error('payslip')
                                            is-invalid
                                        @enderror"
                                                id="exampleInputPassword1" placeholder="">
                                            @error('payslip')
                                                <div class="invalid-feedback">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mt-3">
                                            <input type="hidden" name="order_code"
                                                value="{{ $orderItem[0]['order_code'] }}">
                                            <p>Order Code - <b class="text-danger">{{ $orderItem[0]['order_code'] }}</b>
                                            </p>
                                        </div>
                                        <div class="col mt-3">
                                            <input type="hidden" name="total_amt"
                                                value="{{ $orderItem[0]['total_amt'] }}">
                                            <p>Total Amount - <b>{{ $orderItem[0]['total_amt'] }} MMK</b></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-end">
                                        <div class=""><button class="btn btn-primary m-2 text-white "><i
                                                    class="bi bi-pencil-square"></i>Order Now</button></div>

                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- Cart Page End -->
        </div>
    </div>
    <!-- Single Product End -->
@endsection
