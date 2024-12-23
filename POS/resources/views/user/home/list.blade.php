@extends('user.layout.master')

@section('usercontent')





<!-- Bestsaler Product Start -->
    <div class="container" style="margin-top: 110px;">
        <div class="row">
            <div class="text-center mx-auto mb-4" style="max-width: 700px;">
                <h1 class="display-4">Bestseller Products</h1>
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>
        </div>
    </div>
    <div class="conatiner mt-1">
        <div class="row">
            <div class="col-7 d-flex justify-content-end ">
            </div>
            <div class="col-5 d-flex justify-content-end ">
                       <div class=" justify-content-end d-flex position-absolute" style="margin-right: 150px">
                        <div>
                            <a href="{{route('userHome')}}" class="btn btn-outline-dark  @if(!request('id')) active @endif">All({{$data->count()}})</a>
                        </div>
                        @foreach ($categories as $item)
                        <div>
                            <a href="{{route('userHome',$item->id)}}" class="btn btn-outline-primary mx-1 @if(request('id') == $item->id) active @endif">{{$item->name}}</a>
                        </div>
                        @endforeach
                       </div>
           </div>
        </div>
    </div>
<div class="container py-5 mt-1">
        <div class="row g-4">
         <div class="col-4 order-sm-first">
            <h3 class="">This is Web-Market</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro est quas odio dolorem fugit dicta voluptatum iusto. Cumque, veritatis, error impedit, maxime quasi laborum similique tempore ab recusandae exercitationem debitis.
                <form action="{{ route('userHome') }}" method="GET">
                    <div class="input-group">
                        <button class="btn btn-outline-dark" type="submit" value="{{request('searchKey')}}" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <input type="text" class="form-control" name="searchKey" placeholder="Search....." aria-label="Example text with button addon" aria-describedby="button-addon1">
                      </div>
                </form>
                <div class="mt-2">
                    <form action="{{ route('userHome') }}" method="GET">
                       <div class="conatiner">
                        <div class="row">
                            <div class="col">
                                <select name="sortingType" id="" value="" class="form-control">
                                    <option value="name,asc">A to Z</option>
                                    <option value="name,desc">Z to A</option>
                                    <option value="price,asc">Lowest to Hightest</option>
                                    <option value="price,desc">Hightest to Lowest</option>
                                    <option value="created_at,asc">Recent Products</option>
                                    <option value="created_at,desc">Unrecent Products</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary px-5 text-white"><i class="fa-solid fa-cart-shopping"></i></button>
                            </div>
                        </div>
                       </div>

                    </form>
                 </div>

               <div class="mt-3">
                <form action="{{route('userHome')}}" method="get" class="">
                    @csrf
                    <div class="conatiner">
                        <div class="row">
                            <div class="col-6">
                                <input type="number" name='minp' class="form-control " value="{{ request('minp') }}" placeholder="Minimum Price....">
                              </div>
                              <div class="col-6">
                                <input type="number" name='maxp' class="form-control" value="{{ request('maxp') }}" placeholder="Maximum Price...  ">
                              </div>
                        </div>
                    </div>

                  <button type="submit" class="btn btn-primary btn-dark px-4 text-white mt-2"><i class="fa-solid fa-magnifying-glass mx-1"></i>Search</button>
                </form>
             </div>
             <hr class="mt-5">
             <div class="row">
                <div class="col-11" style="margin-top: 30px">
                    <h4>Welcome From Our Store</h4>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate officia earum odit voluptatem, provident magnam sed voluptatum corporis, aliquid atque illo, quae nesciunt vel? Aliquam soluta cumque beatae nostrum nulla.
                </div>
                <div class="col">
            <span class="d-flex pt-2  justify-content-end" style=" margin-left:1340px">{{ $data->links() }}</span>

                </div>
             </div>

        </div>




         <div class="col-8 px-2  ">
            <div class="container">
                <div class="row">
                    @foreach ($data as $item)
                    <div class="col-lg-4 col-sm-6 mb-3 ">
                        <div class="rounded position-relative fruite-item  shadow-sm ">
                           <div class="">
                               <div class="fruite-img  ">
                                           <div class="d-flex justify-content-end"><div class="text-light btn btn-sm btn-dark position-absolute"><span class="mx-1 d-flex mx-3 "> {{ $item->category_name}} </span></div></div>
                                            <img src="{{asset('master/'.$item->photo)}}" class="img-fluid w-100  h-100 rounded-top  border   " alt="">
                               </div>
                               <div class="p-4 border-top-0 rounded-bottom bg-white py-0 mb-0">
                                   <h5 class="text-dark mt-2">{{ $item->name }}</h5>
                                   <span class="text-dark">Price: <span class="mx-0"> {{ $item->price }}Ks </span></span>
                                  @if ($item->stock <= 10)
                                  <span class="text-danger"><span class="mx-0"> ({{ $item->stock }}left!)  </span></span>
                                  @else
                                  <span class="text-dark"> <span class="mx-0">  ({{ $item->stock }}Stocks)  </span></span>
                                  @endif

                                   <hr class="mt-0">
                                   <div class="d-flex justify-content-between flex-lg-wrap mt-0 mb-3 pb-0 ">
                                    <form action="{{route('addtocart',$item->id)}}" method="POST" class='mb-3'>
                                        @csrf
                                        <div class=" ">
                                           <button type="submit" class="btn btn-dark  text-white"> <i class="fa-solid fa-bag-shopping mx-1"></i>Add +</button>
                                        </div>
                                    </form>
                                    <a href="{{ route('User#Pdetails',$item->id) }}" class='mb-3 '>
                                        <div class="btn btn-primary text-white  btn-sm px-2 mt-1">
                                           More Details
                                        </div>
                                    </a>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
         </div>




        </div>

</div>
<!-- Bestsaler Product End -->





@endsection
