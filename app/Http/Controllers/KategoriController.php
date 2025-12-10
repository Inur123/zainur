<?php


namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategoris.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = Kategori::query();

        if (!empty($kode)) {
            $data_search = $data_search->where('kode', 'LIKE', '%' . $kode . '%');
        }
        if (!empty($nama)) {
            $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        }

        $data_search = $data_search->withCount('masterItems')->orderBy('id')->get();

        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = Kategori::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('kategoris.form.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:kategoris,kode,' . $id
        ]);

        if ($method == 'new') {
            $data_item = new Kategori;
        } else {
            $data_item = Kategori::find($id);
        }

        $data_item->nama = $request->nama;
        $data_item->kode = $request->kode;
        $data_item->save();

        return redirect('kategoris');
    }

    public function singleView($kode)
    {
        $data['data'] = Kategori::where('kode', $kode)->with('masterItems')->first();
        return view('kategoris.single.index', $data);
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();
        return redirect('kategoris');
    }

    public function printPDF($kode)
    {
        $data['kategori'] = Kategori::where('kode', $kode)->with('masterItems')->first();
        $data['printed_at'] = now()->format('d F Y H:i:s');

        $pdf = Pdf::loadView('kategoris.pdf.print', $data);
        return $pdf->download('kategori-' . $kode . '-' . date('YmdHis') . '.pdf');
    }
}
