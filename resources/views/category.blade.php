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
    <div class="d-flex align-items-end flex-column mt-4">
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

                    <!-- Button trigger Update modal -->
                    <button type="button" class="btn btn-outline btn-rounded button-update px-4  mx-2" data-mdb-toggle="modal" data-mdb-target="#updateModal" data-id="{{$item->id}}">
                        <i class="far fa-edit fa-fw editor" style="color: #00a0f0"></i>
                        Update
                    </button>
                    <!-- Button trigger Delete  modal -->
                    <button type="button" class="btn btn-outline btn-sm btn-rounded button-delete px-4" data-mdb-toggle="modal" data-mdb-target="#deleteModal" data-id="{{$item->id}}">
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="formUpdate">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="form-update-name" class="form-label">Name</label>
                                <input type="text" id="form-update-name" class="form-control" name="name" />
                                <label for="form-update-name" style="color:red"
                                 class="form-label" id="label-form-update"></label>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="modalUpdate">Save</button>
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
                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure want to delete category ?</h4>
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
                        <h5 class="modal-title" id="deleteModalLabel">Create Category</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="needs-validation" id="formCreate" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="form-create-name" class="form-label">Name</label>
                                <input type="text" id="form-create-name" class="form-control" name="name" />
                                <label for="form-create-name" class="form-label" style="color:red" id="label-form-create-name"></label>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" id="modalCreate">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </table>

    <div class="d-flex mt-2 flex-end">
        {!! $data->links() !!}
    </div>


    <!-- <form action="" method="post" class="needs-validation" id="formCreate">
        @csrf
        <div class="form-group">
            <label for="form4name" class="form-label">Name</label>
            <input type="text" id="form4name" class="form-control" name="name" required />
            <div class="invalid-feedback">
                bad
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" id="modalCreate">Create</button>
        </div>
    </form> -->

    <style>

    </style>

    <script>
        const app = <?php echo json_encode($data); ?>;
        const btnUpdate = $('.button-update')
        btnUpdate.click(function() {
            var id = $(this).data('id');
            const data = app.data.find(element => element.id === id);
            $('#form-update-name').val(data.name)

            let btnModelUpdate = $("#modalUpdate")
            let formUpdate = $('#formUpdate')

            btnModelUpdate.on("click", function(e) {
                e.preventDefault();
                label = $('#label-form-update')
                name = $('#form-update-name').val()
                if (name === "") label.text("The name field is required.")
                else 
                formUpdate.attr('action', `/category/${id}`).submit();
            });
        })

        const btnDelete = $('.button-delete')
        btnDelete.click(function() {
            var id = $(this).data('id');
            let btnModelDelete = $("#modalDelete")
            let formDelete = $("#formDelete")
            btnModelDelete.on("click", function(e) {
                e.preventDefault();
                formDelete.attr('action', `/category/${id}`).submit();
            })
        })

        let formCreate = $("#formCreate")
        let btnModelCreate = $("#modalCreate")
        btnModelCreate.on("click", function(e) {
            e.preventDefault();
            label = $('#label-form-create-name')
            name = $('#form-create-name').val()
            if (name === "") label.text("The name field is required.")
            else
                formCreate.attr('action', `/category`).submit();
        })
    </script>
</div>
@endsection