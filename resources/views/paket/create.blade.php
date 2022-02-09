<!-- Modal -->
<div class="modal fade" id="tblpaket" tabindex="-1" aria-labelledby="tblpaketLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tblpaketLabel">Tambah Paket</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="paket" method="POST" class="mb-5">
                @csrf
                <div class="mb-3">
                  <label for="id_outlet" class="form-label">Outlet</label>
                    <select class="form-select form-select mb-3" aria-label=".form-select example" id="outlet" name="id_outlet">
                        <option selected>Pilih Outlet</option>
                        @foreach ($outlet as $o )
                        <option value="{{ $o->id }}">{{ $o->nama_outlet }}</option>
                        @endforeach
                      </select>
                  @error('outlet')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="jenis" class="form-label">Jenis </label>
                  <select class="form-select form-select mb-3" aria-label=".form-select example" id="jenis" name="jenis" required autofocus value="{{ old('jenis') }}">
                    <option selected>Pilih Jenis Paket</option>
                    <option name="jenis" value="kiloan">Kiloan</option>
                    <option name="jenis" value="selimut">Selimut</option>
                    <option name="jenis" value="bed_cover">Bed Cover</option>
                    <option name="jenis" value="kaos">Kaos</option>
                    <option name="jenis" value="lainnya">lainnya</option>
                  </select>
                  @error('jenis')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="nama_paket" class="form-label">Nama Paket</label>
                  <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" required autofocus value="{{ old('nama_paket') }}">
                  @error('nama_paket')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="harga" class="form-label">Harga</label>
                  <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus value="{{ old('harga') }}">
                  @error('harga')
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
