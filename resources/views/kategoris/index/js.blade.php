<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            order: [[0, 'asc']],
        });
        getData();
    });

    $('.btn-get-data').click(function() {
        getData();
    });

    function getData() {
        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        var filter_kode = $('#filter-kode').val();
        var filter_nama = $('#filter-nama').val();
        dataTableObj.clear().draw();

        $.ajax({
            url: "{{url('kategoris/search')}}",
            type: 'GET',
            dataType: 'json',
            data: {
                kode: filter_kode,
                nama: filter_nama
            },
            success: function(response) {
                $('#loading-filter').hide();

                if (response.status == 200) {
                    $.each(response.data, function(index, element) {
                        var btn = '<a class="btn btn-info" href="{{url("kategoris/view")}}/' + element.kode + '">View</a>';
                        var row = [
                            element.kode,
                            element.nama,
                            element.master_items_count,
                            btn
                        ];
                        dataTableObj.row.add(row).draw(false);
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                $('#loading-filter').hide();
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }
</script>
