@extends('layouts.main')

@section('content')
    <!-- Modal -->
    <div class="row">
        <div class="col-md-4 col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                data-target="#tblpenjemputan"><i class="ni ni-fat-add"></i> Tambah Data</button>
                        </div>
                        @include('penjemputan.create')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                            <a href="{{ route('export-penjemputan') }}" class="btn btn-success mb-2">
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
                                data-target="#importpenjemputanModal"><i class="ni ni-bold-left"></i> Import</button>

                            <!-- Modal -->
                            <div class="modal fade" id="importpenjemputanModal" tabindex="-1"
                                aria-labelledby="importpenjemputanModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importpenjemputanModalLabel">Import Data
                                                Penjemputan
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST"
                                                action="{{ url(request()->segment(1) . '/penjemputan/import') }}"
                                                {{-- action="{{ route('import-penjemputan') }}" --}} enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="file" name="file2" class="form-control border"
                                                                placeholder="Pilih file excel(.xlsx)">
                                                        </div>
                                                        @error('filepenjemputan')
                                                            <div class="'alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-warning" id="submit">
                                                            Import</button>
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
                    <h3 class="mb-0">Tabel Data Penjemputan</h3>
                </div>
                <div class="table-responsive">
                    <table id="tb-penjemputan" class="table align-items-center table-borderless" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Status</th>
                                <th scope="col">Petugas</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjemputan as $pe)
                                <tr>
                                    <td>{{ $loop->iteration }}
                                        <input type="text" hidden class="id" value="{{ $pe->id }}">
                                    </td>
                                    <td>{{ $pe->member->nama }}</td>
                                    <td>{{ $pe->member->alamat }}</td>
                                    <td>{{ $pe->member->telepon }}</td>
                                    <td><select name="status" class="status statusPenjemputan" id="one">
                                            <option name="status" value="tercatat"
                                                {{ $pe->status == 'Tercatat' ? 'selected' : '' }}>
                                                Tercatat</option>
                                            <option name="status" value="penjemputan"
                                                {{ $pe->status == 'Penjemputan' ? 'selected' : '' }}>
                                                Penjemputan</option>
                                            <option name="status" value="selesai"
                                                {{ $pe->status == 'Selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                        </select>
                                    </td>
                                    <td>{{ $pe->petugas }}</td>
                                    <td>
                                        @include('penjemputan.edit')
                                        <form action="/{{ request()->segment(1) }}/penjemputan/{{ $pe->id }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="badge bg-danger delete-penjemputan border-0 "><i
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
            $('#tb-penjemputan').DataTable();

            $('#tb-penjemputan').on('change', '.status', function() {
                let status = $(this).closest('tr').find('.status').val()
                let id = $(this).closest('tr').find('.id').val()
                let data = {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                };
                $.post('{{ route('status') }}', data, function(msg) {

                })
                console.log(id);
                console.log(status);
            });

            // Delete Alert
            $('.delete-penjemputan').click(function(e) {
                e.preventDefault()
                let data = $(this).closest('tr').find('td:eq(1)').text()
                swal({
                        title: "Apakah Kamu Yakin?",
                        text: "Yakin Ingin Menghapus Data yang anda pilih?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((req) => {
                        if (req) $(e.target).closest('form').submit()
                        else swal.close()
                    })
            })

            // status konfirmasi ubah status
            $('.statusPenjemputan').change(function(e) {
                swal({
                        title: "Apakah kamu yakin ingin menggantinya?",
                        text: "Status tersebut akan diganti",
                        icon: "success",
                        buttons: true,
                        dangerMode: false,
                    })
                    .then((req) => {
                        if (req) $(e.target).closest('form').submit()
                        else swal.close()
                    })
            });
        });
    </script>
@endpush
