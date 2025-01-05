@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class=" card col-12 my-3">
            <div class="card-hearder py-3 bg-light">
                <div class=" fs-3 text-dark">
                   <h3> Add Product Items  </h3>
                </div>
            </div>

            <form action="{{route('product#create')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body row">
                    <div class="col-4 ml-5">
                         <img class="img-profile img-thumbnail" id="output" src='{{asset('image/noimage.jpg')}}'>
                         <div class="form-group mt-3">
                             <label for="exampleInputPassword1">Add Product Image</label>
                             <input type="file"  name="photo" value="" class="form-control @error('photo')
                                 is-invalid
                             @enderror" onchange="loadFile(event)" placeholder="">
                             @error('photo')
                                 <div class="invalid-feedback">
                                     <span class="text-danger">{{$message}}</span>
                                 </div>
                             @enderror
                         </div>
                    </div>
                    <div class="col-6 ml-5 bg-light rounded">

                            <div class="row">
                                <div class="form-group col-6 mt-3">
                                    <label for="exampleInputPassword1">Name</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name')
                                        is-invalid
                                    @enderror" id="" placeholder="">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-6 mt-3">
                                   <label for="exampleInputPassword1">Category</label>
                                   <select name="category" class="form-control @error('category')
                                       is-invalid
                                   @enderror"  id="">
                                       <option value="">Choose Category</option>
                                       @foreach ($category as $item)
                                       <option value="{{$item->id}}" {{old('category') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                       @endforeach
                                   </select>
                                   @error('category')
                                       <div class="invalid-feedback">
                                           <span class="text-danger">{{$message}}</span>
                                       </div>
                                   @enderror
                               </div>
                            </div>


                             <div class="form-group mt-3">
                                 <label for="exampleInputPassword1">Description</label>
                                 <textarea name="description" class="form-control @error('description')
                                     is-invalid
                                 @enderror" id="" cols="30" rows="10">{{old('description')}}</textarea>
                                @error('description')
                                 <div class="invalid-feedback">
                                     <span class="text-danger">{{$message}}</span>
                                 </div>
                                @enderror
                             </div>

                             <div class="row">
                                <div class="form-group col-6 mt-3">
                                    <label for="exampleInputPassword1">Price</label>
                                    <input type="number" name="price" value="{{old('price')}}" class="form-control @error('price')
                                        is-invalid
                                    @enderror" id="" placeholder="">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>
                                 <div class="form-group col-6 mt-3">
                                     <label for="exampleInputPassword1">Stock</label>
                                     <input type="number" name="stock" value="{{old('stock')}}" class="form-control @error('stock')
                                         is-invalid
                                     @enderror" id="" placeholder="">
                                     @error('stock')
                                     <div class="invalid-feedback">
                                         <span class="text-danger">{{$message}}</span>
                                     </div>
                                     @enderror
                                 </div>
                             </div>

                    </div>

                 </div>
                 <hr>
                 <div class="d-flex justify-content-end">

                 <div class=" ">
                     <a href=""><button class="btn btn-outline-primary m-2"  ><i class="bi bi-plus-circle"></i>ADD</button></a>

                 </div>
                 </div>
            </form>



        </div>

    </div>
@endsection

@section('contentJs')
<script>
    function loadFile(event){
        console.log(event.target.files[0]);
        var reader = new FileReader();

        reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
            console.log("Image preview updated successfully");
        }
        reader.readAsDataURL(event.target.files[0])
    }
</script>
@endsection
