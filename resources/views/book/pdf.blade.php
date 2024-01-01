<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Daftar Buku ({{ now()->translatedFormat('d F Y') }})</title>
    <style>
        #books {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }

        #books td,
        #books th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #books tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #books tr:hover {
            background-color: #ddd;
        }

        #books th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #303030;
            color: white;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center">LAPORAN DAFTAR BUKU<br>REN - DIGITAL PERPUSTAKAAN</h3>
    <p style="text-align: right; font-size: 12px">Dicetak pada {{ now()->translatedFormat('l, d F Y') }} </p>
    <table id="books">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $index => $book)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">{{ $book->description }}
                    </td>
                    @if ($book->category_id == null)
                        <td style="text-align: center">Kosong</td>
                    @else
                        <td style="text-align: center">{{ $book->category->name }}</td>
                    @endif
                    <td style="text-align: center">{{ $book->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center">Tidak ada data yang tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
