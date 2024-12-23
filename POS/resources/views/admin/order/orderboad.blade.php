@extends('admin.layout.master')

@section('admincontent')



<div class="border mx-5 rounded">
      <!-- Checkout Page Start -->
      <div class="col-12 bg-primary text-white ">
        <i class="fa-solid fa-bars mx-2"></i>Confirm Order

      </div>
  <div class="container-fluid py-5 shadow-sm">
    <div class="container ">


            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="row">
                        <div class="col-12 shadow-lg rounded border-left-info">
                            <div class="row">

                                    <div class="col-6"><h4 class="px-2 "> <i class="fa-solid fa-clipboard mx-2 mt-3"></i>Order List</h4></div>
                                    <div class="col-6 d-flex justify-content-end mt-3  ">
                                        <form action="{{route('O#order')}}" class="d-flex" method="GET">
                                         <input type="text" class="form-control" placeholder="Search Order..." name="searchkey">
                                         <input type="submit" class="btn">
                                        </form>
                                     </div>

                               <div class="col-12 mt-2 ">
                                <table id="productTable" class="table px-3 ">
                                    <thead class="">
                                      <tr class="">
                                        <th scope="col ">Order Created At</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Order_code</th>
                                        <th scope="col">Cash Total</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Delivery Process</th>
                                      </tr>
                                    </thead>

                                    <tbody>
                                       @foreach ($order as $item)

                                        <tr>

                                            <td>
                                                <p class="mb-0 total mt-4">{{$item->created_at->format('j-F-Y')}}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 total mt-4 border-left-info px-2">{{$item->userid}}</p>
                                            </td>
                                            <td>
                                                <a href="{{route('O#view',$item->order_code)}}">
                                                <p class="mb-0 mt-4 price" id="ordercode">{{$item->order_code}}</p>
                                                <input type="hidden" value="{{$item->order_code}}" class="ordercode">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="mb-0 total mt-4">{{$item->total_amt}}mmk</p>
                                            </td>

                                            <td>
                                                <select name="" id="" class="form-control mt-3 statusChange">
                                                    <option value="0" @if($item->status == 0) selected @endif >Pending</option>
                                                    <option value="1" @if($item->status == 1) selected @endif>Success</option>
                                                    <option value="2" @if($item->status == 2) selected @endif>Reject</option>
                                                </select>

                                            </td>
                                            <td>
                                                @if ($item->status == 0)
                                                <p class="mb-0 mt-3 "><i class="fa-regular fa-clock text-warning "></i> Waiting For Confirmation</p>
                                                @endif
                                                @if ($item->status == 1)
                                                <p class="mb-0 mt-3 "><i class="fa-solid fa-face-laugh-beam text-success "></i> Order Accepted</p>
                                                @endif  @if ($item->status == 2)
                                                <p class="mb-0 mt-3  "><i class="fa-solid fa-xmark text-danger"></i> Order Reject</p>
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

<span class="d-flex justify-content-end mt-2">{{ $order->links() }}</span>

<!-- Checkout Page End -->
</div>

@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){

        $('.statusChange').change(function(){

            $ChangeStatus = $(this).val();
            $orderCode = $(this).parents('tr').find('.ordercode').val();

            $data = {
                'order_code' :$orderCode,
                'status' : $ChangeStatus,
            };

            $.ajax({
                type : 'get',
                url : '/admin/Order/changestatus',
                data : $data,
               dataType : 'json',
               success :function(res){
                res.status == 'success' ? location.reload() : null;
               }
            })


        })
    })
</script>
@endsection
