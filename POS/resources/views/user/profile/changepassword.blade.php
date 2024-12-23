@extends('user.layout.info')

@section('usercontent')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center ">

        <div class="col-xl-10 col-lg-12 col-md-9 ">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image">
                            <img src="{{asset('master/password2.jpg')}}" alt="" class="w-100 mt-5 mx-5">
                        </div>
                        <div class="col-lg-6 ">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Wanna Change Your Password?</h1>
                                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe impedit cum suscipit porro. Amet cum eos sequi aliquid voluptates te
                                        </p>
                                </div>
                                <form action="{{route('U#password',Auth::user()->id)}}" class="user" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text " class="form-control form-control-user @error('oldpassword') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Your Old Password..." name="oldpassword">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user @error('oldpassword') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Your New Password...." name="newpassword">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user @error('oldpassword') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Confrim Your New Password...." name="confirmpassword">
                                    </div>

                                    <button type="submit" class="btn btn-success btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
