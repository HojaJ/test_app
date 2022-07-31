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
                                <th>Gifts</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>@if($data->gifts)
                                    @foreach($data->gifts as $gift)
                                        {{ $gift->name  }}<br/>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('gift_box.edit', $data->id)}}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <form action="{{ route('gift_box.give_to_user') }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <input type="hidden" name="gift_box_id" value="{{$data->id}}">
                                        <select name="user_id" class="btn btn-info btn-sm">
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                @if($data->user?->id && $user->id === $data->user->id)
                                                    <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-info btn-sm">Give to User</button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                    <form action="{{ route('gift_box.destroy', $data->id) }}" method="POST" class="d-inline-block">
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
            <form action="{{ route('gift_box.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Gift Box</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInput">Gift Box Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInput" placeholder="Gift Box Name" required>
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
