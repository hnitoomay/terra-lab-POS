@extends('user.layout.master')
@section('content')

    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7 text-g">
                    <h4 class="diy mb-3 display-3 text-primary">DIY Terrarium</h4>
                    <h1 class="mini mb-5  text-secondary">A mini forest enclosed in its own little world</h1>

                </div>


            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-3">
        <div class="container ">
            <div class="tab-class text-center">
                <div class="col-lg-5 text-start">
                    <h1>Our Terrarium Products</h1>
                </div>
                <div class="row g-4">
                    <div class="col-3 text-start">
                        <form action="{{ route('user#home') }}" method="get">
                            @csrf
                            <div class="input-group mt-2">
                                <input type="text" class="form-control" name="searchkey" value="{{ request('searchkey') }}" placeholder="Search..." />
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search text-white"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill @if (!request('categoryID') )
                                    active
                                @endif " href="{{route('user#home')}}">
                                    <span class="text-dark" style="width: 130px;">All Items</span>
                                </a>
                            </li>
                            @foreach ($category as $item)
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill @if (request('categoryID') == $item->id)
                                    active
                                @endif " href="{{ url('user/home?categoryID='. $item->id) }}">
                                    <span class="text-dark" style="width: 130px;">{{ $item->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="tab-1" class="row mb-3 justify-content-between">
                    <div class=" col-4 mb-3">
                        <form action="{{ route('user#home') }}" method="get" class="d-flex justify-content-end">
                            @csrf
                           <div class="input-group">
                             <!-- Min Price -->
                             <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">

                             <!-- Max Price -->
                             <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">

                             <!-- Search Button -->
                             <button class="btn btn-warning"><i class="bi bi-search text-white"></i></button>
                           </div>
                        </form>
                    </div>
                    <div class="col-3 mb-3">
                        <form action="{{ route('user#home') }}" method="get" class=" ">
                            @csrf
                           <div class="input-group">
                                <select name="sortingItems" class="form-control bg-light" id="">
                                    <option value="{{!request('sortingItems') ? route('user#home'):''}}">Choose Sorting </option>
                                    <option value="name,asc" {{request('sortingItems') == 'name,asc'? 'selected':''}}>Sorting by A-Z</option>
                                    <option value="name,desc" {{request('sortingItems') == 'name,desc'? 'selected':''}}>Sorting by Z-A</option>
                                    <option value="price,asc" {{request('sortingItems') == 'price,asc'? 'selected':''}}>Price Lowest to Highest</option>
                                    <option value="price,desc" {{request('sortingItems') == 'price,desc'? 'selected':''}}>Price Highest to Lowest</option>
                                    <option value="created_at,asc" {{request('sortingItems') == 'created_at,asc'? 'selected':''}}>Date to Oldest</option>
                                    <option value="created_at,desc" {{request('sortingItems') == 'created_at,desc'? 'selected':''}}>Date to Newest</option>
                                </select>
                                <button class="btn btn-warning"><i class="bi bi-search text-white"></i></button>
                           </div>
                        </form>
                    </div>
                </div>
                <div id="tab-1" class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @foreach ($product as $item)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded border-bottom-info position-relative fruite-item">
                                            <div class="fruite-img border-bottom-info">
                                                <a href="{{route('product#detail',$item->id)}}">


                                                        @php
                                                            $photoPath = Str::startsWith($item['photo'], 'products/')
                                                                ? asset('storage/' . $item['photo']) // Photo from storage/products
                                                                : asset('image/' . $item['photo']);  // Photo from public/image
                                                        @endphp
                                                        <img src="{{ $photoPath }}" class="img-fluid w-100 rounded-top" alt="Product Image">


                                                </a>
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$item->category_name}}</div>
                                            <div class="p-4 border border-second border-top-0 rounded-bottom">
                                                <h6>{{$item->name}}</h6>
                                                <p>{{Str::words($item->description, 10, '...')}}</p>
                                                <div class=" justify-content-center">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{$item->price}} MMK</p>
                                                    <a href="{{route('product#detail',$item->id)}}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

@endsection
