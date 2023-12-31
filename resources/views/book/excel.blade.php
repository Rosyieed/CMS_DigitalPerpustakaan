<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{now()->translatedFormat('d-m-Y')}}</title>
</head>

<body>

    <h3 style="text-align: center">LAPORAN DAFTAR BUKU<br>REN - DIGITAL PERPUSTAKAAN</h3>
    <p style="text-align: right; font-size: 12px">Dicetak pada {{ now()->translatedFormat('l, d F Y') }} </p>
    <table id="books">
        <thead>
            <tr>
                <th style="text-align: center">No</th>
                <th style="text-align: center">Judul</th>
                <th style="text-align: center">Deskripsi</th>
                <th style="text-align: center">Kategori</th>
                <th style="text-align: center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $index => $book)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->description }}
                    </td>
                    @if ($book->category_id == null)
                        <td style="text-align: center">Kosong</td>
                    @else
                        <td style="text-align: center">{{ $book->category->name }}</td>
                    @endif
                    <td style="text-align: center">{{ $book->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
