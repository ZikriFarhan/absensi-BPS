<!-- Main content -->
<section class='content'>
    <div class="container-fluid">
        <div class='row ml-sm-2 mt-3'>
            <div class='col-xs-12'>
                <div class="box box-success">
                    <div class='box-header with-border'>
                        <h3 class='box-title'>Peserta Detail</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered ">
                            <tr>
                                <td>ID Peserta Magang</td>
                                <td><?= $data['id']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td><?= $data['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td><?= $data['nim']; ?></td>
                            </tr>
                            <tr>
                                <td>Asal Universitas</td>
                                <td><?= $data['nama_universitas']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Bidang</td>
                                <td><?= $data['nama_bidang']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;"><a href="/pesertamagang" class="btn-xs btn btn-primary">Kembali</a></td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
</section><!-- /.content -->