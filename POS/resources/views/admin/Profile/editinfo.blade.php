@extends('admin.layout.master')

@section('admincontent')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-3" >Edit Your Profile</h1>
</div>

<div class="container rounded px-3 shadow-lg ">

    <div class="row">


        <div class="col-12 bg-primary rounded text-white  d-flex">
            <a href="{{ route('profile') }}" class=" align-items-center justify-content-between pb-2 ">
                <button class="btn sm btn-danger mx-3 mt-3">Back </button>
            </a>
            <div class="d-sm-flex align-items-center justify-content-between">
                <p class="mt-3 mx-2 " >Edit Account Information</p>
            </div>

        </div>
        <div class="col-4 offset-1 border shadow-lg rounded mb-5 w-100 ">

            <form action="{{ route('edit') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" >
            <div class="">
                <img src="{{asset( Auth::user()->profile == null ?'admin/img/undraw_profile.svg' : 'profile/'.Auth::user()->profile )}}" alt="" class="w-75 rounded mx-5 mt-5 " id="output" >
            </div>
            <div>

                <input type="file" class=" form-group mt-3 btn mb-2 border btn-primary" name="image" onchange="loadFile(event)">
                 @error('image')
                 <small class="text-danger mx-5"> {{ $message }} </small>
                 @enderror
            </div>
        </div>
        <div class="col-4 offset-1  ">
               <div class="mt-5 px-4  ">
                <div class="mt-3 mb-2 d-flex">
                    <span class="align-content-center text-dark"> Name:</span>
                   <input type="text" class="form-control mx-3  rounded-3 @error ('name') is-invalid @enderror" name="name"  value="{{ old('name') }}" placeholder="{{ Auth::user()->name }}">

                 </div>

                 <div class="mt-3 mb-2 d-flex">
                    <span class="align-content-center text-dark"> Nickname:</span>
                    <input type="text" class="form-control mx-3  rounded-3 " name="nickname"   value="{{ old('nickname') }}" placeholder="{{ Auth::user()->nickname }}">

                 </div>
                 <div class="mt-3 mb-2 d-flex">
                    <span class="align-content-center text-dark"> Address:</span>
                    <input type="text" class="form-control mx-3  rounded-3 @error ('address') is-invalid @enderror" name="address"  value="{{ old('address') }}" placeholder="{{ Auth::user()->address }}">
                 </div>

                 <div class="mt-3 mb-2 d-flex">
                    <span class="align-content-center text-dark">Phone:</span>
                    <input type="text" class="form-control mx-3  rounded-3 @error ('phone') is-invalid @enderror" name="phone"   value="{{ old('phone') }}" placeholder="{{ Auth::user()->phone }}">
                 </div>

                 <div class="mt-3 mb-2 d-flex">
                    <span class="align-content-center text-dark"> Email:</span>
                    <input type="email" class="form-control mx-3  rounded-3 @error ('email') is-invalid @enderror" name="email"   value="{{ old('email') }}" placeholder="{{ Auth::user()->email }}">
                 </div>


                    <button class="btn sm btn-primary mt-3" type="submit"> Confirm </button>

                </form>


                 <a href="{{ route('changepassword') }}" class="">
                    <button class="btn sm btn-dark mx-3 mt-3"> Change Password  </button>
                   </a>


               </div>

        </div>

    </div>
</div>



@endsection
