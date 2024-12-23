@extends('admin.layout.master')

@section('admincontent')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-3" > All Payment Methods</h1>
</div>

<div class="container bg-white pb-5 pt-3  border border-left-info rounded mb-5 ">
    <a href="{{ route('add') }}" class="mt-3">
        <button type="submit" class="btn btn-sm btn-dark mx-2 mb-3 ">back</button>
    </a>

  <div class="">

    <table class="table  table-hover shadow-sm w-100">
        <thead >
          <tr class="table bg-info text-light ">
            <th scope="col">#</th>
            <th scope="col">Account Name</th>
            <th scope="col">Number</th>
            <th scope="col">Account Type</th>
            <th scope="col">Bank</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
            <th scope="col"></th>


          </tr>
        </thead>

           @foreach ($data as $item)
        <tbody>
          <tr class="">
           <th scope="row">{{$item['id']}}</th>
           <td>{{$item['account_name']}}</td>
           <td>{{$item['account_number']}}</td>
           <td class="">{{$item['account_type']}}</td>
           <td>{{$item['banking_name']}}</td>
           <td>{{$item['created_at']->format('j-F-Y')}}</td>
           <td>
             <a href="{{ route('update#page',$item['id'])}}"><button class="btn btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
             <a href="{{ route('delete',$item['id']) }}"><button class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button></a>
            </td>


         </tr>
        </tbody>
         @endforeach

      </table>




      <span class="d-flex justify-content-end">{{ $data->links() }}</span>
  </div>

</div>





@endsection
