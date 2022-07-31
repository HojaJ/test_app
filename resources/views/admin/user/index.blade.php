@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" >
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addItem">
                Add New
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gifts</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>@if($data->gift_boxes)
                                        @foreach($data->gift_boxes as $gift)
                                            {{ $gift->name  }}<br/>
                                            @if($gift->gifts)
                                                <ul>
                                                    @foreach($gift->gifts as $gift_)
                                                        <li>{{ $gift_->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if($data->gifts)
                                        @foreach($data->gifts as $gift)
                                            {{ $gift->name  }}<br/>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('user.edit', $data->id)}}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('user.destroy', $data->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white"  id="poz-buton-{{$data->id}}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top:100px;">
        <div class="modal-content">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInput">User Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInput" placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInput">User Email</label>
                        <input type="text" class="form-control" name="email" id="exampleInput" placeholder="Email" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>




    @push('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('#dataTable').DataTable({
                stateSave: true,
            });

            $('#dataTable tbody').on('click', "[id^='poz-buton-']", function (event) {
                var id = $(this).attr('id');
                id = id.replace("poz-buton-",'');
                event.preventDefault();
                    Swal.fire({
                      title: "Pozmak islýäňizmi!",
                      icon: 'warning',
                      showCancelButton: true,
                      reverseButtons: true,
                      confirmButtonColor: '#0CC27E',
                      cancelButtonColor: '#FF586B',
                      confirmButtonText: 'Howwa, poz!',
                      cancelButtonText: 'Ýok!',
                      confirmButtonClass: 'btn btn-success ml-1',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                          $('#poz-buton-'+id).parent().submit();
                        } else{
                          Swal.fire(
                            'Cancelled',
                            'Goýbolsun edildi',
                            'error'
                          )
                        }
                      })
                });

        });
    </script>

    @endpush
@endsection
