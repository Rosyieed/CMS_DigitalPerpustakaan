@extends('layouts.master')
@section('content')

    {{-- Change Profile --}}
    <div class="container">
        <a href="/dashboard" class="btn mb-3" style="background-color: #303030; color:white">Kembali</a>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-black">Ubah Profil</h5>
                Perbarui informasi profil dan alamat email akun Anda.
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" name="name" type="text" class="form-control"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn text-white" style="background-color: #303030">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Change Password --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-black">Ubah Password</h5>
                Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanannya.
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="update_password_current_password"
                            class="form-label">{{ __('Current Password') }}</label>
                        <input id="update_password_current_password" name="current_password" type="password"
                            class="form-control" autocomplete="current-password" />
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                        <input id="update_password_password" name="password" type="password" class="form-control"
                            autocomplete="new-password" />
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password_confirmation"
                            class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                            class="form-control" autocomplete="new-password" />
                    </div>

                    <div class="d-flex align-items-center gap-4">
                        <button type="submit" class="btn text-white" style="background-color: #303030">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Ubah Profil | REN Digital Perpustakaan')
