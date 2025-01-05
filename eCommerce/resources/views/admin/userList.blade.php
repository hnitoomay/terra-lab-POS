@extends('admin.layout.master')

@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid ">
        <div class="container ">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User List</h1>
        <div class="">

        </div>
    </div>

        <div class="d-flex justify-content-around ">

                <div class="col-10 table-responsive">
                <table class="table justify-content-center align-item-center">
                    <thead class="bg-primary">
                    <tr class="bg-light">
                        <th scope="col" class="col-2">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>

                    </tr>
                    </thead>

                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td>
                                @if ($item->profile == null)
                                <img src="{{asset('admin/img/undraw_profile_1.svg')}}" class="w-50" alt="">
                                @else
                                <img src="{{asset('image/'.$item->profile)}}" class="w-50" alt="">
                                @endif
                            </td>
                            <td>{{$item->name}}</td>
                            <td>
                                @if ($item->phone == null)
                                <b class="text-danger text-center">-------</b>
                                @else
                                {{$item->phone}}
                                @endif
                            </td>
                            <td>{{$item->email}}</td>
                            <td>
                                @if ($item->address == null)
                                <b class="text-danger text-center">-------</b>
                                @else
                                {{$item->address}}
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

