@extends('layouts.main')


@section('content')

<!-- Modal -->
<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 ">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary mb-2"  data-toggle="modal" data-target="#tbloutlet"><i class="ni ni-fat-add"></i> Tambah Data</button>
                    </div>
                    @include('outlet.create')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <h3 class="mb-0">Tabel Data Outlet</h3>
        </div>
        <div class="table-responsive">
          <table id="tb-outlet" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Telp</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
             @foreach ($outlet as $o)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $o->nama_outlet }}</td>
                    <td>{{ $o->alamat }}</td>
                    <td>{{ $o->telepon }}</td>
                    <td>
                        @include('outlet.edit')
                         <form action="{{ url('outlet/'.$o->id) }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="ni ni-fat-remove"></i></button>
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


@endsection

@push('script')

<script>
$(function(){
    $('#tb-outlet').DataTable();
});
</script>

@endpush
