@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left">&nbsp;&nbsp;</i>Back</a>
    <div class="col-6 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('gift_box.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <h5 class="modal-title" id="exampleModalLabel">Edit  Gift box</h5>
                    <div class="form-group">
                        <label for="exampleInput">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInput" value="{{ $data->name }}" placeholder="Name" required>
                    </div>
                    <div class="m-3">
                        <button type="submit" class="btn btn-primary d-inline-block">Edit</button>
                    </div>
                </form>
            </div>
        </div>

</div>
@endsection

