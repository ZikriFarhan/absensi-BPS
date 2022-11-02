<style>
    @media print{
      @page {
        margin-top:30px;
      }
      .btn,
      .last,
      footer,
      a#debug-icon-link{
        display: none;
      }
    }
</style>
<div class="container-fluid">
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="m-0">Data Bidang</h1>
                <div class="ml-auto">
                    <!-- tombol tambah data -->
                    <button onclick="window.print()" class="btn-sm btn-outline-secondary ml-auto mr-1" style="height:38px;">Cetak <i class="fa fa-print"></i></button>
                    <a class="btn btn-primary float-right" id="btnTambah" href="<?php echo base_url("bidang/new") ?>"role="button">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div><!-- /.col -->
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-body table-responsive">
                            <table id="tabel-bidang" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bidang</th>
                                        <th class="last">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $no=1;
                                        foreach($data as $row) : ?>

                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?= $row['nama_bidang']; ?></td>
                                            <td class="last">
                                                <a href="/bidang/show/<?= $row['id']; ?>" class="btn btn-primary mr-1 ml-1">Detail</a>
                                                <a href="/bidang/edit/<?= $row['id']; ?>" class="btn btn-warning mr-1 ml-1">Edit</a>
                                                <form action="/bidang/delete/<?= $row['id']; ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger mr-1 ml-1" onclick="return confirm('Apakah anda yakin? Seluruh data Absensi atas nama ini akan terhapus');">Delete</button>
                                                </form>
                                            </td>
            
                                        </tr>

                                        <?php endforeach; ?> 
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                </div>
            
                <div class="row">

                </div>
            <?php
            
            ?>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
<script>
     // ============================================ Form =============================================
        // Tampilkan Modal Form Input Data
        $('#btnTambah').click(function() {
            // sembunyikan image preview
            $('#imagePreview').hide();
            // reset form
            $('#formBidang')[0].reset();
            $('#id_jenis').val('').trigger('chosen:updated');
            $('#id_satuan').val('').trigger('chosen:updated');
            // judul form
            $('#modalLabel').text('Input Data Sampah');
        });

        // Tampilkan Modal Form Edit Data
        $('body').on('click', '.btnEdit', function() {
            // judul form
            $('#modalLabel').text('Edit Data Sampah');
            // ambil data dari datatables
            var data = table.row($(this).parents('tr')).data();
            // tampilkan berdasarkan id_sampah
            const id_sampah = $(this).attr('value');
            $.ajax({
                url: "/Sampah/show/" + id_sampah,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id_bidang').val(data.id);
                    $('#nama_bidang').val(data.nama_bidang);
                    $('#modalBidang').modal('show');
                }
            })
        });

        // simpan data ke database
        $('#btnSimpan').on('click', function() {
            // jika form input data sampah yang ditampilkan, jalankan perintah simpan
            if ($('#modalLabel').text() == "Input Data Bidang") {
                var data = new FormData($("#formBidang")[0]);
                $.ajax({
                    url: "/Sampah/save",
                    method: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data) {
                        //Data error 
                        if (data.error) {
                            if (data.bidang_error['nama_bidang'] != '') $('#nama_bidang_error').html(data.bidang_error['nama_bidang']);
                            else $('#nama_bidang_error').html('');
                            if (data.bidang_error['id_jenis'] != '') $('#id_jenis_error').html(data.bidang_error['id_jenis']);
                            else $('#id_jenis_error').html('');
                        }
                        //Data sampah berhasil disimpan
                        if (data.success) {
                            // reset form
                            $('#formBidang')[0].reset();
                            $('#modalBidang').modal('hide');
                            $('#nama_bidang_error').html('');
                            $('#id_jenis_error').html('');
                            $('#id_satuan_error').html('');
                            $('#deskripsi_error').html('');
                            $('#harga_error').html('');
                            $('#stok_error').html('');
                            $('#foto_error').html('');
                            $('#tabel-sampah').DataTable().ajax.reload();
                            // tampilkan pesan sukses simpan data
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Sampah berhasil disimpan.'
                            })
                            $('#imagePreview').hide();
                        }
                    }
                });
            } else if ($('#modalLabel').text() == "Edit Data Sampah") {
                var data = new FormData($("#formBidang")[0]);
                $.ajax({
                    url: "/Sampah/update",
                    method: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data) {
                        //Data error 
                        if (data.error) {
                            if (data.bidang_error['nama_bidang'] != '') $('#nama_bidang_error').html(data.bidang_error['nama_bidang']);
                            else $('#nama_bidang_error').html('');
                            if (data.bidang_error['id_jenis'] != '') $('#id_jenis_error').html(data.bidang_error['id_jenis']);
                            else $('#id_jenis_error').html('');
                            if (data.bidang_error['id_satuan'] != '') $('#id_satuan_error').html(data.bidang_error['id_satuan']);
                            else $('#id_satuan_error').html('');
                            if (data.bidang_error['deskripsi'] != '') $('#deskripsi_error').html(data.bidang_error['deskripsi']);
                            else $('#deskripsi_error').html('');
                            if (data.bidang_error['harga'] != '') $('#harga_error').html(data.bidang_error['harga']);
                            else $('#harga_error').html('');
                            if (data.bidang_error['stok'] != '') $('#stok_error').html(data.bidang_error['stok']);
                            else $('#stok_error').html('');
                            if (data.bidang_error['foto'] != '') $('#foto_error').html(data.bidang_error['foto']);
                            else $('#foto_error').html('');
                        }
                        //Data sampah berhasil disimpan
                        if (data.success) {
                            // reset form
                            $('#formBidang')[0].reset();
                            $('#modalBidang').modal('hide');
                            $('#nama_bidang_error').html('');
                            $('#id_jenis_error').html('');
                            $('#id_satuan_error').html('');
                            $('#deskripsi_error').html('');
                            $('#harga_error').html('');
                            $('#stok_error').html('');
                            $('#foto_error').html('');
                            $('#tabel-sampah').DataTable().ajax.reload();
                            // tampilkan pesan sukses simpan data
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Sampah berhasil disimpan.'
                            })
                            $('#imagePreview').hide();
                        }
                    }
                });
            }
        });

        // Hapus data sampah
        $('body').on('click', '.btnHapus', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            Swal.fire({
                title: 'Hapus Data?',
                text: "Anda ingin menghapus data sampah ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: "POST",
                        success: function(response) {
                            $('#tabel-sampah').DataTable().ajax.reload()
                            // tutup sweet alert
                            swal.close();
                            // tampilkan pesan sukses hapus data
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Sampah berhasil dihapus.'
                            })
                        }
                    });
                }
            });
        });
        // ===================================================================
</script>

<!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ini Home Page</h1>
          </div>
    </div> -->
<!-- </div> -->
