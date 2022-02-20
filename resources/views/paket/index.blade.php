@extends('layouts.main')


@section('content')

<!-- Modal -->
<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 ">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary mb-2"  data-toggle="modal" data-target="#tblpaket"><i class="ni ni-fat-add"></i> Tambah Data</button>
                    </div>
                    @include('paket.create')
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
          <h3 class="mb-0">Tabel Data Paket</h3>
        </div>
        <div class="table-responsive">
          <table id="tb-paket" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Outlet</th>
                <th scope="col">Jenis</th>
                <th scope="col">Nama Paket</th>
                <th scope="col">Harga</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
             @foreach ($paket as $p)
                <tr>
                    <td>{{ $i=(isset($i)?++$i:$i=1) }}</td>
                    <td>{{ $p->outlet->nama_outlet }}</td>
                    <td>{{ $p->jenis }}</td>
                    <td>{{ $p->nama_paket }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>
                        @include('paket.edit')
                         <form action="/{{ request()->segment(1)}}/paket/{{ $p->id }}" method="post" class="d-inline">
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

@push('script')

<script>
$(function(){
    $('#tb-paket').DataTable();
});
</script>

@endpush

@endsection
