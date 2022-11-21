<div class="container-fluid">
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php if (session()->getFlashData('error')) { ?>
        <script>
            alert('<?= session()->getFlashData('error') ?>')
        </script>
    <?php } ?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="alert alert-primary">
                        <i class="icon fas fa-user"></i> Selamat Datang
                        <strong><?= session()->get('username') ?></strong>, Anda login sebagai <strong><?= session()->get('role') ?></strong>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (session()->get('role') == 'admin') {?>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $db      = \Config\Database::connect();
                            $builder = $db->table('pesertamagang');
                            $builder->select('*');
                            $peserta = $builder->countAllResults();
                            ?>
                            <h3><?= $peserta; ?></h3>
                            <h6>Peserta PKL</h6>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="../pesertamagang" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $db      = \Config\Database::connect();
                            $builder = $db->table('bidang');
                            $builder->select('*');
                            $bidang = $builder->countAllResults();
                            ?>
                            <h3><?= $bidang; ?></h3>
                            <h6>Divisi</h6>
                        </div>
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                        <a href="../bidang" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php } ?>

                <?php if (session()->get('role') == 'user') {?>
                <div class="col-lg-4 col-6">

                    <div class="small-box bg-success">
                        <div class="inner mb-3">
                            <h4>Histori Absensi</h4>
                            <h6>Peserta</h6>
                        </div>
                        <div class="icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <a href="../presensi" class="small-box-footer">Cek disini <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php } ?>


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


<!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ini Home Page</h1>
          </div>
    </div> -->
<!-- </div> -->