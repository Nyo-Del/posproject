@extends('user.layout.info')

@section('usercontent')

<!-- Cart Page Start -->
<div class="">
   <h4 class="mx-4"> <i class="fa-solid fa-cart-shopping mx-2"></i>Cart Items of {{Auth::user()->name}}</h4>
    <div class="mx-5 px-2">
   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit aliquid ipsa eum qui, neque tempore animi soluta molestiae eligendi. Porro libero voluptates deserunt, iusto distinctio repellat debitis nam optio impedit?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt eaque culpa, voluptatum quis maiores consequatur ea! Tempora pariatur, tempore rem, dicta dolorum ipsam tenetur veritatis harum, ea voluptatem inventore nam!</p>

   <p>This is for Showing Only! You Can Only Edit Your Cart  <a href="{{route('cart',Auth::user()->id)}}">Here</a></p>
    </div>
</div>
<div class="container-fluid">
    <div class="container py-5">
        <div class="table-responsive">
            <table id="productTable" class="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                <tbody>
                   @foreach ($data as $item)
                   <tr>
                    <th scope="row">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('/master/'.$item->photo)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="" alt="">
                        </div>
                    </th>
                    <td>
                        <p class="mb-0 mt-4">{{$item->name}}</p>
                    </td>
                    <td>
                        <p class="mb-0 mt-4 price">{{$item->price}}mmk</p>
                    </td>
                    <td>
                        <div class="input-group quantity mt-4" style="width: 100px;">

                            <input type="text"  class="form-control qty form-control-sm text-center border-0" disabled value="{{$item->qty}}">

                        </div>
                    </td>
                    <td>
                        <p class="mb-0 total mt-4">{{$item->price * $item->qty}}mmk</p>
                    </td>
                    <td>
                            <button class="btn btn-md rounded-circle bg-light border mt-4" disabled >
                                <i class="fa fa-times text-danger"></i>
                            </button>
                    </td>
                </tr>

                   @endforeach

                </tbody>
            </table>
        </div>


    </div>
</div>
<!-- Cart Page End -->


@endsection
