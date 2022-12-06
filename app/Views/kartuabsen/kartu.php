<style>
    @media print {
        @page {
            margin-top: 30px;
        }

        .btn,
        .last,
        footer,
        #cetak,
        i,
        a,
        button,
        a#debug-icon-link {
            display: none;
        }
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        border-radius: 5px;
        width:88mm;
        height:125mm ;
        border-color: black;
        border: solid;
        border-width: thin;
        /* 5px rounded corners */
    }

    /* Add rounded corners to the top left and the top right corner of the image */
    img {
        border-radius: 5px 5px 0 0;
    }

    .atas {
        padding: 1px 16px;
        text-align: center;
        margin-bottom: 0px;
    }

    .bawah {
        padding: 2px 16px;
        text-align: center;
    }

    .data {
        padding: 0px 16px;
        text-align: left;
        line-height: 1mm;
    }

    .table {
        line-height: 5.5mm;
        border: none;
        margin-bottom: 0;
    }

    .logo-bps {
        width: 50px;
        height: 50px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
        margin-bottom: 10px;
        display: block;
    }

    .QR {
        width: 150px;
        height: 150px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
        display: block;
    }
</style>
<div>
    <div class="card">
        <img src="<?= base_url() ?>/template/adminlte/img/BPSicon2.png" alt="AdminLTE Logo" class="logo-bps">
        <div class="atas">
            <h5><b>Kartu Presensi</b></h5>
            <h4><b>BPS Jawa Tengah</b></h4>
        </div>
        <div class="data">
            <table class="table">
                <tr style="word-wrap:break-word; word-break:break-word;">
                    <td>Nama</td>
                    <td>: <?= $data['nama']; ?></td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>: <?= $data['nim']; ?></td>
                </tr>
                <tr>
                    <td>Bidang</td>
                    <td>: IPDS</td>
                </tr>
            </table>
        </div>
        <div class="QR">
            <img src="<?= $uri ?>" alt="Avatar" style="width:100%">
        </div>
    </div>
    <td colspan="2" style="text-align:center;">
        <button onclick="window.print()" class="btn-sm btn-outline-secondary" style="height:38px;">Cetak <i class="fa fa-print"></i></button>
    </td>
</div>


<div class="container-fluid">
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <a href="<?= previous_url() ?>" class="btn btn btn-primary ml-auto mr-1" style="height:38px;">Kembali</a>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
</div>
<!-- /.content -->