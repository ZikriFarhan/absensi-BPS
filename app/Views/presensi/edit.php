<style>
    .form-group {}
    .bootstrap-select>.dropdown-toggle {
        background-color: white;
        border-color: #ced4da;
    }
</style>


<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <h3>Edit presensi</h3>
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
            <form action="/presensi/update/<?= $data['id']; ?>" method="post">

                <div class="form-group">
                    <label for="nim">Nama</label>
                    <select class="form-control selectpicker" data-live-search="true" id="nim" name="nim" disabled>
                        <option value="<?= $data['nim'] ?>"><?= $data['nama'] ?></option>
                        <input type="hidden" name="nim" value="<?= $data['nim'] ?>">
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data['tanggal'] ?>">
                </div>

                <div class="form-group">
                    <label for="id_kehadiran">Kehadiran</label>
                    <select class="form-control" id="id_kehadiran" name="id_kehadiran">
                        <?php foreach ($kehadiran as $row) : ?>
                            <option value="<?= $row['id']; ?>" <?= $data['id_kehadiran'] == $row['id'] ? "selected" : ""; ?>><?= $row['nama_kehadiran']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jam_masuk">Jam Masuk</label>
                    <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="<?= $data['jam_masuk'] ?>">
                </div>

                <div class="form-group">
                    <label for="jam_keluar">Jam Keluar</label>
                    <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="<?= $data['jam_keluar'] ?>">
                </div>

                <div class="form-group">
                    <label for="id_status">Status</label>
                    <select class="form-control" id="id_status" name="id_status">
                        <?php foreach ($status as $row) : ?>
                            <option value="<?= $row['id']; ?>" <?= $data['id_status'] == $row['id'] ? "selected" : ""; ?>><?= $row['nama_status']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $data['keterangan'] ?>">
                </div>

                <button type="submit" class="btn btn-primary mb-4">Edit</button>
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