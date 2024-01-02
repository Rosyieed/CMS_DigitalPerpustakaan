{{-- Bootstrap for Choose File --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

@extends('layouts.master')

@section('content')
    <div class="container">
        <a href="{{ route('books.index') }}" class="btn mb-3" style="background-color: #303030; color:white">Kembali</a>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-black">Tambah Buku</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/books" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input id="x" type="hidden" name="description" value="{{ old('body') }}">
                        <div class="trix-container">
                            <trix-editor input="x"></trix-editor>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control" id="select2" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Buku PDF</label>
                        <input type="file" name="file_path" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="form-label" class="form-label">Cover Buku</label>
                        <input type="file" name="cover_path" class="form-control">
                    </div>

                    <button type="submit" class="btn" style="background-color: #303030; color:white">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Tambah Buku | REN Digital Perpustakaan')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
