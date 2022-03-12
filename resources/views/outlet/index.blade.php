@extends('layouts.main')


@section('content')
    <!-- Modal -->
    <div class="row">
        <div class="col-md-4 col-xl-3 col-lg-6 ">
            <div class="card card-stats mb-4 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                data-target="#tbloutlet"><i class="ni ni-fat-add"></i> Tambah Data</button>
                        </div>
                        @include('outlet.create')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 ">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                        <a href="{{ route('export-outlet') }}" class="btn btn-success mb-2">
                            <i class="ni ni-bold-right"></i> Export
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 ">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-md-0 mb-4 d-flex justify-content-center">

                        {{-- button modal --}}
                        <button type="button" class="btn btn-warning mb-2 " data-toggle="modal"
                            data-target="#importModal"><i class="ni ni-bold-left"></i> Import</button>

                        <!-- Modal -->
                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importModalLabel">Import Data Outlet</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ url(request()->segment(1).'/outlet/import') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="file" name="file2" class="form-control border"
                                                            placeholder="Pilih file excel(.xlsx)">
                                                    </div>
                                                    @error('file2')
                                                        <div class="'alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-warning" id="submit">  Import</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->

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
                    <h3 class="mb-0">Tabel Data Outlet</h3>
                </div>
                <div class="table-responsive">
                    <table id="tb-outlet" class="table align-items-center table-borderless">
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
                                        <form action="/{{ request()->segment(1) }}/outlet/{{ $o->id }}"
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
@endsection

@push('script')
    <script>
        $(function() {
            $('#tb-outlet').DataTable();
        });
    </script>
@endpush
