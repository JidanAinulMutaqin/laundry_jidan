@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-3 col-lg-6 ">
            <div class="card card-stats mb-4 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                            Simulasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="row">
        <div class="col mb-3">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3>Form</h3>
                </div>
                <div class="card-body">
                    <form id="formKaryawan">
                        <div class="form-group row">
                            <label for="id" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" id="id" placeholder="ID" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="form-check col-sm-2">
                                <input type="radio" class="form-check-input" name="jk" id="jk" value="L">
                                <label class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check col-sm-2">
                                <input type="radio" class="form-check-input" name="jk" id="jk" value="P">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan</button>
                                <button class="btn btn-default" id="btnReset" type="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end form --}}

    {{-- Data --}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3>Data</h3>
                </div>
                <div class="card-body">
                    <table class="table table-compact table-stripped table-borderless" id="tblKaryawan">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" align="center">Belum ada data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end data --}}

@endsection

@push('script')

<script>
function insert() {
    const data = $('#formKaryawan').serializeArray()
    let newData = {}
    data.forEach(function(item, index){
        let name = item['name']
        let value = (name == 'id'? Number(item['value']):item['value'])
        newData[name] = value
    })
    return newData
}
$(function(){
    //property
    let dataKaryawan = []

    //events
    $('#formKaryawan').on('submit', function(e){
        e.preventDefault()
        dataKaryawan.push(insert())
        console.log(dataKaryawan)
    })
    //end of events
})
</script>
@endpush
