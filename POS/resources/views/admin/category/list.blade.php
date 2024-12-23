@extends('admin.layout.master')

@section('admincontent')

    <!-- Begin Page Content -->
    <div class="container-fluid" style="height: 630px;">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" >Create    Category</h1>
        </div>

        <div class="" style="height: 550px;">
            <div class="row">
                <div class="col-4  offset-1 border px-3 py-4 rounded bg-white shadow-lg h-25">
                    <form action="{{ route('createcategory') }}" method="POST">
                        @csrf
                        <input type="text" name="name" class="form-control" placeholder="Category Name..">
                        @error('name')

                     <small class="text-danger mt-5">    {{ $message }} </small>

                        @enderror
                        <br>
                        <input type="submit" value="Create" class="btn btn-light mt-3 btn-outline-primary">
                    </form>
                </div>

                 <div class="col-6 offset-1 ">

                    <h1 class="h3 text-gray-800 mx-4">#Category List</h1>


                            <table class="table shadow  rounded">
                                <thead>
                                  <tr class="bg-primary text-white">
                                    <th scope="col">Id</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created Date</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                @foreach ($categories as $item)
                                <tbody>


                                  <tr>
                                    <th scope="row">{{ $item['id'] }}</th>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['created_at']->format('j-F-Y') }}</td>
                                    <td>  <a href="{{ route('categorydelete',$item['id']) }}" class="btn btn-outline-danger mx-2"><i class="fa-solid fa-trash "></i></a>
                                        <a href="{{ route('categoryupdate',$item['id']) }}" class="btn btn-outline-success mx-2"><i class="fa-solid fa-pen-to-square "></i></a>
                                    </td>

                                  </tr>

                                </tbody>
                                @endforeach

                              </table>
                              <span class="d-flex justify-content-end">{{ $categories->links() }}</span>








                    </div>
                 </div>
            </div>
        </div>

     </div>

@endsection
