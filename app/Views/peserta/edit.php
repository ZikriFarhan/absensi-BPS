<style>

    .bootstrap-select>.dropdown-toggle{
        background-color:white;
        border-color:#ced4da;
    }
</style>

<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <h3>Edit Peserta</h3>
                <?php if (session()->getFlashdata('error')) {
                ?>
                    <div class="alert alert-danger ml-auto">
                        <ul>
                            <?php foreach (session()->getFlashdata('error') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <form action="/pesertamagang/update/<?= $peserta['id']; ?>" method="post">

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $peserta['nama']; ?>">
                </div>

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $peserta['nim']; ?>">
                </div>

                <div class="form-group">
                    <label for="id_universitas">Universitas</label>
                    <select class="form-control selectpicker" id="id_universitas" name="id_universitas">
                        <option placeholder="" value="<?= $peserta['id_universitas'] ?>">Pilih Universitas</option>
                        <?php foreach ($univ as $row) : ?>
                            <option value="<?= $row['id']; ?>"><?= $row['nama_universitas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_bidang">Bidang</label>
                    <select class="form-control selectpicker" id="id_bidang" name="id_bidang">
                        <option placeholder="" value="<?= $peserta['id_bidang'] ?>">Pilih Bidang</option>
                        <?php foreach ($bidang as $row) : ?>
                            <option value="<?= $row['id']; ?>"><?= $row['nama_bidang']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>


<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('select').selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: 'Search',
            size: 5,
            style: 'border'
        });
    });
</script>