@extends('layouts.main')


@section('content')

<!-- Modal -->
<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 ">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary mb-2"  data-toggle="modal" data-target="#tbluser"><i class="ni ni-fat-add"></i> Tambah Data</button>
                    </div>
                    @include('user.create')
                </div>
            </div>
        </div>
    </div>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-12 text-center" id="succes-alert" role="alert">
        {{ session('success') }}
    </div>
@endif

<!-- Table -->
<div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <h3 class="mb-0">Tabel Data Member</h3>
        </div>
        <div class="table-responsive">
          <table id="tb-user" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
             @foreach ($user as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role }}</td>
                    <td>

                        <button type="button" class="badge bg-warning border-0" data-toggle="modal" data-target="#edituserModal{{ $u->id }}">
                            <i class="ni ni-bold-up"></i>
                        </button>

                        <form action="/{{ request()->segment(1)}}/user/{{ $u->id }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="ni ni-fat-remove"></i></button>
                        </form>

                        @include('user.edit')
                    </td>
                </tr>
             @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>









@push('script')

<script>
$(function(){
    $('#tb-user').DataTable();
});
</script>

<script>
    function myFunction() {
        var x = document.getElementById("input_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

@endpush

@endsection

