<!-- Main content -->
<section class='content'>
    <div class='row ml-3 mt-3'>
        <div class='col-xs-12'>
            <div class="box box-success">
                <div class='box-header with-border'>
                    <h3 class='box-title'>Presensi Detail</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>ID Presensi</td>
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
                            <td>Tanggal</td>
                            <td><?= $data['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <td>Jam Masuk</td>
                            <td><?= $data['jam_masuk']; ?></td>
                        </tr>
                        <tr>
                            <td>Jam Keluar</td>
                            <td><?= $data['jam_keluar']; ?></td>
                        </tr>
                        <tr>
                            <td>Kehadiran</td>
                            <td><?= $data['nama_kehadiran']; ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><?= $data['keterangan']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?= $data['nama_status']; ?></td>
                        </tr>
                        <td colspan="2" style="text-align:center;"><a href="/presensi" class="btn-xs btn btn-primary">Kembali</a></td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</section><!-- /.content -->