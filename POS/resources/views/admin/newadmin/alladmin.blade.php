@extends('admin.layout.master')

@section('admincontent')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-3" > Current Admin List</h1>
</div>

<div class="container bg-white pb-5 pt-3  border border-left-primary rounded mb-5">
<div class="container">
    <div class="row">
        <div class="col-6">
           <a href="{{ route('addnew') }}" class="mt-3">
               <button type="submit" class="btn  btn-primary  mb-3 ">back</button>
           </a>
        </div>
       <div class="col-6">
           <form action="{{ route('admin#list') }}" method="GET">


               <div class="input-group mb-3 px-5 mx-5">
                   <input type="text" name="searchkey" value="{{ request('searchkey') }}" class="form-control rounded" placeholder="Search Admin" aria-label="Recipient's username" aria-describedby="button-addon2">
                   <button class="btn btn-outline-dark" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                 </div>

           </form>
       </div>
     </div>
</div>

  <div class="shadow-lg ">

    <table class="table  table-hover shadow-sm w-100 ">
        <thead >
          <tr class="table bg-primary text-light ">
            <th scope="col">#</th>
            <th scope="col">Account Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Account Type</th>
            <th scope="col">Register By</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>


          </tr>
        </thead>

           @foreach ($info as $item)
        <tbody>
          <tr class="">
           <th scope="row">{{$item['id']}}</th>
           <td>{{$item['name']}}</td>
           <td>{{$item['email']}}</td>
           <td class="">{{$item['phone']}}</td>
           <td>{{$item['role']}}</td>
           <td>
            @if ($item['provider'] == 'simple')
            <i class="fa-solid fa-registered mx-4 "></i>
             @endif
             @if ($item['provider'] == 'google')
             <i class="fa-brands fa-google mx-4 "></i>
              @endif
              @if ($item['provider'] == 'github')
              <i class="fa-brands fa-github mx-4 "></i>
               @endif




           </td>
           <td>{{$item['created_at']->format('j-F-Y')}}</td>
            <td>
             @if (Auth::user()->id != $item['id'] )
             <a href="{{ route('admin#delete',$item['id']) }}"><button class="btn btn-outline-danger">Ban <i class="fa-solid fa-ban "></i></button></a>
             @endif
            </td>


         </tr>
        </tbody>
         @endforeach

      </table>





  </div>

</div>





@endsection
