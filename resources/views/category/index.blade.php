<!-- dalam file resources/views/books/index.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold" style="color: black">Data Kategori</h4>
                <a href="{{ route('categories.create') }}" class="btn mt-3 text-white" style="background-color: #303030">Tambah
                    Kategori</a>
            </div>
            <div class="card-body">
                <table id="datatables" class="table table-striped table-hover table-bordered table-responsive">
                    <thead class="text-center">
                        <tr><b>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </b>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categories.show', $category->id) }}"
                                            class="btn btn-secondary">Lihat</a>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-primary">Ubah</a>
                                        <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-danger"
                                            data-confirm-delete="true">Hapus</a>
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

@section('title', 'Kategori | REN Digital Perpustakaan')
