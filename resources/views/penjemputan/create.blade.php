<!-- Modal -->
<div class="modal fade" id="tblpenjemputan" tabindex="-1" aria-labelledby="tblpenjemputanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tblpenjemputanLabel">Tambah penjemputan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="penjemputan" method="POST" class="mb-5">
                    @csrf
                    <div class="mb-3">
                        <label for="id_member" class="form-label">Nama Pelanggan</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="pelanggan"
                            name="id_member">
                            <option selected>Pilih Pelanggan</option>
                            @foreach ($member as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                        @error('pelanggan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="petugas" class="form-label">Petugas Penjemputan</label>
                        <input type="text" class="form-control @error('petugas') is-invalid @enderror" id="petugas"
                            name="petugas" required autofocus value="{{ old('petugas') }}">
                        @error('petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="status" name="status" required autofocus value="{{ old('status') }}">
                          <option selected>Pilih Status</option>
                          <option name="status" value="Tercatat">Tercatat</option>
                          <option name="status" value="Penjemputan">Penjemputan</option>
                          <option name="status" value="Selesai">Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
