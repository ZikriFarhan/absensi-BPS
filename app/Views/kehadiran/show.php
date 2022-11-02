<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class="box box-success">
                <div class='box-header with-border'>
                    <h3 class='box-title'>Peserta Detail</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>ID Kehadiran</td>
                            <td><?= $data['id']; ?></td>
                        </tr>
                        <tr>
                            <td>Kehadiran</td>
                            <td><?= $data['nama_kehadiran']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;"><a href="/kehadiran" class="btn-xs btn btn-primary">Kembali</a></td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</section><!-- /.content -->