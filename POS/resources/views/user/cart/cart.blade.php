@extends('user.layout.master')


@section('usercontent')


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
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
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border"  >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text"  class="form-control qty form-control-sm text-center border-0" value="{{$item->qty}}">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 total mt-4">{{$item->price * $item->qty}}mmk</p>
                            </td>
                            <td>
                            <input type="hidden" class="productId" value="{{ $item->id }}">
                                <a href="{{route('deletecart',$item->cid)}}">
                                    <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>

                           @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0" id="subtotal">{{$total}}mmk</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">5000mmk</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4" id="finaltotal">{{$total + 5000}}</p>
                            </div>
                            <button @if (count($data) == null) disabled
                            @endif id="btn-checkout" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->



@endsection
@section('js-section')
<script>
    $(document).ready(function(){

        //plus
        $('.btn-plus').click(function(){
            $parentNode = $(this).parents('tr');
            $price = $parentNode.find('.price').text().replace('mmk','');
            $qty = $parentNode.find('.qty').val();
            $total =$price * $qty;

           $parentNode.find('.total').text($total + "mmk");
           finalcalculation();

        })

        //minus
        $('.btn-minus').click(function(){
            $parentNode = $(this).parents('tr');
            $price = $parentNode.find('.price').text().replace('mmk','');
            $qty = $parentNode.find('.qty').val();
            $total =$price * $qty;

           $parentNode.find('.total').text($total + "mmk");
           finalcalculation();
        })


        function finalcalculation(){

            $total = 0;
            $('#productTable tbody tr').each( function(index,item){
               $total += parseInt($(item).find('.total').text().replace('mmk',''))
            })
            $('#subtotal').html(`${$total}mmk`)
            $('#finaltotal').html(`${$total + 5000 }mmk`)

        }

        $('#btn-checkout').click(function(){
            $message ='this is a cart'
            localStorage.setItem("cart",$message);

            $orderList = [ ];
            $userId = $('#userId').val();
            $orderCode ="WMR-POS" + Math.floor(Math.random() * 1000000000);
            $total_amt = $('#finaltotal').text().replace('mmk','') * 1;

            $('#productTable tbody tr').each( function(index,row){
                $productId =$(row).find(".productId").val();
                $qty =$(row).find(".qty").val();
                $orderList.push({
                    'user_id' : $userId,
                    'product_id' : $productId,
                    'count' : $qty,
                    'order_code' : $orderCode,
                    'total_amt' : $total_amt

                })
            })
            $.ajax({
                type : 'get',
                url : '/user/cart/temp',
                data : Object.assign({},$orderList) ,
                dataType : 'json',
                success : function(res){
                    if( res.status == 'success'){ location.href = '/user/payment'}
                }

            })

            //console.log("sending...");






        })





    })
</script>

@endsection
