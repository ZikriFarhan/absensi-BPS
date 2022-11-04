<style>
    @media print {
        @page {
            margin-top: 30px;
        }

        .btn,
        .last,
        footer,
        a#debug-icon-link {
            display: none;
        }
    }
</style>
<div class="container-fluid">
    <!-- Content Wrapper. Contains page content -->
    <?php if (session()->getFlashData('error')) { ?>
        <script>
            alert('<?= session()->getFlashData('error') ?>')
        </script>
    <?php } ?>

    <?php if (session()->getFlashData('success')) { ?>
        <script>
            alert('<?= session()->getFlashData('success') ?>')
        </script>
    <?php } ?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="m-0">Data Bidang</h1>
                <div class="ml-auto">
                    <!-- tombol tambah data -->
                    <button onclick="window.print()" class="btn-sm btn-outline-secondary ml-auto mr-1" style="height:38px;">Cetak <i class="fa fa-print"></i></button>
                    <a class="btn btn-primary float-right" id="btnTambah" href="<?php echo base_url("bidang/new") ?>" role="button">
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
                                    $no = 1;
                                    foreach ($data as $row) : ?>

                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?= $row['nama_bidang']; ?></td>
                                            <td class="last">
                                                <a href="/bidang/show/<?= $row['id']; ?>" class="btn btn-primary mr-1 ml-1">Detail</a>
                                                <a href="/bidang/edit/<?= $row['id']; ?>" class="btn btn-warning mr-1 ml-1">Edit</a>
                                                <form action="/bidang/delete/<?= $row['id']; ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger mr-1 ml-1" onclick="return confirm('Apakah anda yakin?');">Delete</button>
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