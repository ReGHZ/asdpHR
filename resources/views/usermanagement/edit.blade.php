<!--edit user form Modal -->

<div class="modal fade" id="empedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit User Profile</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.updateProfile') }}" method="POST">
                    @csrf

                    @method('PUT')

                    <input type="hidden" name="emp_id" id="emp_id" />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
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
                                    <label class="form-control-label">Password Baru</label>
                                    <input id="password" name="password" type="password" placeholder="Password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <label class="form-control-label">Alamat</label>
                                    <input id="alamat" name="alamat" type="text"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        value="{{ old('alamat') }}" placeholder="Alamat" />
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Nomor Hanphone</label>
                                        <input id="no_hp" name="no_hp" type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            value="{{ old('no_hp') }}" placeholder="Nomor Handphone" />
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin"
                                            class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            data-live-search=" true">
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" @if ($user->jenis_kelamin == 'Laki-laki') selected @endif>
                                                Laki-laki
                                            </option>
                                            <option value="Perempuan" @if ($user->jenis_kelamin == 'Perempuan') selected @endif>
                                                Perempuan
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
                                        <input id="tanggal_lahir" name="tanggal_lahir" type="date" placeholder=""
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Tempat Lahir</label>
                                        <input id="tempat_lahir" name='tempat_lahir' type="text"
                                            placeholder="Tempat Lahir"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
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
                    <span class="d-none d-sm-block">Update</span>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--edit personal form Modal -->
<div class="modal fade" id="editpersonal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Personal Informasi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.updatePersonal') }}" method="POST">
                    @csrf

                    @method('PUT')

                    <input type="hidden" name="per_id" id="per_id" />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Status Keluarga</label>
                                        <input id="status_keluarga" name="status_keluarga" type="text"
                                            class="form-control @error('status_keluarga') is-invalid @enderror"
                                            value="{{ old('status_keluarga') }}" placeholder="Status Keluarga" />
                                        @error('status_keluarga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Pendidikan Terakhir</label>
                                        <input id="pendidikan" name="pendidikan" type="text"
                                            class="form-control @error('pendidikan') is-invalid @enderror"
                                            value="{{ old('pendidikan') }}" placeholder="Pendidikan Terakhir" />
                                        @error('pendidikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Jurusan</label>
                                        <input id="jurusan" name="jurusan" type="text"
                                            placeholder="Jurusan Pendidikan Terakhir"
                                            class="form-control @error('jurusan') is-invalid @enderror"
                                            value="{{ old('jurusan') }}">
                                        @error('jurusan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">KTP</label>
                                        <input id="nik_ktp" name='nik_ktp' type="text" placeholder="KTP"
                                            class="form-control @error('nik_ktp') is-invalid @enderror"
                                            value="{{ old('nik_ktp') }}">
                                        @error('nik_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Nomor BPJS Kesehatan</label>
                                        <input id="no_bpjs_kesehatan" name="no_bpjs_kesehatan" type="text"
                                            placeholder="Nomor BPJS Kesehatan"
                                            class="form-control @error('no_bpjs_kesehatan') is-invalid @enderror"
                                            value="{{ old('no_bpjs_kesehatan') }}">
                                        @error('no_bpjs_kesehatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Nomor BPJS Ketenagakerjaan</label>
                                        <input id="no_bpjs_ketenagakerjaan" name='no_bpjs_ketenagakerjaan'
                                            type="text" placeholder="Nomor BPJS Ketenagakerjaan"
                                            class="form-control @error('no_bpjs_ketenagakerjaan') is-invalid @enderror"
                                            value="{{ old('no_bpjs_ketenagakerjaan') }}">
                                        @error('no_bpjs_ketenagakerjaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Nomor Rekening</label>
                                        <input id="no_rek" name="no_rek" type="text"
                                            placeholder="Nomor Rekening"
                                            class="form-control @error('no_rek') is-invalid @enderror"
                                            value="{{ old('no_rek') }}" />
                                        @error('no_rek')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">NPWP</label>
                                        <input id="npwp" name="npwp" type="text"
                                            class="form-control @error('npwp') is-invalid @enderror"
                                            value="{{ old('npwp') }}" placeholder="NPWP" />
                                        @error('npwp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Ukuran Baju</label>
                                        <input id="ukuran_baju" name="ukuran_baju" type="text"
                                            class="form-control @error('ukuran_baju') is-invalid @enderror"
                                            value="{{ old('ukuran_baju') }}" placeholder="Ukuran Baju" />
                                        @error('ukuran_baju')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Ukuran Sepatu</label>
                                        <input id="ukuran_sepatu" name="ukuran_sepatu" type="text"
                                            class="form-control @error('ukuran_sepatu') is-invalid @enderror"
                                            value="{{ old('ukuran_sepatu') }}" placeholder="Ukuran Sepatu" />
                                        @error('ukuran_sepatu')
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
                    <span class="d-none d-sm-block">Update</span>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--edit kantor form Modal -->
<div class="modal fade" id="editkantor" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Data Kantor</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.updateKantor') }}" method="POST">
                    @csrf

                    @method('PUT')

                    <input type="hidden" name="kan_id" id="kan_id" />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-3">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">SK</label>
                                        <input id="sk" name="sk" type="text"
                                            class="form-control @error('sk') is-invalid @enderror"
                                            value="{{ old('sk') }}" placeholder="SK" />
                                        @error('sk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Segmen</label>
                                        <input id="segmen" name="segmen" type="text"
                                            class="form-control @error('segmen') is-invalid @enderror"
                                            value="{{ old('segmen') }}" placeholder="Segmen" />
                                        @error('segmen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Nomor Inhealth</label>
                                        <input id="no_inhealth" name="no_inhealth" type="text"
                                            placeholder="Nomor Inhealth"
                                            class="form-control @error('no_inhealth') is-invalid @enderror"
                                            value="{{ old('no_inhealth') }}" />
                                        @error('no_inhealth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Unit Kerja</label>
                                        <input id="darat_laut_lokasi" name="darat_laut_lokasi" type="text"
                                            class="form-control @error('darat_laut_lokasi') is-invalid @enderror"
                                            value="{{ old('darat_laut_lokasi') }}" placeholder="Unit Kerja" />
                                        @error('darat_laut_lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Golongan Skala THT</label>
                                        <input id="gol_skala_tht" name="gol_skala_tht" type="text"
                                            class="form-control @error('gol_skala_tht') is-invalid @enderror"
                                            value="{{ old('gol_skala_tht') }}" placeholder="Golongan Skala THT" />
                                        @error('gol_skala_tht')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Skala THT</label>
                                        <input id="skala_tht" name="skala_tht" type="text"
                                            class="form-control @error('skala_tht') is-invalid @enderror"
                                            value="{{ old('skala_tht') }}" placeholder="Skala THT" />
                                        @error('skala_tht')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Golongan Skala PHDP</label>
                                        <input id="gol_skala_phdp" name="gol_skala_phdp" type="text"
                                            class="form-control @error('gol_skala_phdp') is-invalid @enderror"
                                            value="{{ old('gol_skala_phdp') }}"
                                            placeholder="Golongan Skala PHDP" />
                                        @error('gol_skala_phdp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Golongan PHDP</label>
                                        <input id="gol_phdp" name="gol_phdp" type="text"
                                            class="form-control @error('gol_phdp') is-invalid @enderror"
                                            value="{{ old('gol_phdp') }}" placeholder="Golongan PHDP" />
                                        @error('gol_phdp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Golongan Skala Gaji</label>
                                        <input id="gol_skala_gaji" name="gol_skala_gaji" type="text"
                                            class="form-control @error('gol_skala_gaji') is-invalid @enderror"
                                            value="{{ old('gol_skala_gaji') }}"
                                            placeholder="Golongan Skala Gaji" />
                                        @error('gol_skala_gaji')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Golongan Gaji</label>
                                        <input id="gol_gaji" name="gol_gaji" type="text"
                                            class="form-control @error('gol_gaji') is-invalid @enderror"
                                            value="{{ old('gol_gaji') }}" placeholder="Golongan Gaji" />
                                        @error('gol_gaji')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label class="form-control-label">Pangkat</label>
                                        <input id="pangkat" name="pangkat" type="text"
                                            class="form-control @error('pangkat') is-invalid @enderror"
                                            value="{{ old('pangkat') }}" placeholder="Pangkat" />
                                        @error('pangkat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-control-label">Golongan</label>
                                        <input id="golongan" name="golongan" type="text"
                                            class="form-control @error('golongan') is-invalid @enderror"
                                            value="{{ old('golongan') }}" placeholder="Golongan" />
                                        @error('golongan')
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
                    <span class="d-none d-sm-block">Update</span>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
