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
                                    <h4 class="px-2">Payment Methods</h4>
                                </div>
                                <div class="col-6 mt-3 ">
                              @foreach ($payment as $item)
                              <div class="px-4">
                                <h5 class="">{{$item->banking_name}}</h5>
                                <p> Payment : {{$item->banking_name}} ({{$item->account_type}})</p>
                                <p>Name : {{$item->account_name}}</p>
                                <p>Account Number : {{$item->account_number}}</p>
                              </div>
                              <hr>
                               @endforeach
                                </div>

                                <div class="col-6  ">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="bg-light shadow-sm py-2 px-3"> Payment Info</h6>
                                        </div>
                                       <form action="{{route('order')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <input type="text" class="form-control @error('user_name') is-invalid @enderror" readonly placeholder="User Name" name="user_name" value="{{ Auth::user()->name }}">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="09xxxxxxx" name="phone" value="{{ old('phone',Auth::user()->phone) }}">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" value="{{ old('address',Auth::user()->address) }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <select   class="form-control @error('payment_method') is-invalid @enderror" name="payment_method">
                                                    <option value="">Select Payment Method</option>
                                                    @foreach ($payment as $item)
                                                    <option value="{{$item->banking_name}}"  @if (old('payment_method') == $item->banking_name) selected @endif>{{$item->banking_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                               <input type="file" class="form-control @error('payment_slip') is-invalid @enderror" name="payment_slip">
                                            </div>
                                            <div class="row mt-4 mx-2">

                                                    <input type="hidden" name="order_code" value="{{$cartdata[0]['order_code']}}" >
                                                    <input type="hidden" name="total_amt" value="{{$cartdata[0]['total_amt']}}" >


                                                    <h6>This is Payment for Order No: <span class="text-danger">{{$cartdata[0]['order_code']}}</span></h6>


                                                 <h6>Total : {{$cartdata[0]['total_amt']}} (Including Delivery Feeds )</h6>
                                                 <button class="btn btn-outline-primary px-5 mt-2"> Order Now!</button>
                                            </div>
                                       </form>

                                    </div>
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
