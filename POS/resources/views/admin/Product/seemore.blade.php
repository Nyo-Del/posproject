@extends('admin.layout.master')

@section('admincontent')

@foreach ($data as $item)

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h2 mb-0 text-gray-800 mx-4" >Product Details</h1>
</div>

  <div class="shadow-sm rounded px-5 py-2 ">

    <div class="container mt-3  ">
        <div class="row">

            <div class="col-6 mt-1 ">
                <p class="mx-5 ">The Product image is as below :</p>
                    <img src="{{ asset('master/'.$item->photo) }}" alt="" class="img w-75 rounded">
                    <p class="mx-5 mt-3"> The Picture of {{  $item->name  }} </p>
            </div>
            <div class="col-6 px-1">
                <h3 class="text-gray-800 mb-2"> {{  $item->name  }} </h3>
                <div class="mt-4">
                    <p class="text-gray-800 ">Description :</p>
                    <p class=""> {{ $item->description }}</p>
                </div>
                <div class="text-gray-800 ">Category: <span class="bg-dark text-white px-2 rounded ml-2 py-1">{{$item->category_name}}</span></div>
                    <div class="">
                        <div class="container mt-4  ">
                            <div class="row">
                               <div class="col-6 ">
                                   <span class="text-gray-800 mr-2">Price:</span>{{$item->price}}Ks
                               </div>
                              <div class="col-6">
                               <span class="text-gray-800 mr-2">Available Stock:</span>{{$item->stock}}
                              </div>
                            </div>
                           </div>
                           <div class="container mt-4">
                               <div class="row">

                                   <div class="col-6">
                                       <div class="">
                                          <span class="text-gray-800 mr-1">Created At:</span> {{$item->created_at->format('j-F-Y')}}
                                       </div>
                                   </div>
                                   <div class="col-6">
                                       <div class="">
                                        <span class="text-gray-800 mr-1">Update At:</span>   {{$item->updated_at}}
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="mt-5">
                            <a href="{{route('P#page')}}" class="btn btn-dark">Back</a>
                            <a href="{{route('P#updatepage',$item->id)}}" class="btn  btn-primary">Edit Product</a>
                            <a href="{{route('Product#create')}}" class="btn  btn-success">Add New Product</a>
                           </div>
                    </div>
            </div>
        </div>
      </div>
  </div>

@endforeach



@endsection
