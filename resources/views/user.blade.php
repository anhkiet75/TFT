@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex flex-column">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div><br />
    @endif
    <table class="table table-hover align-middle mb-0 bg-white">
        <thead class="bg-light">

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
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
                <td class="d-flex">
               
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-link btn-sm btn-rounded" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                        <i class="far fa-edit fa-fw" style="color: #00a0f0"></i>
                    </button>
                    <!-- <button type="button" onclick="location.href='/user/1'"  class="btn btn-link btn-sm btn-rounded">
                        <i class="fas fa-minus-circle" style="color: #f00000"></i>
                    </button> -->
                    <form action="{{ route('user.destroy', $item->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button  class="btn btn-link btn-sm btn-rounded" type="submit">
                           <i class="fas fa-minus-circle" style="color: #f00000"></i>
                      </button>
                    </form>
                </td>

               
          
            </tr>

            @endforeach
        </tbody>



       
    </table>
    <div class="d-flex mt-2 flex-end">
        {!! $data->links() !!}
    </div>
</div>
@endsection