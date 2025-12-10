<div class="form-group mb-2">
    <a href="{{url('kategoris/form/new')}}" class="btn btn-primary">Tambah Kategori Baru</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Kode Kategori</label>
            <input type="text" class="form-control" id="filter-kode" placeholder="Cari kode...">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" id="filter-nama" placeholder="Cari nama...">
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <button class="btn btn-success btn-get-data">Cari</button>
</div>

<div id="loading-filter" style="display:none">
    <p>Loading...</p>
</div>
