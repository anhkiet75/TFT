@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column">
   @if(session()->get('success'))
   <div class="alert alert-success">
      {{ session()->get('success') }}
   </div><br />
   @endif
   @if(session()->get('failed'))
   <div class="alert alert-danger">
      {{ session()->get('failed') }}
   </div><br />
   @endif
   <div class="d-flex align-items-end flex-column">
   </div>
   <h3>Equipment for user: {{$username}}</h3>
   <table class="table table-hover align-middle mb-0 bg-white">
      <thead class="bg-light">

         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Description</th>
            <th>User</th>
            <th>Category</th>
            <th>Created_at</th>
            <th>Updated_at</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($data as $item)


         <tr>
            <td>
               <span>{{$item->id}}</span>
            </td>
            <td>
               <p class="fw-normal mb-1">{{$item->name}}</p>
            </td>
            <td>
               <p class="fw-normal mb-1">{{$item->status}}</p>
            </td>
            <td>
               <p class="fw-normal mb-1">{{$item->description}}</p>
            </td>
            <td>
               @if (isset($item->user->name))
               <p class="fw-normal mb-1"> {{ $item->user->name }}</p>
               @else
               <p class="fw-normal mb-1 " style="color: #eb4f34;">Not assigned</p>
               @endif
               <!-- <p class="fw-normal mb-1"> {{ isset($item->user->name) ? $item->user->name : 'Not assigned' }}</p> -->
            </td>
            <td>
               <p class="fw-normal mb-1">{{$item->category->name}}</p>
            </td>
            <td>
               <p class="fw-normal mb-1">{{$item->created_at}}</p>
            </td>
            <td>
               <p class="fw-normal mb-1">{{$item->updated_at}}</p>
            </td>
         
         </tr>

         @endforeach
      </tbody>


   </table>


</div>
@endsection