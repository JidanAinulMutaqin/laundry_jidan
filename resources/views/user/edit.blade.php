<!-- Button trigger modal -->


<!-- Modal Edit -->
<div class="modal fade" id="edituserModal{{ $u->id }}" tabindex="-1" aria-labelledby="editmemberModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{ request()->segment(1) }}/user/{{ $u->id }}" method="POST"
                    class="text-dark">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" required autofocus value="{{ old('name', $u->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" required autofocus value="{{ old('username', $u->username) }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" required autofocus value="{{ old('email', $u->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="id_outlet" class="form-label">Outlet</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="outlet"
                            name="id_outlet" required autofocus value="{{ old('id_outlet', $u->id_outlet) }}">
                            <option selected>Pilih Outlet</option>
                            @foreach ($outlet as $o)
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
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select form-select mb-3" aria-label=".form-select example" id="role"
                            name="role" required autofocus value="{{ old('role', $u->role) }}">
                            <option selected>Pilih Role</option>
                            <option name="role" value="admin">Admin</option>
                            <option name="role" value="kasir">Kasir</option>
                            <option name="role" value="owner">Owner</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark btn-outline-primary border-0">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!--End Modal Edit -->
