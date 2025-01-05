@extends('user.layout.master')
@section('content')
     <!-- Single Product Start -->
     <div class="container-fluid py-5 mt-5 ">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-10 col-xl-9">
                    <div class="">
                        <a href="{{route('user#home')}}#tab-1"><h5 class="text-secondary">Shop Now</h5></a>
                    </div>
                    <div class="row g-4">

                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="">
                                    <img src="{{asset('image/'.$product->photo)}}" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{$product->name}}</h4>
                            <div class="d-flex">
                                <p class="mb-3 me-3">Category: {{$product->category_name}}</p>
                                <p class="text-danger ">( {{$product->stock}} items left!)</p>
                            </div>

                            <h5 class="fw-bold mb-3">{{$product->price}} MMK</h5>
                            <div class="d-flex mb-4">

                                    @for ($i = 1; $i <= $rating ; $i++)
                                    <i class="fa fa-star text-secondary"></i>
                                    @endfor
                                    @for ($j = $rating+1; $j <=5  ; $j++)
                                    <i class="fa fa-star"></i>
                                    @endfor

                            </div>
                            <div class="text-primary"><b><i class="bi bi-eye-fill"></i> - {{$viewCount}}</b></div>
                            <p class="mb-4">{{$product->description}}</p>
                            <form action="{{route('addtocart')}}" method="post">
                                @csrf
                                <input type="hidden" name="userID" value="{{Auth::user()->id}}" id="">
                                    <input type="hidden" name="productID" value="{{$product->id}}" id="">
                                <div class="input-group quantity mb-5" style="width: 100px;">

                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="count" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button  class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">Rate the product</button>
                            </form>
                                <!-- Modal -->
                                <form action="{{route('rating#create')}}" method="POST">
                                    @csrf
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="rating-css">
                                                    <div class="star-icon">
                                                        <input type="hidden" name="productID" value="{{$product->id}}">
                                                        {{-- @php
                                                            $userStar = number_format($userRating)
                                                        @endphp --}}
                                                            {{$userRating}}
                                                            @if ($userRating ==  0)

                                                            <input type="radio" name="productRating" value="1"  id="rating1">
                                                            <label for="rating1" class="fa fa-star"></label>
                                                            <input type="radio" name="productRating" value="2"  id="rating2">
                                                            <label for="rating2" class="fa fa-star"></label>
                                                            <input type="radio" name="productRating" value="3"  id="rating3">
                                                            <label for="rating3" class="fa fa-star"></label>
                                                            <input type="radio" name="productRating" value="4"  id="rating4">
                                                            <label for="rating4" class="fa fa-star"></label>
                                                            <input type="radio" name="productRating" value="5"  id="rating5">
                                                            <label for="rating5" class="fa fa-star"></label>

                                                            @else

                                                                @for ($i = 1; $i <= $userRating; $i++)
                                                                    <input type="radio" name="productRating" value="{{$i}}" checked id="rating{{$i}}">
                                                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                                                @endfor

                                                                @for ($j = $userRating+1; $j <= 5; $j++)
                                                                    <input type="radio" name="productRating" value="{{$j}}" id="rating{{$j}}">
                                                                    <label for="rating{{$j}}" class="fa fa-star"></label>
                                                                @endfor

                                                            @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary text-white">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </form>



                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews ({{count($comment)}} comments)</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>
                                        {{$product->description}}
                                    </p>

                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">

                                    @foreach ($comment as $item)
                                    <div class="d-flex shadow-sm">
                                        @if ($item->user_profile != null)
                                        <img src="{{asset('image/'.$item->user_profile)}}" class="img-fluid rounded-circle p-3" style="width: 80px; height: 80px;" alt="">
                                        @else
                                        <img src="{{asset('admin/img/undraw_profile.svg')}}" class="img-fluid rounded-circle p-3" style="width: 80px; height: 80px;" alt="">
                                        @endif

                                        <div class="lh-1">
                                            <small class="" style="font-size: 10px;">{{$item->created_at->format('d-M-y')}}</small>
                                            <div class="d-flex align-items-center ">
                                                <small class="me-3"><b>{{$item->user_name}}</b></small>
                                                <div class="">
                                                    <div class="rating1">
                                                        <div class="star-icon d-flex align-items-center">
                                                            <input type="hidden" name="productID" value="{{$product->id}}">
                                                            {{-- @php
                                                                $userStar = number_format($userRating)
                                                            @endphp --}}

                                                                    @for ($i = 1; $i <= $userRating; $i++)
                                                                        <input type="radio" name="productRating" value="{{$i}}" checked id="rating{{$i}}">
                                                                        <label for="rating{{$i}}" class="fa fa-star"></label>
                                                                    @endfor

                                                                    @for ($j = $userRating+1; $j<=5; $j++)
                                                                        <input type="radio" name="productRating" value="{{$j}}" id="rating{{$j}}">
                                                                        <label for="rating{{$j}}" class="fa fa-star"></label>
                                                                    @endfor

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <p class="me-5">{{$item->message}} </p>
                                                @if ($item->user_id == Auth::user()->id)
                                                <a href="{{route('review#delete',$item->id)}}"><p><button class=" btn btn-outline-danger btn-sm "><i class="bi bi-trash-fill"></i></button></p></a>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                    @endforeach


                                </div>

                            </div>
                        </div>
                        <form action="{{route('review#create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h4 class="mb-2">Leave a comment</h4>
                            <div class="row g-4">
                                <div class="">
                                    <div class="">
                                        <input type="hidden" name="userID" value="{{Auth::user()->id}}" class="form-control border-0 me-4" placeholder="Yur Name *" >
                                        <input type="hidden" name="productID" value="{{$product->id}}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="border rounded my-2">
                                        <textarea name="review" id="" class="form-control border-0" cols="30" rows="3" placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-2">
                                        <div class="d-flex align-items-center">

                                        </div>
                                        <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-2"> Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($relateProduct as $item)
                    @if ($item->id != $product->id)
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <a href="{{route('product#detail',$item->id)}}"><img src="{{asset('image/'.$item->photo)}}" class="img-fluid w-100 rounded-top" alt=""></a>
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{$item->category_name}}</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>{{$item->name}}</h4>
                            <p>{{Str::words($item->description,20,'...')}}</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">{{$item->price}}</p>
                                <a href="{{route('product#detail',$item->id)}}" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->


@endsection
