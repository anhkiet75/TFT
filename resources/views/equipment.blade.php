@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex flex-column" id="container">

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


   <div class="d-flex justify-content-between mt-4">

      <!-- Search form -->
      <form class="d-none d-md-flex input-group w-auto my-auto" action="#">
         <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search ID or Serial Number' style="min-width: 250px" name="id" id="searchtable" />
         <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
         </button>
      </form>

      <div>
         <button type="button" class="btn btn-outline-primary btn-rounded button-create mb-2" data-mdb-toggle="modal" data-mdb-target="#createModal">
            <i class="fa fa-2x fa-plus"></i>
            <span style="font-size: 20px;">New</span>
         </button>
      </div>
   </div>
   <table class="table table-hover align-middle mb-0 bg-white">
      <thead class="bg-light  table-dark">

         <tr>
            <th>ID</th>
            <th>Serial Number</th>
            <th>Name</th>
            <th>Status</th>
            <th>Description</th>
            <th>User</th>
            <th>Category</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>

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
            <td class="d-flex flex-column">

               <!-- Button trigger Update modal -->
               <button type="button" class="btn btn-outline btn-rounded button-update px-4 mb-2 d-flex" data-mdb-toggle="modal" data-mdb-target="#updateModal" data-id="{{$item->id}}">
                  <i class="far fa-edit fa-fw editor" style="color: #00a0f0"></i>
                  Update
               </button>
               <!-- Button trigger Delete  modal -->
               <button type="button" class="btn btn-outline btn-rounded button-delete px-4 d-flex" data-mdb-toggle="modal" data-mdb-target="#deleteModal" data-id="{{$item->id}}">
                  <i class="fas fa-minus-circle" style="color: #f00000"></i>
                  Delete
               </button>
            </td>
         </tr>

         @endforeach
      </tbody>

      <!-- update modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Equipment</h5>
                  <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">

                  <form action="" method="post" id="formUpdate">


                     {{ method_field('PATCH') }}
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label for="formUpdateName" class="form-label">Name</label>
                        <input type="text" id="formUpdateName" class="form-control formUpdateName" name="name" />
                        <label for="formUpdateName" style="color:red" class="form-label" id="label-form-update"></label>
                     </div>

                     <div class="form-group">
                        <label for="formUpdateStatus" class="form-label">Status</label>
                        <select class="form-select formUpdateStatus" aria-label="Default select example" name="status" id="formUpdateStatus">
                           <option value="Available">Available</option>
                           <option value="In-use">In-use</option>
                           <option value="Broken">Broken</option>
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="formUpdateDescription" class="form-label">Description</label>
                        <input type="text" id="formdesc" class="form-control formUpdateDescription" name="description" id="formUpdateDescription" />
                        <label for="formUpdateDescription" style="color:red;" class="form-label" id="label-desc-form-update"></label>
                     </div>

                     <div class="form-group d-flex flex-column">
                        <label for="formUpdateUser" class="form-label">User</label>
                        <input autocomplete="off" type="search" class="form-control rounded searchUpdate" placeholder='Search User Name' style="min-width: 250px" id="searchUpdate"></input>
                        <select class="form-select formUpdateUser" id="formUpdateUser" aria-label="Default select example" name="user_id">
                           <option value="">Null</option>
                           @foreach ($user as $u)
                           <option value="{{$u->id}}">{{$u->id}} {{$u->name}}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="formUpdateCate" class="form-label">Category</label>
                        <select class="form-select formUpdateCate" aria-label="Default select example" id="formUpdateCate" name="category_id">
                           @foreach ($category as $cate)
                           <option value="{{$cate->id}}">{{$cate->name}}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modalUpdate">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- delete modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Delete Equipment</h5>
                  <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <h4>Are you sure want to delete equipment ?</h4>
                  <form action="" method="post" id="formDelete">
                     @csrf
                     @method('DELETE')

                     <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="modalDelete">Delete</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- create modal -->
      <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Create Equipment</h5>
                  <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="" method="post" id="formCreate">
                     @csrf
                     <div class="form-group">
                        <label for="form4name" class="form-label">Name</label>
                        <input type="text" id="form4name" class="form-control" name="name" />
                        <label for="form4name" style="color:red" class="form-label" id="label-form-create"></label>
                     </div>

                     <div class="form-group">
                        <label for="forformstatusm4name" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                           <option value="Available">Available</option>
                           <option value="In-use">In-use</option>
                           <option value="Broken">Broken</option>
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="formdesc" class="form-label">Description</label>
                        <input type="text" id="formdesc" class="form-control formCreateDescription" name="description" />
                        <label for="formdesc" style="color:red" class="form-label" id="label-desc-form-create"></label>
                     </div>

                     <div class="form-group d-flex flex-column">
                        <!-- <label for="formselect" class="form-label">User</label>
                        <select class="form-select" id="formselect" aria-label="Default select example" name="user_id">
                           <option value="">Null</option>
                           @foreach ($user as $u)
                           <option value="{{$u->id}}">{{$u->id}} {{$u->name}}</option>
                           @endforeach
                        </select> -->

                        <label for="formUpdateUser" class="form-label">User</label>
                        <input autocomplete="off" type="search" class="form-control rounded searchUpdate" placeholder='Search ID or User Name' style="min-width: 250px" id="searchUpdate"></input>
                        <select class="form-select formUpdateUser" id="formUpdateUser" aria-label="Default select example" name="user_id">
                           <option value="">Null</option>
                           @foreach ($user as $u)
                           <option value="{{$u->id}}">{{$u->id}} {{$u->name}}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-group">
                        <label for="form4category" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                           @foreach ($category as $cate)
                           <option value="{{$cate->id}}">{{$cate->name}}</option>
                           @endforeach
                        </select>

                     </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modalCreate">Create</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>




   </table>

   @if ($data->links())
   <div class="d-flex mt-2 flex-end paginate">
      {!! $data->links() !!}
   </div>
   @endif

   <script src="/js/autocomplete.js"></script>

   <script>
      const app = <?php echo json_encode($data); ?>;
      console.log(app)
      const user = <?php echo json_encode($user); ?>;
      console.log(user)
      const cate = <?php echo json_encode($category); ?>;
      console.log(cate)


      function addEvent() {
         const btnUpdate = $('.button-update')
         btnUpdate.click(function() {
            var id = $(this).data('id');
            // console.log(id)
            const data = app.data.find(element => element.id == id);

            $('.formUpdateName').val(data.name)
            $('.formUpdateStatus').val('In-use')
            $('.formUpdateDescription').val(data.description)
            if (data.user) $('.formUpdateUser').val(data.user.id)
            $('.formUpdateCate').val(data.category.id)
            console.log("abcd")
            let btnModelUpdate = $("#modalUpdate")
            let formUpdate = $('#formUpdate')

            btnModelUpdate.on("click", function(e) {
               e.preventDefault();
               label = $('#label-form-update')
               labelDesc = $('#label-desc-form-update')
               desc = $('.formUpdateDescription').val()
               name = $('#formUpdateName').val()
              if (name === "") label.text("The name field is required.")
              if (desc === "") labelDesc.text("The description field is required.")
              if (name && desc)
                  formUpdate.attr('action', `/equipment/${id}`).submit();
            });
         })

         const btnDelete = $('.button-delete')
         btnDelete.click(function() {
            var id = $(this).data('id');
            let btnModelDelete = $("#modalDelete")
            let formDelete = $("#formDelete")
            btnModelDelete.on("click", function(e) {
               e.preventDefault();
               formDelete.attr('action', `/equipment/${id}`).submit();
            })
         })

         const btnCreate = $('.button-create')
         btnCreate.click(function() {
            let btnModelCreate = $("#modalCreate")
            let formCreate = $("#formCreate")
            btnModelCreate.on("click", function(e) {
               e.preventDefault();
               label = $('#label-form-create')
               labelDesc = $('#label-desc-form-create')
               desc = $('.formCreateDescription').val()
               name = $('#form4name').val()
               console.log(desc)
               console.log(name)
               if (name === "") label.text("The name field is required.")
               if (desc === "") labelDesc.text("The description field is required.")
               if (name && desc)
                  formCreate.prop('action', `/equipment`).submit();
            })
         })
      }

      addEvent()

      $('#searchtable').on('keyup', function() {
         $value = $(this).val();
         $.ajaxSetup({
            headers: {
               'csrf.token': '{{ csrf_token() }}'
            }
         })
         $.ajax({
            type: 'get',
            url: '{{URL::to("/api/equipment/search")}}',
            data: {
               'search': $value
            },
            success: function(data) {
               $('tbody').html(data);
               addEvent()
               // console.log(data)
            }
         });
      })

      $('.searchUpdate').on('keyup', function() {

         $value = $(this).val();
         $.ajaxSetup({
            headers: {
               'csrf.token': '{{ csrf_token() }}'
            }
         })
         $.ajax({
            type: 'get',
            url: '{{URL::to("/api/equipment/livesearch")}}',
            data: {
               'search': $value
            },
            success: function(data) {
               console.log(data)
               // $('tbody').html(data);
               $('.formUpdateUser')
                  .find('option')
                  .remove()
                  .end()
               data.forEach((element) => {
                  $('.formUpdateUser')
                     .append($('<option>')
                        .val(element.id).text(element.name));
               })
               $('.formUpdateUser')
                  .append($('<option>')
                     .val("").text("NULL"))
            }
         });
      })
   </script>


</div>
@endsection