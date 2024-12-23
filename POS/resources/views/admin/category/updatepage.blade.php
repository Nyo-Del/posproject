@extends('admin.layout.master')

@section('admincontent')

    <!-- Begin Page Content -->
    <div class="container-fluid" style="height: 630px;">

        <!-- Page Heading -->
        <div class="d-flex  mb-4">
            <form action="{{ route('back') }}" method="GET">
                <button type="submit" value="Back" class="btn  mt-3  text-dark  "><i class="fa-solid fa-left-long "></i></button>
            </form>
            <h1 class="h3 mt-3 text-gray-800" >Update Category</h1>

        </div>
        @foreach ($oldcategory as $item)
        <div class="" style="height: 550px;">
            <div class="row">

                <div class="col-4  offset-1 border px-3 py-4 rounded bg-white shadow-lg h-25">
                    <form action="{{ route('update',$item['id']) }}" method="POST">
                        @csrf
                        <input type="text" name="name" class="form-control" placeholder="{{ $item['name'] }}">
                        @error('name')

                     <small class="text-danger mt-5">    {{ $message }} </small>

                        @enderror
                        <br>
                        <input type="submit" value="Update" class="btn btn-light mt-3 btn-outline-primary">
                    </form>
                </div>

                 <div class="col-5 offset-1 ">

                    <h1 class="h3 text-gray-800 mx-4">#Old Category </h1>


                        <div class="col-12  ">

                            <table class="table shadow  rounded">
                                <thead>
                                  <tr class="bg-primary text-white">
                                    <th scope="col">Id</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Update Date</th>
                                  </tr>
                                </thead>
                                @foreach ($oldcategory as $item)
                                <tbody>


                                  <tr>
                                    <th scope="row">{{ $item['id'] }}</th>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['created_at']->format('j-F-Y') }}</td>
                                    <td>{{ $item['updated_at']->format('j-F-Y') }}</td>

                                  </tr>

                                </tbody>
                                @endforeach
                              </table>
                        </div>

                        @endforeach







                    </div>
                 </div>
            </div>
        </div>

     </div>

@endsection
