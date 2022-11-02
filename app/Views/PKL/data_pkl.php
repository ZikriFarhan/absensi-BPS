<div class="container-fluid">
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="m-0">Data peserta PKL</h1>
                <!-- tombol search -->
                    <div class="input-group input-group-sm col-sm-2">
                          
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn-sm btn-success" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                         
                            </div>
                         
                        </div>
                <div class="ml-auto">
                    <!-- tombol tambah data -->
                    <a class="btn-sm btn-primary float-right" id="btnTambah" href="<?php echo base_url("pesertamagang/new") ?>"role="button">
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
                            <table id="tabel-penarikan" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIM</th>
                                        <th>Nama Peserta PKL</th>
                                        <th>Universitas Asal</th>
                                        <th>Bidang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $no=1;
                                        foreach($peserta as $p) : ?>

                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?= $p['nim'] ?></td>
                                            <td><?= $p['nama'] ?></td>
                                            <td><?= $p['nama_universitas'] ?></td>
                                            <td><?= $p['nama_bidang'] ?></td>
                                            <td>
                                            <a class="btn btn-primary btn-sm" id="btnShow" href="<?php echo base_url("pesertamagang/show/$p[id]") ?>"role="button">
                                                <i class="fas fa-info-circle"></i></a>
                                            <a class="btn btn-success btn-sm" id="btnEdit" href="<?php echo base_url("pesertamagang/edit/$p[id]") ?>"role="button">
                                                <i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" id="btnDelete" href="<?php echo base_url("pesertamagang/delete/$p[id]") ?>"role="button">
                                                <i class="fas fa-trash-alt"></i></a>

            
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
    

<!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ini Home Page</h1>
          </div>
    </div> -->
<!-- </div> -->
