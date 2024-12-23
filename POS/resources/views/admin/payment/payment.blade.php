@extends('admin.layout.master')

@section('admincontent')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-3" > Payment Methods </h1>
</div>

<div class="container bg-white pb-5 pt-5  border border-left-info rounded mb-5 ">

    <div class="row">


        <div class="col-6 border shadow-lg  rounded offset-1">
            <div class="bg-info text-light pb-2 pt-2 pl-3 shadow-sm ">Add Payment</div>
                 <form action="{{ route('add') }}" class="form" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="container  ">
                    <div class="row ">
                        <div class="col-10 offset-1 mb-5 mt-4   ">

                            <div class="d-flex  mt-3">
                                <span class=" align-content-center ">Accountname:</span>
                                <input type="text" name= 'accountname' class="form-control mx-2 ml-5  @error('accountname')is-invalid @enderror" value="{{ old('accountname') }}">
                            </div>
                            <div class="d-flex mt-3 ">
                                <span class=" align-content-center">Accounttype:</span>
                                <input type="text" name= 'accounttype' class="form-control mx-2 ml-5 @error('accounttype')is-invalid @enderror" value="{{ old('accounttype') }}">
                            </div>
                            <div class="d-flex  mt-3">
                                <span class=" align-content-center">Accountnumber:</span>
                                <input type="text" name= 'accountnumber' class="form-control mx-2 ml-5 @error('accountnumber')is-invalid @enderror" value="{{ old('accountnumber') }}">
                            </div>
                            <div class="d-flex mt-3 ">
                                <span class=" align-content-center">Paidby:</span>
                                <input type="text" name= 'bankingname' class="form-control mx-2 ml-5 @error('bankingname')is-invalid @enderror " value="{{ old('bankingname') }}">
                            </div>

                            <div class="mt-3 ">
                                <button type="submit" class="btn btn-sm btn-info form-control">Add+</button>
                            </div>
                        </form>


                        </div>
                    </div>
                   </div>

        </div>
        <div class="col-4 mx-3">
            <h4 class="text-dark mb-5"> Let's Add Payment Methods   </h4>
            <p>Things You must know before adding an account</p>
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut cumque quasi odit facere soluta quis necessitatibus sunt ipsam, minus beatae eveniet quibusdam deserunt, veritatis nisi. Assumenda dignissimos facere sunt distinctio.  </p>
           <a href="{{ route('allpayment') }}" class="mt-3">
                <button type="submit" class="btn btn-sm btn-dark form-control">See All Payments</button>
           </a>
        </div>
    </div>
</div>





@endsection
