@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid ">
        <div class="container ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sale Information</h1>
        <div class="">
            <button class="btn btn-secondary">Total Sale - {{  $totalSale }} MMK</button>
        </div>
    </div>

        <div class="d-flex justify-content-around ">

                <div class="col-10 table-responsive">
                <table class="table justify-content-center align-item-center">
                    <thead class="bg-primary">
                    <tr class="bg-light">
                        <th scope="col" class="col-2">Order Date</th>
                       <th scope="col">Order Code</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Payment</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($sale as $item)
                    <tr>

                        <td>{{$item->order_date->format('d:M:y')}}</td>
                        <td >{{$item->order_code}}</td>
                        <td>{{$item->total_amt}} MMK</td>
                        <td>{{$item->payment_method}}</td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                </div>
        </div>
    </div>
</div>
@endsection


