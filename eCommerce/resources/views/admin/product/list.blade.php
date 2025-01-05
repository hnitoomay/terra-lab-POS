@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
   <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800">Product List <a href="{{route('product#form')}}"><i class="bi bi-plus-circle"></i></a></h1>
    <div class="d-sm-flex align-items-center justify-content-around mb-4">
        <div class=""></div>
      <div class="row ">
        <a href="{{route('product#list')}}" class="text-primary mt-3 text-decoration-none"><p class=" text-bg-primary"><i class="bi bi-database-fill"></i>All products</p></a>
        <a href="{{route('product#list','lowamt')}}" class="text-danger mt-3 text-decoration-none ml-5"><p class=" text-bg-danger"><i class="bi bi-cone-striped"></i>Low Stock Level</p></a>
      </div>
        <div class="">
            <form action="{{route('product#list')}}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="key" value="{{request('key')}}" placeholder="....."  aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

        <div class="d-flex justify-content-around ">

                <div class="col-12 table-responsive">
                <table class="table justify-content-center align-item-center">
                    <thead>
                    <tr class="bg-light">
                        <th scope="col" >Profile</th>
                        <th scope="col">ID</th>
                        <th scope="col" >Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col" class="">Created Date</th>

                        <th colspan="2"  scope="col">
                        @if (session('createMessage'))
                            <span class="alert alert-dismissible fade show " role="alert">
                                <strong class="text-success">{{session('createMessage')}}</strong>
                                <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </span>
                        @endif
                        @if (session('updateMessage'))
                        <span class="alert alert-dismissible fade show " role="alert">
                            <strong class="text-danger">{{session('updateMessage')}} No.{{session('updateID')}}</strong>
                            <button type="button" class="close text-danger" data-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </span>
                        @endif
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($product as $item)
                    <tr>
                        <td scope="row" >
                            @if ($item->photo == null)
                                <img src="{{asset('image/noimage.jpg')}}" style="width: 100px; height:100px" alt="">
                            @else

                                @php
                                    $photoPath = Str::startsWith($item['photo'], 'products/')
                                        ? asset('storage/' . $item['photo']) // Photo from storage/products
                                        : asset('image/' . $item['photo']);  // Photo from public/image
                                @endphp
                                <img src="{{ $photoPath }}" style="width: 100px; height: 100px;" alt="Product Image">

                            @endif
                        </td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->category_name}}</td>
                        <td class="col-3">{{$item->description}}</td>
                        <td>{{$item->price}}</td>
                        <td class="col-1">
                            <p  class=" position-relative">
                                @if ($item->stock <=3)
                                {{$item->stock}}
                                <span class="text-white position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                  low stock

                                </span>
                                @else
                                {{$item->stock}}
                                @endif
                            </p>
                        </td>
                        <td>{{$item->created_at->format('d-M-y')}}</td>

                        <td class="row">

                            <a href="{{route('product#edit', $item->id)}}"><button class="btn btn-outline-primary mr-1">
                                <i class="bi bi-pencil-square"></i>
                            </button></a>
                            <a href="{{route('product#delete',$item->id)}}"><button class="btn btn-outline-danger ">
                                <i class="bi bi-trash3-fill"></i>
                            </button></a>

                        </td>
                    </tr>
                    @endforeach
                    <span>{{$product->links()}}</span>
                    </tbody>
                </table>
                </div>
        </div>
</div>
@endsection
