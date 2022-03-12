@extends('layouts.main')

@section('content')

<!-- Modal -->
<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 ">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary mb-2"  data-toggle="modal" data-target="#tblinventaris"><i class="ni ni-fat-add"></i> Tambah Data</button>
                    </div>
                    @include('inventaris.create')
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
                <h3 class="mb-0">Tabel Barang Inventaris</h3>
            </div>
            <div class="table-responsive">
                <table id="tb-inventaris" class="table align-items-center table-borderless">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Merk Barang</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Tgl Pengadaan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang_inventaris as $bi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bi->nama_barang }}</td>
                                <td>{{ $bi->merk_barang }}</td>
                                <td>{{ $bi->qty }}</td>
                                <td>{{ $bi->kondisi }}</td>
                                <td>{{ $bi->tanggal_pengadaan }}</td>
                                <td>
                                    @include('inventaris.edit')
                                    <form action="/{{ request()->segment(1) }}/inventaris/{{ $bi->id }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Are you sure?')"><i
                                                class="ni ni-fat-remove"></i></button>
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
        $(function() {
            $('#tb-inventaris').DataTable();
        });
    </script>
@endpush

@endsection
