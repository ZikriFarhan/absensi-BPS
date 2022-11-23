<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
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

<div class="container-fluid">
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0" style="display:flex; flex-direction:right;">
                <h1 class="m-0">Histori Absensi</h1>
                <button onclick="window.print()" class="btn-sm btn-outline-secondary ml-auto mr-1" style="height:38px;">Cetak <i class="fa fa-print"></i></button>
                <?php if (session('role') === 'admin') : ?>
                    <a href="/presensi/new" class="btn btn-primary mb-2">Tambah</a>
                <?php endif ?>
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
                            <table id="histori" class="table table-bordered table-striped js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Kehadiran</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th class="last">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['tanggal']; ?></td>
                                            <td><?= $row['jam_masuk']; ?></td>
                                            <td><?= $row['jam_keluar']; ?></td>
                                            <td><?= $row['nama_kehadiran']; ?></td>
                                            <td><?= $row['keterangan']; ?></td>
                                            <td><?= $row['nama_status']; ?></td>
                                            <td class="last">
                                                <a href="/presensi/show/<?= $row['id']; ?>" class="btn btn-primary mr-1 ml-1">Detail</a>
                                                <?php if (session('role') === 'admin') : ?>
                                                    <a href="/presensi/edit/<?= $row['id']; ?>" class="btn btn-warning mr-1 ml-1">Edit</a>
                                                    <form action="/presensi/delete/<?= $row['id']; ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger mr-1 ml-1" onclick="return confirm('Apakah anda yakin?');">Delete</button>
                                                    </form>
                                                <?php endif ?>
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
        $('#histori').DataTable();
    });
</script>


<script>
    $(document).ready(function() {
        $('#tabel-bidang').DataTable({});
    });
</script>