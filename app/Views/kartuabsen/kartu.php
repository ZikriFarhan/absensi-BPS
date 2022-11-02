<style>
    @media print{
      @page {
        margin-top:30px;
      }
      .btn,
      .last,
      footer,
      #cetak,
      i,
      a#debug-icon-link{
      display: none;
      }
    }
</style>

<div class="container-fluid">
    <div class="content">
            <div class="container-fluid">
                <div class="row mb-2 mt-2">
                    <h2 class="ml-2">Kartu Absen</h2>
                    
                    <a href="<?= previous_url() ?>" class="btn btn btn-primary ml-auto mr-1" style="height:38px;">Kembali</a>
                </div><!-- /.col -->
            </div><!-- /.container-fluid -->
    </div>
        <!-- /.content -->

<div class='content'>
    <div class='row'>
        <div class='col-xs-12 ml-3 mt-1'>
            <div class="box box-success">
                <div class='box-header with-border'>
                </div>
                <div class="box-body mt-3">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama</td>
                            <td><?= $data['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $data['nim']; ?></td>
                        </tr>
                        <tr>
                            <img src="<?= $uri ?>" alt="NIM">
                        </tr>
                        <tr id="cetak">
                            <td colspan="2" style="text-align:center;">
                            <button onclick="window.print()" class="btn-sm btn-outline-secondary" style="height:38px;">Cetak <i class="fa fa-print"></i></button>
                        </td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.content -->

</div>