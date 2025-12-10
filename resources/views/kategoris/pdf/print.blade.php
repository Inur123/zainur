<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori - {{ $kategori->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 18px;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }
        .info-row {
            margin-bottom: 8px;
        }
        .info-label {
            font-weight: bold;
            width: 120px;
            display: inline-block;
        }
        .table-section {
            margin-top: 20px;
        }
        .table-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table thead {
            background-color: #333;
            color: white;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #666;
            padding: 10px;
            border-top: 1px solid #ddd;
            background-color: white;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DETAIL KATEGORI</h1>
        <h2>{{ config('app.name', 'Laravel') }}</h2>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Kode Kategori:</span>
            <span>{{ $kategori->kode }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Nama Kategori:</span>
            <span>{{ $kategori->nama }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Jumlah Item:</span>
            <span>{{ $kategori->masterItems->count() }} item</span>
        </div>
    </div>

    <div class="table-section">
        <div class="table-title">Daftar Master Items</div>

        @if($kategori->masterItems->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Kode</th>
                        <th width="25%">Nama Item</th>
                        <th width="15%">Jenis</th>
                        <th width="20%" class="text-right">Harga Beli</th>
                        <th width="20%" class="text-right">Harga Jual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori->masterItems as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td class="text-right">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($item->harga_beli + ($item->harga_beli * $item->laba / 100), 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                Tidak ada item dengan kategori ini.
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ $printed_at }}</p>
        <p>Dokumen ini digenerate otomatis oleh sistem</p>
    </div>
</body>
</html>
