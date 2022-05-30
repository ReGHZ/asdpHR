<!--register pegawai form Modal -->

<div class="modal fade" id="createpegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Pegawai</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employee.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Nama Lengkap</label>
                                    <input id="name" type="text" placeholder="Nama Lengkap" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email </label>
                                    <input id="email" type="email" placeholder="Email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <input type="password" placeholder="Password"
                                        class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Alamat</label>
                                        <input name="alamat" type="text"
                                            class="form-control @error('alamat') is-invalid @enderror"
                                            value="{{ old('alamat') }}" placeholder="Alamat" />
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin"
                                            class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            data-live-search=" true">
                                            <option value="L"
                                                @if (old('jenis_kelamin') == 'L') selected="selected" @endif>L
                                            </option>
                                            <option value="P"
                                                @if (old('jenis_kelamin') == 'P') selected="selected" @endif>P
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Tanggal Lahir</label>
                                        <input name="tanggal_lahir" type="date" placeholder=""
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Tempat Lahir</label>
                                        <input name='tempat_lahir' type="text" placeholder="Tempat Lahir"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">NIk</label>
                                        <input name="nik" type="text" placeholder="Nomor Induk Kepegawaian"
                                            class="form-control @error('nik') is-invalid @enderror"
                                            value="{{ old('nik') }}" />
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Nomor Hanphone</label>
                                        <input name="no_hp" type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            value="{{ old('no_hp') }}" placeholder="Nomor Handphone" />
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Department</label>
                                        <select name="divisi_id"
                                            class="form-control @error('divisi_id') is-invalid @enderror">
                                            @foreach ($divisi as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('divisi_id') == $item->id ? 'selected' : null }}>
                                                    {{ $item->nama_divisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('divisi_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Jabatan</label>
                                        <select name="jabatan_id"
                                            class="form-control @error('jabatan_id') is-invalid @enderror">
                                            @foreach ($jabatan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('jabatan_id') == $item->id ? 'selected' : null }}>
                                                    {{ $item->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">tanggal Masuk Kerja</label>
                                        <input name="tanggal_masuk_kerja" type="date"
                                            class="form-control @error('tanggal_masuk_kerja') is-invalid @enderror"
                                            value="{{ old('tanggal_masuk_kerja') }}" />
                                        @error('tanggal_masuk_kerja')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Tanggal Menjabat</label>
                                        <input name="tanggal_pilih_jabatan" type="date"
                                            class="form-control @error('tanggal_pilih_jabatan') is-invalid @enderror"
                                            value="{{ old('tanggal_pilih_jabatan') }}" />
                                        @error('tanggal_pilih_jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tambah</span>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
