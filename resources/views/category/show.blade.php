@extends('layouts.master')

@section('content')
    <a href="{{ route('categories.index') }}" class="btn mb-3" style="background-color: #303030; color:white">Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="font-weight-bold">Nama Kategori</h5>
            <p>
                {{ $category->name }}
            </p>
        </div>
    </div>
@endsection

@section('title', 'Detail Buku | REN Digital Perpustakaan')
