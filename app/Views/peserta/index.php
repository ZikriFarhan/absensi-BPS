<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    @media print {
        @page {
            margin-top: 30px;
        }

        .btn,
        .last,
        footer,
        a#debug-icon-link,
        label,
        .dataTables_info,
        .dataTables_paginate,
        .paging_simple_numbers {
            display: none;
        }
    }
</style>
<!--  -->
<div class="container-fluid">

    <!-- Content Wrapper. Contains page content -->
    <?php if (session()->getFlashdata('error')) { ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<?= session()->getFlashdata('error'); ?>',
                showConfirmButton: true,
            })
        </script>
    <?php } ?>

    <?php if (session()->getFlashdata('success')) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('success'); ?>',
                showConfirmButton: true,
            })
        </script>
    <?php } ?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0" style="display:flex; flex-direction:right;">
                <h1 class="m-0">Daftar Peserta</h1>
                <button onclick="window.print()" class="btn-sm btn-outline-secondary ml-auto mr-3" style="height:38px;">Cetak <i class="fa fa-print"></i></button>
                <a href="/pesertamagang/new" class="btn btn-primary mb-2">Tambah</a>
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

                            <table id="tabel" class="table table-bordered table-striped js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Universitas</th>
                                        <th>Bidang</th>
                                        <th class="last">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nim']; ?></td>
                                            <td><?= $row['nama_universitas']; ?></td>
                                            <td><?= $row['nama_bidang']; ?></td>
                                            <td class="last">
                                                <a href="/pesertamagang/show/<?= $row['id']; ?>" class="btn btn-primary mr-1 ml-1">Detail</a>
                                                <a href="/pesertamagang/edit/<?= $row['id']; ?>" class="btn btn-warning mr-1 ml-1">Edit</a>
                                                <form action="/pesertamagang/delete/<?= $row['id']; ?>" method="post" class="d-inline">
                                                    <button type="submit" class="btn btn-danger mr-1 ml-1 delete" id="delete_button">Delete</button>
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

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>

<script>
    $('.delete').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Seluruh data Absensi atas nama ini akan terhapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    })
</script>