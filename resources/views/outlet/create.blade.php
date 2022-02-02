<!-- Modal -->
<div class="modal fade" id="tbloutlet" tabindex="-1" aria-labelledby="tbloutletLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tbloutletLabel">Tambah Outlet</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/outlet" method="POST" class="mb-5">
                @csrf
                <div class="mb-3">
                  <label for="nama_outlet" class="form-label">Nama</label>
                  <input type="text" class="form-control @error('nama_outlet') is-invalid @enderror" id="nama_outlet" name="nama_outlet" required autofocus value="{{ old('nama_outlet') }}">
                  @error('nama_outlet')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat </label>
                  <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat') }}">
                  @error('alamat')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="telepon" class="form-label">Telepon</label>
                  <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" required autofocus value="{{ old('telepon') }}">
                  @error('telepon')
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
