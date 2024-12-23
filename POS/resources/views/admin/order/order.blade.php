@extends('admin.layout.master')

@section('admincontent')

        <!-- Page Heading -->
        <div class="mx-5 my-2 shadow-lg rounded">

        <div class="continer mt-2">
            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12 ">
                    <div class="row">
                        <div class="col-12 rounded mx-5 px-5 mt-3 "   >
                            <div class="row">
                                @foreach ($payment as $pm)
                                <div class="col-7 mx-4  ">
                                    <div class="row">
                                        <div class="border pb-5 shadow-sm rounded">
                                            <div class="col-12 ">
                                                <h6 class="bg-primary text-light shadow-sm py-2 px-3"><i class="fa-solid fa-bars mx-2"></i> <span class="">Order Number : <span class="text-white" id="order_code">{{$pm->order_code}}</span></span></h6>
                                            </div>

                                            <div class="row  mx-3">
                                                <div class="col-6">
                                                    <p>Customer Name :{{$pm->user_name}}</p>

                                                </div>
                                                <div class="col-6">
                                                    @if ($pm->phone == $pm->uphone)
                                                    <p>Phone Number : {{$pm->phone}}</p>
                                                    @else
                                                    <p>Phone Number : {{$pm->phone}}/{{$pm->uphone}}</p>

                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mt-2 mx-5">
                                                <div class="col-6">
                                                    <p>Payment Method:{{$pm->payment_method}}</p>
                                                </div>
                                                <div class="col-6">
                                                    @if ($pm->address == $pm->uaddress)
                                                    <p>Address:{{$pm->address}}</p>

                                                    @else
                                                    <p>Address:{{$pm->address}}/{{$pm->uaddress}}</p>

                                                    @endif
                                                </div>
                                                <div class="col-6 mt-2">
                                                  <p>Total Amt :{{$pm->total_amt}}mmk</p>
                                                  <p>Delivery Feeds Included(5000mmk)</p>
                                                </div>
                                                <div class="col-6 mt-2">
                                                    <p>Created:{{$pm->created_at->format('j-F-Y')}}</p>
                                                </div>
                                                <div class="col-8 mt-3 offset-2">
                                                    <button class="form-control">
                                                        <a href="{{asset('payslip/'.$pm->payslip_img) }}" download><i class="fa-solid fa-download"></i>Download Pay Slip</a>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                              </div>
                            <div class="col-4">
                                <div class="">
                                     <div class="row">
                                         <div class="col-8 offset-2 shadow-sm mt-3">
                                             <img src="{{asset('payslip/'.$pm->payslip_img)}}" alt="" class="img mt-2 w-75 mx-4 " style="height: 300px; ">
                                          </div>

                                     </div>

                                </div>
                             </div>
                             @endforeach
                        </div>
                    </div>
                  </div>

              </div>

                <div class="col-10 offset-1 mt-3 shadow-sm rounded border-left-primary">
                            <div class="row">

                               <div class="col-12">
                                <table id="productTable" class="table px-3 ">
                                    <thead class="">
                                      <tr class="">
                                        <th scope="col">Product Photo</th>
                                        <th scope="col ">Product Name</th>
                                        <th scope="col">Order Stock </th>
                                        <th scope="col">Price(each)</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">On Stock</th>

                                        <th scope="col">Order Status</th>

                                      </tr>
                                    </thead>
                                @foreach ($order as $item)

                                    <tbody>
                                       <tr>
                                        <input type="hidden" name="" class="productId" value="{{$item->product_id}}">
                                        <input type="hidden" name="" class="ostock" value="{{$item->ostock}}">
                                        <input type="hidden" name="" class="pstock" value="{{$item->pstock}}">


                                        <td>
                                            <img src="{{asset('master/'.$item->pphoto)}}" alt="" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;">
                                        </td>

                                        <td>
                                            <p class="mb-0 total mt-4">{{$item->pname}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 ostock mt-4 mx-5">{{$item->ostock}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 total mt-4 mx-3">{{$item->price}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0  mt-4 mx-1">{{$item->ostock  *  $item->price}}</p>
                                        </td>
                                        <td>
                                           @if ($item->ostock >= $item->pstock)
                                           <p class="mb-0 pstock text-danger mt-4 ">({{$item->pstock}})Low on stock</p>


                                           @else
                                           <p class="mb-0 pstock mt-4 mx-4">{{$item->pstock}}</p>
                                           @endif
                                        </td>

                                        <td>
                                          @if($item->status == 0) <p class="mt-4"><i class="fa-solid fa-clock text-warning mx-2"></i>Pending</p> @endif
                                          @if($item->status == 1) <p class="mt-4"><i class="fa-solid fa-face-laugh-beam text-success mx-2"></i>Success</p> @endif
                                          @if($item->status == 2) <p class="mt-4"><i class="fa-solid fa-xmark text-danger mx-2"></i>Reject</p> @endif
                                        </td>
                                    </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                               </div>

                                <div class="">
                                    <button type="submit" id="cmforder" class="btn btn-primary mb-3 mx-3" @if(!$stc) disabled @endif>Confirm Order</button>
                                    <button type="submit" id="rjorder" class="btn btn-danger mb-3 ">Cancle Order</button>
                                </div>


                            </div>
                        </div>
                     </div>
                <span class="d-flex justify-content-end mt-2" style="margin-right: 120px">{{ $order->links() }}</span>
            </div>
        </div>
        </div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){

        $('#cmforder').click(function(){
            $orderlist = [];
            $order_code = $('#order_code').text();
            $('#productTable tbody tr').each(function(index,row){
                $productId = $(row).find('.productId').val();
                $productOrder= $(row).find('.ostock').val();
                $productstock = $(row).find('.pstock').val();

                $orderlist.push({
                    'product_id' : $productId,
                    'count': $productOrder,
                    'order_code':$order_code
                })

            })
            $.ajax({
                type:'get',
                url:'/admin/Order/comfirmorder',
                data: Object.assign({},$orderlist),
                dataType:'json',
                success:function(res){
                   res.status == 'success' ? location.href = '/admin/Order/orderboard' : ''
                }
            })

        })

        $('#rjorder').click(function(){
            $order_code = $('#order_code').text();
            $data = {
                'order_code' : $('#order_code').text()
            }
            $.ajax({
                type:'get',
                url:'/admin/Order/rejectOrder',
                data: $data,
                dataType:'json',
                success:function(res){
                   res.status == 'success' ? location.href = '/admin/Order/orderboard' : ''
                }
            })

        })



    })

</script>
@endsection
