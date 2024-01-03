{{-- Bootstrap for Choose File --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

@extends('layouts.master')

@section('title', 'Ubah Buku | REN Digital Perpustakaan')

@section('content')
    <div class="container">
        <a href="{{ route('books.index') }}" class="btn mb-3" style="background-color: #303030; color:white">Kembali</a>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-black">Ubah Buku</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input id="x" type="hidden" name="description" value="{{ old('description', $book->description) }}">
                        <div class="trix-container">
                            <trix-editor input="x"></trix-editor>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control" id="select2" required>
                            @if ($book->category_id == null)
                                <option value="" selected disabled>Kosong</option>
                            @endif
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" class="form-control"
                            value="{{ old('quantity', $book->quantity) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Buku PDF</label>
                        <input type="file" name="file_path" class="form-control">
                        @if ($book->file_path)
                            <p class="text-muted mt-2">Buku PDF Sekarang: <a href="{{ route('books.PDF', $book->id) }}"
                                    target="_blank">Lihat PDF</a></p>
                        @else
                            <p class="text-muted mt-2">Buku PDF Sekarang: Tidak Ada</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Cover Buku</label>
                        <input type="file" name="cover_path" class="form-control">

                        @if (!Storage::exists('public/' . $book->cover_path) || !$book->cover_path)
                            <p class="text-muted mt-2">Cover Sekarang: Tidak Ada</p>
                            <img src="{{ asset('assets/img/null.png') }}" alt="Cover Image" style="max-width: 200px">
                        @else
                            <p class="text-muted mt-2">Cover Sekarang:</p>
                            <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Cover Image"
                                style="max-width: 200px;">
                        @endif
                    </div>

                    <button type="submit" class="btn" style="background-color: #303030; color:white">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
