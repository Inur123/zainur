<?php

namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MasterItemsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MasterItem::with('kategoris')->orderBy('id')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Kategori',
            'Nama Items',
            'Nama Supplier',
            'Harga',
            'Laba (%)',
            'Harga Jual'
        ];
    }

    /**
     * @param mixed $item
     */
    public function map($item): array
    {
        static $no = 0;
        $no++;

        // Get kategori names separated by comma
        $kategoriNames = $item->kategoris->pluck('nama')->implode(', ');
        if (empty($kategoriNames)) {
            $kategoriNames = '-';
        }

        // Calculate harga jual
        $hargaJual = $item->harga_beli + ($item->harga_beli * $item->laba / 100);

        return [
            $no,
            $kategoriNames,
            $item->nama,
            $item->supplier,
            $item->harga_beli,
            $item->laba,
            round($hargaJual)
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 30,
            'D' => 20,
            'E' => 15,
            'F' => 12,
            'G' => 15,
        ];
    }
}

