@extends('admin.layout.master')

@section('admincontent')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h2 mb-0 text-gray-800 mx-4" >Edit Product</h1>
</div>

@foreach ($data as $product)
<div class="container rounded px-3 shadow-lg ">



    <div class="row">
     <div class="col-12 bg-dark rounded text-white mb-3">
         <div class="d-sm-flex align-items-center justify-content-between">
             <p class="mt-2  " > <i class="fa-solid fa-bars"></i> Update Product Information</p>
         </div>
     </div>
     <div class="col-4 offset-1 border shadow-lg rounded  w-100 h-50 mt-3 bg-white">

         <form action="{{ route('P#updated',$product->id) }}" method="POST" enctype="multipart/form-data">
             @csrf

         <div class="">
             <img src="{{asset('master/'.$product->photo )}}" alt="" class="w-75  rounded mx-5 mt-4 " id="output" >
         </div>
         <div>
             @error('image')
             <small class="text-danger mx-5 "> {{ $message }} </small>
             @enderror

             <input type="file" class=" form-group mt-1 bg-dark text-white mb-2 mx-2" name="image" onchange="loadFile(event)">

         </div>

     </div>
     <div class="col-6 offset-1 ml-5 ">
            <div class=" mb-2">
            <div class="conatiner">
             <div class="row">
                 <div class="col-6">
                     <div class="mt-3 mb-2">
                         <span class="">Product Name :</span>
                         <span><input type="text" class=" form-control @error('Productname') is-invalid @enderror" name="Productname" value="{{$product->name}}"></span>
                      </div>
                      <div class="mt-3 mb-2">
                         <span class=""> Price: </span>
                         <span><input type="text" class=" form-control @error('price') is-invalid @enderror" name="price" value="{{$product->price}}"></span>
                      </div>


                 </div>
                 <div class="col-6">
                     <div class="mt-3 mb-2">
                         <span class="">Category:</span>
                         <span>
                             <select name="category" id="" class="form-control @error('category') is-invalid @enderror">
                                 <option value=""> Select Category </option>
                                 @foreach ($category as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                             </select>
                         </span>
                      </div>
                      <div class="mt-3 mb-2">
                         <span class=""> Stock : </span>
                         <span><input type="text" class=" form-control @error('stock') is-invalid @enderror" name="stock" value="{{$product->stock}}"></span>
                      </div>


                 </div>
                 <div class="mt-3 ">
                     <span class="mx-2"> Description :</span>
                     <span><textarea placeholder="Product description...." name="description" id="" class="form-control mx-3 @error('description') is-invalid @enderror" cols="52" rows="5">{{$product->description}}</textarea></span>
                  </div>
                 </div>
             </div>
            </div>

                 <button class="btn sm btn-dark mb-4" type="submit">Update Product</button>

             </form>
              <a href="{{ route('P#page') }}" class="">
                 <button class="btn sm btn-outline-dark mb-4">Product List</button>
                </a>

            </div>

     </div>

 </div>

@endforeach

@endsection
