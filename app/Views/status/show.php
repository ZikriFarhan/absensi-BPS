<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class="box box-success">
                <div class='box-header with-border'>
                    <h3 class='box-title'>Status Detail</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>ID Status</td>
                            <td><?= $data['id']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?= $data['nama_status']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;"><a href="/status" class="btn-xs btn btn-primary">Kembali</a></td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</section><!-- /.content -->