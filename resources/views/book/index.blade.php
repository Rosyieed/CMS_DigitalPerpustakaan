<!-- dalam file resources/views/books/index.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold" style="color: black">Data Buku</h4>
                <a href="{{ route('books.create') }}" class="btn mt-3 text-white" style="background-color: #303030">Tambah
                    Buku</a>
            </div>
            <div class="card-body">
                <table id="datatables" class="table table-striped table-hover table-bordered table-responsive">
                    <thead>
                        <tr><b>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Kuantitas</th>
                                <th>Buku</th>
                                <th>Foto Sampul</th>
                                <th>Aksi</th>
                            </b>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ Str::limit($book->description, 40) }}</td>
                                <td>{{ $book->category->name }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>
                                    <a href="{{ route('books.PDF', $book->id) }}" target="_blank">Lihat Buku</a>
                                </td>
                                <td class="text-center">
                                    @if (!Storage::exists('public/' . $book->cover_path) || !$book->cover_path)
                                        <img src="{{ asset('assets/img/null.png') }}" alt="Cover Image"
                                            style="max-width: 30px">
                                    @else
                                        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Cover Image"
                                            style="max-width: 30px;">
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary">Lihat</a>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Ubah</a>
                                        <a href="{{ route('books.destroy', $book->id) }}" class="btn btn-danger"
                                            data-confirm-delete="true">Hapus</a>
                                    </div>
                                    {{-- <form method="POST" action="{{ route('books.destroy', $book->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah kamu yakin?')">Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No books available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Buku | REN Digital Library')
