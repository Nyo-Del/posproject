@extends('user.layout.master')

@section('usercontent')

@foreach ($details as $product)
      <!-- Single Product Start -->
      <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{asset('/master/'.$product->photo)}}" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{$product->name}}</h4>
                            <p class="mb-3">{{$product->catrgory_name}}</p>
                            <h5 class="fw-bold mb-3">{{$product->price}}mmk
                                @if ($product->stock <= 10)
                                <span class="text-danger"><span class="mx-0"> (Only{{ $product->stock }} Available!)  </span></span>
                                @else
                                <span class="text-dark"> <span class="mx-0">  ({{ $product->stock }} Stocks)  </span></span>
                                @endif
                            </h5>
                            <div class="d-flex mb-4">
                                @php $stars = number_format($rating) @endphp

                                @for($i = 1;$i<=$stars;$i++)
                                <i class="fa fa-star text-secondary"></i>
                                @endfor

                                @for($j = $stars+1;$j <= 5 ;$j++)
                                <i class="fa fa-star"></i>
                                @endfor
                                <span><i class="fa-regular fa-eye mx-2 "></i>{{ count($viewcount) }} people view</span>
                            </div>

                            <p class="mb-4">{{$product->description}}</p>
                            <form action="{{ route('addtocart',$product->id)}}" method="POST">
                                @csrf
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button"  class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" name="qty" value="1">
                                    <div class="input-group-btn">
                                        <button type="button"  class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                            <a href="{{route('userHome')}}" class="btn border border-dark rounded-pill px-4  py-2 mb-4 text-dark"><i class="fa-solid fa-shop"></i> Back to Shop</a>

                        </form>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews <span class="text-dark mx-1">({{count($review)}})</span></button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                        Susp endisse ultricies nisi vel quam suscipit </p>
                                    <p>Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic
                                        icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.</p>
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">1 kg</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Country of Origin</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Agro Farm</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Organic</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Min Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">250 Kg</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                              @foreach ($review as $rev)
                               @if (Auth::user()->id == $rev->user_id)
                                <div class="d-flex">
                                    <img src="{{asset($rev->userprofile != null ? 'profile/'.$rev->userprofile : 'admin/img/undraw_profile.svg')}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="conatiner">
                                       <div class="row ">
                                        <div class="col-10">
                                             <p class="mb-2" style="font-size: 14px;">{{ $rev->created_at->format('j-F-Y')}}</p>
                                        </div>
                                        <div class="col-2">
                                      <a href="{{route('commentdelete',$rev->id)}}"><button type="submit" class="btn btn-dark mx-5"><i class="fa-solid fa-trash"></i></button></a>
                                        </div>
                                       </div>
                                        <div class="d-flex justify-content-between">
                                            <h5>{{$rev->username}}</h5>

                                        </div>
                                        <p>{{$rev->message}}</p>
                                    </div>
                                  </div>
                                  <hr>
                               @else
                               <div class="d-flex ">
                                <img src="{{asset($rev->userprofile != null ? 'profile/'.$rev->userprofile : 'admin/img/undraw_profile.svg')}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                <div class="">
                                    <p class="mb-2" style="font-size: 14px;">{{ $rev->created_at->format('j-F-Y')}}</p>
                                    <div class="d-flex justify-content-between">
                                        <h5>{{$rev->username}}</h5>

                                    </div>
                                    <p>{{$rev->message}}</p>
                                </div>
                              </div>
                              <hr>
                                @endif
                              @endforeach

                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>

                            <h4 class="mb-1 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">

                                <div class="col-lg-12">
                               <form action="{{route('review',$product->id)}}" method="POST">
                                @csrf
                                <div class="border-bottom rounded my-4">
                                    <textarea name="message" id="" class="form-control border-0 @error('message')is-invalid @enderror" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                </div>
                                <input type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3"></input>
                               </form>


                                </div>

                            </div>

                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <form action="{{route('userHome')}}" method="GET" class="form-conrtol">
                                    @csrf
                                  <div class="d-flex">
                                    <input type="search" class="form-control p-3" placeholder="keywords" name='searchKey' aria-describedby="search-icon-1">
                                    <button type="submit" id="search-icon-1" class="btn btn-white"><i class="fa fa-search"></i></button>
                                  </div>
                                </form>
                            </div>
                            <div class="">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                               @foreach ($category as $item)
                               <li>
                                <div class="d-flex justify-content-between fruite-name">
                                    <a href="{{route('userHome',$item->id)}}"><i class="fas fa-apple-alt me-2"></i>{{$item->name}}</a>
                                    </div>
                            </li>


                               @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-center">

                                 <button href="{{route('userHome')}}" class="btn border btn-secondary px-4 rounded-pill text-white w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Rate Product</button>

                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Rate This Product</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('U#rating',$product->id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ Auth::user()->id }}" name='user_id'>
                                            <div class="modal-body">
                                                <div class="rating-css">
                                                  <div class="star-icon">
                                                        @if ($userRt == 0)
                                                        <input type="radio" value="1" name="productRating" checked id="rating1">
                                                        <label for="rating1" class="fa fa-star"></label>
                                                        <input type="radio" value="2" name="productRating"  id="rating2">
                                                        <label for="rating2" class="fa fa-star"></label>
                                                        <input type="radio" value="3" name="productRating"  id="rating3">
                                                        <label for="rating3" class="fa fa-star"></label>
                                                        <input type="radio" value="4" name="productRating"  id="rating4">
                                                        <label for="rating4" class="fa fa-star"></label>
                                                        <input type="radio" value="5" name="productRating"  id="rating5">
                                                        <label for="rating5" class="fa fa-star"></label>
                                                        @else

                                                        @php $stars = number_format($userRt) @endphp
                                                        @for($i = 1;$i<=$stars;$i++)
                                                        <input type="radio" value="{{$i}}" name="productRating" checked id="rating{{$i}}">
                                                        <label for="rating{{$i}}" class="fa fa-star"></label>
                                                        @endfor
                                                        @for($j = $stars+1;$j <= 5 ;$j++)
                                                        <input type="radio" value="{{$j}}" name="productRating" id="rating{{$j}}">
                                                        <label for="rating{{$j}}" class="fa fa-star"></label>
                                                        @endfor
                                                        @endif
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Rating</button>
                                              </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-4">Releated Products</h4>
                            @foreach ($realted as $item)
                            @if ($product->id != $item->id)
                            <a href="{{route('User#Pdetails',$item->id)}}">
                                <div class="d-flex align-items-center justify-content-start mt-2">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="{{asset('/master/'.$item->photo)}}" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">{{$item->name}}</h6>
                                        <div class="d-flex mb-2">
                                            @php $stars = number_format($item->count) @endphp

                                            @for($i = 1;$i<=$stars;$i++)
                                            <i class="fa fa-star text-secondary"></i>
                                            @endfor

                                            @for($j = $stars+1;$j <= 5 ;$j++)
                                            <i class="fa fa-star text-dark"></i>
                                            @endfor
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">{{$item->price}}mmk</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endif
                            @endforeach
                            <div class="d-flex justify-content-center my-4">
                                <a href="{{route('userHome')}}" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Single Product End -->
@endforeach



@endsection
