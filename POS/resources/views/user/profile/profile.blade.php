@extends('user.layout.info')

@section('usercontent')

<div class="container bg-white pb-5 pt-5  border border-left-success rounded mb-5 ">

    <div class="row">

        <div class="col-4 offset-1">
            <h4 class="text-dark mb-5"> This is Your Account info   </h4>
            <p>Things You must know before creating an account</p>
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut cumque quasi odit facere soluta quis necessitatibus sunt ipsam, minus beatae eveniet quibusdam deserunt, veritatis nisi. Assumenda dignissimos facere sunt distinctio.  </p>
            <p>About Rules</p>
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem deserunt</p>
        </div>
        <div class="col-6 border shadow-lg  rounded">
              <form action="{{route('userupdateProfile',Auth::user()->id)}}" class="" method="POST" enctype="multipart/form-data">
                   @csrf
                <div class="container   ">
                    <div class="row">
                        <div class="col-5 mb-5 mx-3 ">
                            <div class="">

                               <div class="mt-5 mb-4">
                                <p class="mx-2 px-2 bg-dark text-light rounded ">Account User Picture</p>
                                <img src="{{asset( Auth::user()->profile == null ?'admin/img/undraw_profile.svg' : 'profile/'.Auth::user()->profile )}}" alt="" class="img w-100 rounded" id="output">
                               </div>
                                <input type="file" class=" text-white form-control-file bg-dark" onchange="loadFile(event)" name="image">
                            </div>
                        </div>
                        <div class="col-6 mb-4 mt-5 ">

                            <div class="d-flex  mt-3">
                                <span class=" align-content-center">Nickname:</span>
                                <input type="text" name='nickname' class="form-control mx-2 " value="{{ Auth::user()->nickname }}">
                            </div>
                            <div class="d-flex mt-3 ">
                                <span class=" align-content-center">Email:</span>
                                <input type="email" name='email' class="form-control mx-2 @error('email')is-invalid @enderror " value="{{ Auth::user()->email }}">
                            </div>
                            <div class="d-flex  mt-3">
                                <span class=" align-content-center">Phone:</span>
                                <input type="text" name='phone' class="form-control mx-2  @error('phone')is-invalid @enderror" value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="d-flex mt-3 ">
                                <span class=" align-content-center">Address:</span>
                                <input type="text" name='address' class="form-control mx-2  @error('address')is-invalid @enderror" value="{{ Auth::user()->address }}">
                            </div>

                        <div class="mt-3 ">
                            <input type="submit" class="btn btn-sm btn-success form-control" value="Update"></input>
                        </div>
                        @error('email')
                        <div class="text-muted text-danger">Email must Be Unique</div>
                        @enderror
                    </div>

                   </div>

                </div>
             </form>

        </div>
    </div>
</div>


@endsection
