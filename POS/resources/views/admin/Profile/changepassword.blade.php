@extends('admin.layout.master')

@section('admincontent')

    <!-- Begin Page Content -->
    <div class="container-fluid" style="height: 630px;">

        <!-- Page Heading -->


        <div class="container shadow-lg rounded mx-5 py-5 " >
            <div class="row">

                <div class="col-6 ">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" >Let's Change Password</h1>
                    </div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, odit labore. Quod sit labore tempora facilis nam, earum incidunt dolore quae nulla consectetur blanditiis doloremque dolorem vero a ea autem.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum consequuntur aut itaque nemo nam tenetur neque, quo inventore enim! Incidunt fuga rem iste beatae amet, nobis iure totam natus! Quo!
                   <div class="my-2 py-2 shadow-sm mx-2 px-5  border-left-success rounded">
                    <p><i class="fa-solid fa-user mx-2"></i>Account Info</p>
                    <p> Created At : {{Auth::user()->created_at}}</p>
                    <p> Update At : {{Auth::user()->updated_at}}</p>
                   </div>

                </div>

                <div class="col-6   border-left-primary px-3 py-4 rounded bg-white shadow-sm h-25 border-dark ">

                    <form action="{{ route('changep') }}" method="POST">
                        @csrf
                        <div class="">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                                <input type="password" name="oldpassword"
                                class="form-control @error('oldpassword')is-invalid   @enderror"  placeholder="Old Password">
                                @error('oldpassword')
                                <small class=" text-danger invalid-feedback"> {{ $message }}</small>
                             @enderror
                              </div>

                        </div>
                        <div class="">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">New Password</label>
                                <input type="password" name="newpassword"
                                  class="form-control @error('newpassword')is-invalid   @enderror"  placeholder="New Password">
                                  @error('newpassword')
                                  <small class=" text-danger invalid-feedback"> {{ $message }}</small>
                                @enderror
                              </div>

                        </div>
                        <div class="">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                                <input type="password" name='confirmpassword'
                                class="form-control @error('confirmpassword')is-invalid   @enderror"  placeholder="Confirm Password">
                                @error('confirmpassword')
                                <small class=" text-danger invalid-feedback"> {{ $message }}</small>
                             @enderror
                              </div>

                        </div>
                        <button class="btn btn-light btn-outline-primary">Change</button>
                    </form>

                </div>



            </div>
       </div>
    </div>



@endsection
