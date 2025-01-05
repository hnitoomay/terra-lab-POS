@extends('user.layout.master')
@section('content')
     <!-- Single Product Start -->
     <div class="container-fluid py-5 mt-5 ">
        <div class="container py-5">
             <!-- Cart Page Start -->
        <div class="">
            <div class="">
                <div class="">
                    <a href="{{route('user#home')}}#tab-1"><h5 class="text-secondary">Shop Now</h5></a>
                </div>
                <div class="table-responsive">
                    <input type="hidden" id="userID" value="{{Auth::user()->id}}">
                    <table class="table" id="table">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($cart as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('image/'.$item->photo)}}" class="img-fluid me-2 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$item->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 price">{{$item->price}} MMK</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control qty form-control-sm text-center border-0" value="{{$item->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total">{{$item->price * $item->qty}} MMK</p>
                                </td>
                                <td>
                                    <input type="hidden" class="cartID" value="{{$item->cartID}}">
                                    <input type="hidden" class="productID" value="{{$item->productID}}">
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 btn-delete" >
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                {{-- <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
                </div> --}}
                <div class="row g-4 mt-3 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0" id="subtotal">{{$total}} MMK</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">5000 MMK</p>
                                    </div>
                                </div>

                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4"></h5>
                                <p class="mb-0 pe-4" id="finaltotal">{{$total  + 5000}} MMK</p>
                            </div>
                            <button @if (count($cart) == 0)
                                 disabled
                            @endif id="checkout" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->
        </div>
    </div>
    <!-- Single Product End -->


@endsection

@section('contentJs')
    <script>
        $(document).ready(function(){
            $('.btn-plus').click(function () {
                $parentNode = $(this).parents('tr');
                $qty = $parentNode.find('.qty').val();
                $price = $parentNode.find('.price').text().replace('MMK','');
                $amt = $qty * $price;
                $parentNode.find('.total').text($amt + 'MMK');
                finalCalculation();
             })

             $('.btn-minus').click(function () {
                $parentNode = $(this).parents('tr');
                $qty = $parentNode.find('.qty').val();
                $price = $parentNode.find('.price').text().replace('MMK','');
                $amt = $qty * $price;
                $parentNode.find('.total').text($amt + 'MMK');
                finalCalculation();
             })


             function finalCalculation(){
                $total = 0;
                $('#tbody tr').each(function(index,row){
                    //console.log(row);
                    $total += Number($(row).find('.total').text().replace('MMK',''));

                })
                console.log($total);
                $('#subtotal').html(`${$total} MMK`);
                $('#finaltotal').html(`${$total + 5000} MMK`);

            }

            $('.btn-delete').click(function(){
                $parentNode = $(this).parents('tr');
                $cartID = $parentNode.find('.cartID').val();
                console.log($cartID);

                $.ajax({
                    type: 'get',
                    url : '/user/product/cartDelete',
                    data: {
                        'cartID' : $cartID
                    },
                    dataType: 'json',
                    success: function(response){
                        response.message == 'deleted'? location.reload() : '';
                        //console.log(response);

                    }
                })

            })

            $('#checkout').click(function(){
                $orderList = [];
                $userID = $('#userID').val();
                $ordercode = "C00" + Math.floor(Math.random() * 10000) + 1;
                $totalAmt = $('#finaltotal').text().replace('MMK','');


               $('#tbody tr').each(function(index,row){
                $productID = $(row).find('.productID').val();
                $qty = $(row).find('.qty').val();

                    $orderList.push({
                        'user_id' : $userID,
                        'product_id' : $productID,
                        'qty' : $qty,
                        'ordercode' : $ordercode,
                        'total_amt':$totalAmt
                    })
               })
               console.log($orderList);


               $.ajax({
                type: 'get',
                url: '/user/product/cart/tempo',

                data: Object.assign({},$orderList),
                dataType: 'json',
                success: function(response){
                    if (response.message == 'success') {
                        location.href = '/user/product/payment'
                    }
                }

               })



            })

        })
    </script>
@endsection

