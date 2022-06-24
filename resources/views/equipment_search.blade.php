@foreach ($data as $item)
<tr>
   <td>
      <span>{{$item->id}}</span>
   </td>
   <td>
      <p class="fw-normal mb-1">{{$item->serial_number}}</p>
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
      <a href="/equipment_user/{{$item->user->id}}">
         <p class="fw-normal mb-1"> {{ $item->user->name }}</p>
      </a>
      @else
      <p class="fw-normal mb-1 " style="color: #eb4f34;">Not assigned</p>
      @endif
      <!-- <p class="fw-normal mb-1"> {{ isset($item->user->name) ? $item->user->name : 'Not assigned' }}</p> -->
   </td>
   <td>
      <p class="fw-normal mb-1">{{$item->category->name}}</p>
   </td>
   <td>
      <p class="fw-normal mb-1">{{$item->created_at->format('d/m/Y H:i')}}</p>
   </td>
   <td>
      <p class="fw-normal mb-1">{{$item->updated_at->format('d/m/Y H:i')}}</p>
   </td>
   <td class="d-flex flex-column align-center ">

      <!-- Button trigger Update modal -->
      <button type="button" class="btn btn-outline btn-rounded button-update px-4 mb-2 d-flex justify-content-center" data-mdb-toggle="modal" data-mdb-target="#updateModal" data-id="{{$item->id}}">
         <i class="far fa-edit fa-fw editor" style="color: #00a0f0"></i>
         Update
      </button>
      <!-- Button trigger Delete  modal -->
      <button type="button" class="btn btn-outline btn-rounded button-delete px-4 d-flex justify-content-center " data-mdb-toggle="modal" data-mdb-target="#deleteModal" data-id="{{$item->id}}">
         <i class="fas fa-minus-circle" style="color: #f00000"></i>
         Delete
      </button>
   </td>
</tr>


@endforeach



