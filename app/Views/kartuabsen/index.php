<title>Kartu Absen</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

<style>
    .select2 {
        width: 500px;
        line-height: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 20px;
        margin-left: -15px;
    }
</style>

<div class="container-fluid">
    <div class="content">
        <div class="container-fluid mt-3">
            <form action="/kartuabsen/genkartu" method="post">
                <div class="form-group">
                    <h2>Ambil QR</h2>
                    <p>Masukkan Nama</p>
                    <div class="form-group">
                        <select class="form-control" style="" name="id_peserta" id="peserta"></select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#peserta').select2({
        placeholder: 'Pilih Nama',
        ajax: {
            url: '<?= base_url('kartuabsen/getPeserta') ?>',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                var query = {
                    keyword: params.term
                }
                return query;
            },

            processResults: function(data) {
                var results = [];
                $.each(data, function(index, item) {
                    results.push({
                        id: item.id,
                        text: item.nama
                    });
                });
                return {
                    results: results
                };
            },
        }
    });
</script>

<!--  -->