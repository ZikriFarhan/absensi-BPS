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
<!--  -->
<div class="container-fluid">
   
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="m-0">Daftar Peserta</h1>
                <button onclick="window.print()" class="btn-sm btn-outline-secondary ml-auto mr-1" style="height:38px;">Cetak <i class="fa fa-print"></i></button>
                <a href="/presensi/new" class="btn btn-primary mb-2">Tambah</a>
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
    
