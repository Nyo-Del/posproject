@extends('admin.layout.master')

@section('admincontent')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-3" >Your Profile</h1>
</div>

<div class="container rounded px-3 shadow-lg ">

    <div class="row">
        <div class="col-12 bg-primary rounded text-white ">
            <div class="d-sm-flex align-items-center justify-content-between">
                <p class="mt-2  " >Account Information</p>
            </div>
        </div>
        <div class="col-4 offset-1 border shadow-lg rounded mb-5 w-100 ">
            <form action="{{ route('uploadphoto') }}" method="POST" enctype="multipart/form-data">
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
        <div class="col-4 offset-1 ">
               <div class="mt-5 mb-5">
                <div class="mt-3 mb-2">
                    <span class=""> Name :</span>
                    <span> {{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }} </span>
                 </div>
                 <div class="mt-3 mb-2">
                    <span class=""> User Role : </span>
                    <span class=" text-danger rounded">{{ Auth::user()->role }}</span>
                 </div>
                 <div class="mt-3 mb-2">
                    <span class=""> Email :</span>
                    <span> {{ Auth::user()->email }} </span>
                 </div>
                 <div class="mt-3 mb-2">
                    <span class=""> Phone Number : </span>
                    <span> {{ Auth::user()->phone }} </span>
                 </div>
                 <div class="mt-3 mb-2">
                    <span class=""> Address : </span>
                    <span>{{ Auth::user()->address }}</span>
                 </div>
                 <div class="mt-3 mb-5">
                    <span class=""> Created at : </span>
                    <span>{{ Auth::user()->created_at->format('j-F-Y') }}</span>
                 </div>

                    <button class="btn sm btn-success" type="submit"> Upload Photo</button>

                </form>
                 <a href="{{ route('editinfo') }}" class="">
                    <button class="btn sm btn-primary"> Edit info</button>
                   </a>

               </div>

        </div>

    </div>
</div>



@endsection
