@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid ">
        <div class="container ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <a href="{{route('adminorder#list')}}">back</a>
    </div>
    <div class="row justify-content-around">
        <div class="col-5 h-25 shadow-sm bg-light">
            <div class="row m-3">
                <div >Name:</div>
                <div class="ml-5"> {{$payment->user_name}}</div>
            </div>
            <div class="row m-3">
                <div >Phone:</div>
                <div class="ml-5">{{$payment->phone}}</div>
            </div>
            <div class="row m-3">
                <div >Address:</div>
                <div class="ml-5">{{$payment->address}}</div>
            </div>
            <div class="row m-3">
                <div >Order_Date:</div>
                <div class="ml-4">{{$orderdetail[0]->order_date}}</div>
            </div>
            <div class="row m-3">
                <div >OrderCode:</div>
                <div class="ml-4 ordercode">{{$payment->order_code}}</div>

            </div>
            <div class="row m-3">
                <div >Total Amount:</div>
                <div class="ml-4">{{$payment->total_amt}} MMK</div>
                <div class="ml-3 text-warning">(Included shipping fee)</div>
            </div>
        </div>
        <div class="card" style="width: 20rem;">
            <img src="{{asset('payslip/'.$payment->payslip_image)}}" class="card-img-top m-3 w-75" alt="...">
            <div class="card-body">
                <div class="row m-3">
                    <div >payment:</div>
                    <div class="ml-4">{{$payment->payment_method}}</div>
                </div>
                <div class="row m-3">
                    <div >phone:</div>
                    <div class="ml-5">{{$payment->phone}}</div>
                </div>
            </div>
          </div>
    </div>
    <div class="mt-3">
        <table class="table table-primary justify-content-center align-item-center">
            <thead class="bg-primary">
            <tr class="bg-light">
                <th scope="col" class="col-2">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Available Stock</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($orderdetail as $item)
                <tr>
                    <input type="hidden" class="productId" value="{{$item->productId}}">
                    <td><img src="{{asset('image/'.$item->product_photo)}}" class="card-img-top w-50" alt="..."></td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->product_price}} MMK</td>
                    <td class="qty">{{$item->count}} @if ($item->count>$item->product_stock)
                        <span class="text-danger">(out of stock)</span>
                    @endif</td>
                    <td>{{$item->product_stock}}</td>
                    <td>{{$item->count * $item->product_price}} MMK</td>

                </tr>
                @endforeach



            </tbody>
        </table>

        <div class="row justify-content-end m-3">
            <button type="button" @if (!$status)
                disabled
            @endif class="btn btn-primary m-2" id="confirmBtn">Confirm</button>
            <button type="button" id="rejectBtn" class="btn btn-danger m-2" id="cancelBtn">Reject</button>
        </div>
    </div>

    </div>
</div>
@endsection
@section('contentJs')
    <script>
        $(document).ready(function(){
            $('#confirmBtn').click(function(){
                $orderList = [];
                $ordercode = $('.ordercode').text();

                $('table tbody tr').each(function(index,row){
                    $productId = $(row).find('.productId').val();
                    $orderedQty = $(row).find('.qty').text();

                    $orderList.push({
                    'product_id': $productId,
                    'qty' : $orderedQty,
                    'order_code' : $ordercode
                    });
                });

                console.log($orderList);

                $.ajax({
                    type:'get',
                    url:'/admin/order/confirm',
                    data:Object.assign({},$orderList),
                    dataType:'json',
                    success: function(response){
                        console.log(response);


                    }
                })

            })

            $('#rejectBtn').click(function(){
                $ordercode = $('.ordercode').text();

                $.ajax({
                    type:'get',
                    url:'/admin/order/reject',
                    data:{
                        'order_code':$ordercode
                    },
                    dataType:'json',
                    success:  function(response){
                        if (response.message == 'success') {
                            location.href = '/admin/order/list'
                        }
                    }
                })
            })
        })
    </script>
@endsection
