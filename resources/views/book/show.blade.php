@extends('layouts.master')

@section('content')
    <a href="{{ route('books.index') }}" class="btn mb-3" style="background-color: #303030; color:white">Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black text-center">{{ $books->title }}</h6>
            @if (!Storage::exists('public/' . $books->cover_path) || !$books->cover_path)
                <p class="text-center m-3">
                    <img src="{{ asset('assets/img/null.png') }}" alt="Cover Image" style="max-width: 400px">
                </p>
            @else
                <p class="text-center m-3">
                    <img src="{{ asset('storage/' . $books->cover_path) }}" alt="Cover Image" style="max-width: 400px;">
                </p>
            @endif
        </div>
        <div class="card-body">
            <h5 class="font-weight-bold">Penulis</h5>
            <p>
                {{ $books->author }}
            </p>
            <h5 class="font-weight-bold">Deskripsi</h5>
            <p>
                {{ $books->description }}
            </p>
        </div>
    </div>
@endsection

@section('title', 'Detail Buku | REN Digital Perpustakaan')
