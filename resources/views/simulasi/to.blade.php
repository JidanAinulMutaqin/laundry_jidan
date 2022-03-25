@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-3 col-lg-6 ">
            <div class="card card-stats mb-4 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12 mb-md-0 mb-4 d-flex justify-content-center">
                            <b style="text-align: center">Simulasi Gaji Karyawan</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form id="formKaryawan">
        <div class="row">
            <div class="col mb-3">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3>Form</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="id_karyawan" class="col-sm-2 col-form-label">ID Karyawan</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="id_karyawan" id="id_karyawan" min="0"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama karyawan"
                                    required>
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
                            <label for="status" class="col-sm-2 col-form-label">Status Menikah</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="status" id="status">
                                    <option selected>Pilih Status</option>
                                    <option name="status" value="single">Single</option>
                                    <option name="status" value="couple">Couple</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jml_anak" class="col-sm-2 col-form-label">Jumlah Anak</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="jml_anak" id="jml_anak" min="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mulai_bekerja" class="col-sm-2 col-form-label">Mulai Bekerja</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="mulai_bekerja" id="mulai_bekerja"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" id="btnSimpan" type="submit">Input</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- end form --}}

    {{-- Data --}}
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3>Data</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <button class="btn btn-success" type="button" id="sorting">Sorting</button>
                            </div>
                            <div class="col-md-6 col-sm-4">
                                <input type="search" class="form-control" name="search" id="search">
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <button class="btn btn-dark" type="button" id="btnSearch">Cari</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-compact table-stripped table-borderless" id="tblGaji">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Status</th>
                                <th>Jml Anak</th>
                                <th>Mulai Bekerja</th>
                                <th>Gaji Awal</th>
                                <th>Tunjangan</th>
                                <th>Total Gaji</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9" align="center">Belum ada data</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr style="background:RoyalBlue;color:whitesmoke;font-weight:bold;font-size:1em">
                                <td colspan="6" style="text-align: center">TOTAL</td>
                                <td id="total1"></td>
                                <td id="total2"></td>
                                <td id="total3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end data --}}
@endsection

@push('script')
    <script>
        //methhods
        function insert() {
            const data = $('#formKaryawan').serializeArray()
            let dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            let newData = {}
            data.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id_karyawan' ||
                    name === 'jml_anak' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            //console.log(newData)

            localStorage.setItem('dataKaryawan', JSON.stringify([...dataKaryawan, newData]))
            return newData
        }

        $('#status').on('change', function() {
            let value = $('#status').val()
            console.log(value)
            if (value == 'single') {
                $('#jml_anak').val(0)
                $('#jml_anak').attr('readonly', true)
            } else {
                $('#jml_anak').attr('readonly', false)

            }
        })

        $('#jml_anak').on('change', function() {
            let value = $('#jml_anak').val()
            console.log(value)
            if (value >= 1) {
                $('#status').val('couple')
                $('#status').attr('readonly', true)
            } else {
                $('#status').attr('readonly', false)

            }
        })
        //end of events

        // function calculateAge(birthday) {
        //     birthday = new Date(birthday)
        //     var ageDifms = Date.now() - birthday.getTime();
        //     var ageDate = new Date(ageDifms);
        //     return Math.abs(ageDate.getUTCFullYear - 1970);
        // }

        function showData(dataKaryawan) {
            let row = ''
            //let arr = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            if (dataKaryawan.length == 0) {
                return row = `<tr><td colspan="9" align="center">Belum ada data</td></tr>`
            }
            dataKaryawan.forEach(function(item, index) {

                const awal = 2000000
                const bonusTahun = 150000
                const bonusAnak = 150000
                const bonusCouple = 250000

                dan = new Date(item['mulai_bekerja'])
                var ageDifMs = Date.now() - dan.getTime();
                var ageDate = new Date(ageDifMs)
                var newAge = Math.abs(ageDate.getUTCFullYear() - 1970)
                var tahun = newAge * bonusTahun

                if (item['jml_anak'] >= 2) {
                    var child = 2
                } else if (item['jml_anak'] != 1) {
                    var child = 0
                } else {
                    var child = 1
                }

                let anak = bonusAnak * child

                let status = (item['status'] === 'couple' ? bonusCouple : 0)
                let tunjangan = anak + status + tahun

                let total = tunjangan + awal

                row += `<tr>`
                row += `<td>${item['id_karyawan']}</td>`
                row += `<td>${item['nama']}</td>`
                row += `<td>${item['jk']}</td>`
                row += `<td>${item['status']}</td>`
                row += `<td>${item['jml_anak']}</td>`
                row += `<td>${item['mulai_bekerja']}</td>`
                row += `<td>2000000</td>`
                row += `<td>${tunjangan}</td>`
                row += `<td>${total}</td>`
                row += `</tr>`
            })
            return row
        }

        function total() {
            let table = document.getElementById('tblGaji').getElementsByTagName('tbody')[0]
            let total1 = 0
            let total2 = 0
            let total3 = 0

            for (let i = 0; i < table.children.length; i++) {
                total1 += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText)
                total2 += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText)
                total3 += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[8].innerText)
            }

            document.getElementById('total1').innerText = total1
            document.getElementById('total2').innerText = total2
            document.getElementById('total3').innerText = total3
        }

        function insertionSort(arr, key, type) {
            let i, j, id, value;
            type = type === 'asc' ? '>' : '<'

            if (arr[0].constructor !== Object || !key) return false
            for (i = 1; i < arr.length; i++) {
                value = arr[i];
                id = arr[i][key]
                j = i - 1;

                while (j >= 0 && eval(arr[j][key] + type + id)) {
                    arr[j + 1] = arr[j];
                    j--;
                }
                arr[j + 1] = value;
            }
            return arr
        }

        function searching(arr, key, teks) {
            for (let i = 0; i < arr.length; i++) {
                if (arr[i][key] == teks)
                    return i
            }
            return 'gagal'
        }

        //after load
        $(function() {
            //initialize
            let dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            // console.log(dataKaryawan)
            $('#tblGaji tbody').html(showData(dataKaryawan))
            total()


            //events
            $('#formKaryawan').on('submit', function(e) {
                // console.log(e)
                e.preventDefault();
                insert()
                dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
                $('#tblGaji tbody').html(showData(dataKaryawan))
                total()
            })

            //sorting
            $('#sorting').on('click', function() {
                data = insertionSort(dataKaryawan, 'id_karyawan', 'asc')
                //console.log(data)
                data && $('#tblGaji tbody').html(showData(dataKaryawan))
            })

            //searching
            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataKaryawan, 'id_karyawan', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataKaryawan[id])
                console.log(id)
                console.log(data)
                $('#tblGaji tbody').html(showData(data))
            })
        })
    </script>
@endpush
