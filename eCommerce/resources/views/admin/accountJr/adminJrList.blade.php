@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
   <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Junior Admin List <a href="{{route('admin#jr')}}" class="ml-5"><i class="bi bi-plus-circle"></i></a></h1>
        <div class="">
            <form action="{{route('adminJr#list')}}" method="get">
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

                <div class="col-10 table-responsive">
                <table class="table justify-content-center align-item-center">
                    <thead>
                    <tr class="bg-light">
                        <th scope="col" class="col-2">Profile</th>
                        <th scope="col">ID</th>
                        <th scope="col" >Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col" class="col-3">Created Date</th>
                        <th scope="col" class="col-2">Address</th>
                        <th colspan="2"  scope="col">
                        @if (session('deleteMessage'))
                            <span class="alert alert-dismissible fade show " role="alert">
                                <strong class="text-danger">{{session('deleteMessage')}} No.{{session('deleteID')}}</strong>
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
                    @foreach ($admin as $item)
                    <tr>
                        <td scope="row" >
                            @if ($item->profile == null)
                            <img src="{{asset('admin/img/undraw_profile.svg')}}" style="width: 100px; height:100px" alt="">
                            @else
                            <img src="{{asset('image/'.$item->profile)}}" style="width: 100px; height:100px" alt="">
                            @endif
                        </td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->addrress}}</td>
                        <td>

                        @if (Auth::user()->id != $item->id)
                            <a href="{{route('adminJr#Delete',$item->id)}}"><button class="btn btn-outline-danger">
                                Delete
                            </button></a>

                         @endif


                        </td>

                        <td>
                            @if (Auth::user()->id != $item->id)
                            <button class="btn btn-outline-primary" disabled>Edit</button>
                        @else
                            <a href="{{route('account#edit', $item->id)}}">
                                <button class="btn btn-outline-primary">Edit</button>
                            </a>
                        @endif
                        </td>


                    </tr>
                    @endforeach

                    </tbody>
                </table>
                </div>
        </div>
</div>
@endsection
