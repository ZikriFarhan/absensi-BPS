<title>Kartu Absen</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (session()->getFlashData('error')) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '<?= session()->getFlashData('error') ?>',
            showConfirmButton: true,
        })
    </script>
<?php } ?>

<div class="container-fluid">
    <div class="content">
        <div class="container-fluid mt-3">
            <form action="/kartuabsen/genkartu" method="post">
                <div class="form-group">
                    <h2>Ambil QR</h2>
                    <p>Masukkan Nama</p>
                    <div class="form-group">
                        <select name="id_peserta" id="peserta" class="form-control selectpicker" data-live-search="true" title="Cari Nama Mahasiswa">
                            <?php foreach ($data as $row) : ?>
                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('selectpicker').selectpicker({
            liveSearch: true,
            liveSearchPlaceholder: 'Search',
            size: 5,
            style: 'border'
        });
    });
</script>

<!--  -->