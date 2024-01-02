<!-- dalam file resources/views/books/index.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold" style="color: black">Data Buku</h4>
                <div class="d-sm-flex align-items-center justify-content-between mt-3">
                    <a href="{{ route('books.create') }}" class="btn text-white" style="background-color: #303030"><i class="fas fa-plus-circle"></i> Tambah
                        Buku</a>
                    <div class="btn-group" role="group">
                        <a href="{{ route('books.generatePDF') }}" class="btn btn-primary" target="_blank"><i
                                class="fas fa-download fa-sm text-white"></i> Generate PDF</a>
                        <a href="{{ route('books.generateExcel') }}" class="btn btn-success" target="_blank"><i
                                class="fas fa-download fa-sm text-white"></i> Generate Excel</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatables" class="table table-striped table-hover table-bordered table-responsive-lg">
                    <thead class="text-center">
                        <tr><b>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Buku</th>
                                <th>Foto Sampul</th>
                                <th>Aksi</th>
                            </b>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $index => $book)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ Str::limit($book->title, 30) }}</td>
                                <td>{{ Str::limit($book->author, 20) }}</td>
                                @if ($book->category_id == null)
                                    <td class="text-center">Kosong</td>
                                @else
                                    <td class="text-center">{{ $book->category->name }}</td>
                                @endif
                                <td class="text-center">{{ $book->quantity }}</td>
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
                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('books.destroy', $book->id) }}" class="btn btn-danger"
                                            data-confirm-delete="true"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Buku | REN Digital Library')
