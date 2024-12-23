@extends('user.layout.master')

@section('usercontent')

  <!-- Checkout Page Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">


            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="row">
                        <div class="col-12 shadow-lg rounded">
                            <div class="row">
                                <div class="col-12  mt-3">
                                    <h4 class="px-5">Your Order List</h4>
                                </div>
                               <div class="col-12 mt-2">
                                <table id="productTable" class="table px-3 ">
                                    <thead>
                                      <tr>
                                        <th scope="col ">Order Created At</th>
                                        <th scope="col">Order_code</th>
                                        <th scope="col">Pre-Paid Total</th>
                                        <th scope="col ">Address</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Delivery Status</th>

                                      </tr>
                                    </thead>
                                    <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                                    <tbody>
                                       @foreach ($order as $item)
                                       <tr>

                                        <td>
                                            <p class="mb-0 total mt-4">{{$item->created_at->format('j-F-Y')}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 mt-4 price">{{$item->order_code}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 total mt-4">{{$item->total_amt}}mmk</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 total mt-4">{{$item->address}}</p>
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                            <p class="mb-0 mx-2 mt-3 price btn btn-primary text-white">Pending</p>
                                            @endif
                                            @if ($item->status == 1)
                                            <p class="mb-0 mx-2 mt-3 price btn btn-success text-white">Order Accepted</p>
                                            @endif
                                            @if ($item->status == 2)
                                            <p class="mb-0 mx-2 mt-3 price btn btn-danger text-white">Order Rejected</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                            <p class="mb-0 mt-3 ">Please Wait For Confirmation</p>
                                            @endif
                                            @if ($item->status == 1)
                                            <p class="mb-0 mt-3 ">Your Order Will Be Deliver in 2Days</p>
                                            @endif
                                            @if ($item->status == 2)
                                            <p class="mb-0 mt-3 ">Your Order Can't Be Deliver</p>
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


                </div>

            </div>

    </div>
</div>
<!-- Checkout Page End -->

@endsection
