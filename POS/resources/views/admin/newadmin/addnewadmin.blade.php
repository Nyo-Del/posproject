@extends('admin.layout.master')

@section('admincontent')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-3" > Add New Admin /

            <a href="{{ route('admin#list') }}" class="mx-2 text-dark ">

                    <i class="fa-solid fa-users"></i>   Admin List /

            </a>
            <a href="{{ route('user#list') }}" class="mx-2 text-dark ">

                <i class="fa-solid fa-users"></i>  User List

        </a>

    </h1>

</div>

<div class="container bg-white pb-5 pt-5  border border-left-primary rounded mb-5 ">

    <div class="row">

        <div class="col-4 offset-1">
            <h4 class="text-dark mb-5"> Let's create acccounts   </h4>
            <p>Things You must know before creating an account</p>
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut cumque quasi odit facere soluta quis necessitatibus sunt ipsam, minus beatae eveniet quibusdam deserunt, veritatis nisi. Assumenda dignissimos facere sunt distinctio.  </p>
            <p>About Roles</p>
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem deserunt</p>
        </div>
        <div class="col-6 border shadow-lg  rounded">
                 <form action="{{ route('addingprocess') }}" class="form" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="container   ">
                    <div class="row">
                        <div class="col-5 mb-5 mx-3 ">
                            <div class="">

                               <div class="mt-5 mb-4">
                                <p class="mx-2 px-2 bg-dark text-light rounded ">Account User Picture</p>
                                <img src="{{ asset('admin/img/undraw_profile.svg') }}" alt="" class="img w-100 rounded" id="output">
                               </div>
                                <input type="file" class=" text-white form-control-file bg-dark" onchange="loadFile(event)" name="image">


                            </div>
                        </div>
                        <div class="col-6 mb-5 mt-4 ">

                            <div class="d-flex  mt-3">
                                <span class=" align-content-center">Name:</span>
                                <input type="text" name= 'name' class="form-control mx-2  @error('name')is-invalid @enderror" value="{{ old('name') }}">
                            </div>
                            <div class="d-flex mt-3 ">
                                <span class=" align-content-center">Email:</span>
                                <input type="email" name= 'email' class="form-control mx-2  @error('email')is-invalid @enderror" value="{{ old('email') }}">
                            </div>
                            <div class="d-flex  mt-3">
                                <span class=" align-content-center">Phone:</span>
                                <input type="text" name= 'phone' class="form-control mx-2  @error('phone')is-invalid @enderror" value="{{ old('phone') }}">
                            </div>
                            <div class="d-flex mt-3 ">
                                <span class=" align-content-center">Password:</span>
                                <input type="text" name= 'password' class="form-control mx-2 @error('password')is-invalid @enderror " value="{{ old('password') }}">
                            </div>

                            <div class="d-flex mt-3 ">
                             <label for="role " class=" align-content-center ">Role:</label>
                               <select name="role" class="form-control mx-3 px-4 " >
                                @error('role')
                                <option value="" class="">Need to Fill</option>
                                @enderror
                                <option value="">Select Role</option>
                                <option value="superadmin">Superadmin</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                               </select>
                            </div>
                            <div class="mt-3 ">
                                <button type="submit" class="btn btn-sm btn-primary form-control">Add+</button>
                            </div>
                        </div>
                    </div>
                   </div>
             </form>
        </div>
    </div>
</div>

@endsection
