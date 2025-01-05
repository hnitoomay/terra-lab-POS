@extends('user.layout.master')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid py-5 mt-5 ">
        <div class="container py-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Your Order History</h1>
        <div class="">

        </div>
    </div>

        <div class="d-flex justify-content-around ">

                <div class="col-10 table-responsive">
                <table class="table table-primary justify-content-center align-item-center">
                    <thead class="table-primary">
                    <tr class="bg-light">
                        <th scope="col" class="col-2">Order Date</th>
                        <th scope="col">Order Code</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderlist as $item)
                    <tr>

                        <td>{{$item->created_at->format('d-M-y')}}</td>
                        <td>{{$item->order_code}}</td>
                        <td>{{$item->total_amt}} MMK</td>
                        <td>
                            @if ($item->status == 0)
                                <button class="btn btn-warning text-white">Pending</button>
                            @elseif ($item->status == 1)
                                <button class="btn btn-warning text-white me-5">Accepted</button> <span class="text-danger me-5">We deliver within a week</span>
                            @elseif ($item->status == 2)
                                 <button class="btn btn-danger text-white">Rejected</button>
                            @endif
                        </td>


                    </tr>
                    @endforeach

                    </tbody>
                </table>
                </div>
        </div>
    </div>
</div>
@endsection
