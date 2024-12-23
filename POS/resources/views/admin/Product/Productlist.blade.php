@extends('admin.layout.master')

@section('admincontent')
<div class="conatiner">
    <div class="row">
        <div class="col-5 offset-1 mx-5">
            <div class="">
                <h5 class=" text-white bg-dark btn mt-2 mx-5" > <i class="fa-solid fa-database"></i> Product Count({{count($product)  }})</h5>
                <a href="{{route('P#page')}}" class=" text-primary  mr-2"> <i class="fa-solid fa-database"></i> All Products</a>/
                <a href="{{route('P#page','lowamt')}}" class="text-danger ml-2 mr-2"> <i class="fa-solid fa-database "></i> Low On Stock</a>
            </div>

        </div>

        <div class="col-4">
             <form action="{{ route('P#page') }}" method="GET">
                  <div class="input-group mb-3 px-5 mx-5">
                    <input type="text" name="Itemsearchkey" value="{{ request('Itemsearchkey') }}" class="form-control rounded" placeholder="Search Product" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                  </div>
            </form>
        </div>
    </div>
</div>
<!-- Products -->
<div class="container rounded px-3 h-75 ">
    <div class="row">

        @if (count($product) != 0)

        @foreach ($product as $item)
        <div class="col-md-6 col-lg-4 col-xl-3 mt-3 mb-0 ">
         <div class="rounded position-relative fruite-item  shadow-sm ">
            <div class="">
                <div class="fruite-img ">
                    <img src="{{asset('master/'.$item->photo)}}" class="img-fluid w-100 h-75 rounded-top border  " alt="">
                </div>
                <div class="p-4 border-top-0 rounded-bottom bg-white py-0 mb-0">
                    <h5 class="text-dark">{{ $item->name }}</h5>
                    <p class="text-light btn btn-sm btn-dark fw-bold">Id: <span class="mx-2"> {{ $item->id }} </span></p>
                    <p class="text-light btn btn-sm btn-dark">Price: <span class="mx-0"> {{ $item->price }} </span></p>
                   @if ($item->stock <= 10)

                   <p class="text-light btn btn-sm btn-danger">Stocks: <span class="mx-0"> {{ $item->stock }}  </span></p>


                   @else

                   <p class="text-light btn btn-sm btn-dark">Stocks: <span class="mx-0"> {{ $item->stock }} </span></p>

                   @endif
                    <p class="text-light btn btn-sm btn-dark"><span class="mx-0"> {{ $item->category_name}} </span></p>

                    <hr class="mt-0">
                    <div class="d-flex justify-content-between flex-lg-wrap mb-0 pb-0 ">
                        <a href="{{ route('P#seemore',$item->id) }}">Seemore</a>
                        <a href="{{ route('P#updatepage',$item->id) }}">Edit</a>
                        <a href="{{ route('P#delete',$item->id) }}">Delete</a>
                    </div>
                </div>
            </div>
         </div>
     </div>
        @endforeach


        @else
        <div class="d-sm-flex align-items-center " style="margin-top: 200px;margin-left:300px;">
            <h1 class="h3 mb-0 text-gray-800 mx-3 " >There is No Data or Product</h1>
        </div>
        @endif



    </div>
    <span class="d-flex justify-content-end mt-2">{{ $product->links() }}</span>


</div>



@endsection
