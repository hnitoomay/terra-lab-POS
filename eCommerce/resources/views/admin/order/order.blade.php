@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid ">
        <div class="container ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders List</h1>
        <div class="">

        </div>
    </div>

        <div class="d-flex justify-content-around ">

                <div class="col-10 table-responsive">
                <table class="table justify-content-center align-item-center">
                    <thead class="bg-primary">
                    <tr class="bg-light">
                        <th scope="col" class="col-2">Order Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Order Code</th>

                        <th scope="col">Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($order as $item)
                    <tr>
                        <input type="hidden" class="ordercode" value="{{$item->order_code}}">
                        <td>{{$item->created_at->format('d-M-y')}}</td>
                        <td>{{$item->user_name}}</td>
                        <td><a class="ordercode" href="{{route('adminorder#detail',$item->order_code)}}">{{$item->order_code}}</a></td>

                        <td>
                            <select class="form-select statusChange" aria-label="Default select example">

                                <option value="0" {{$item->status == 0 ? 'selected': ''}}>Pending</option>
                                <option value="1" {{$item->status == 1 ? 'selected': ''}}>Accepted</option>
                                <option value="2" {{$item->status == 2 ? 'selected': ''}}>Rejected</option>
                              </select>

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

@section('contentJs')
    <script>
        $(document).ready(function(){
            $('.statusChange').change(function(){
                $status = $(this).val();
                $ordercode = $(this).parents('tr').find('.ordercode').val();
                console.log($status,$ordercode);


                $.ajax({
                    type: 'get',
                    url: '/admin/order/status',
                    data:{
                        'status': $status,
                        'order_code': $ordercode
                    },
                    dataType:'json',
                    success: function(response){
                        response.message == 'success'? location.reload(): ''

                    }
                })



            })
        })
    </script>
@endsection
