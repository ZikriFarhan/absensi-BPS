<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
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
<?php if (session()->getFlashData('success')) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?= session()->getFlashData('success') ?>',
            showConfirmButton: true,
        })
    </script>
<?php }  ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card card-primary card-outline mt-3">
                    <?php
                    $attributes = array('id' => 'button');
                    echo form_open('scan/absen', $attributes)
                    ?>
                    <textarea hidden="" name="qrcode" id="qrcode" readonly></textarea>
                    <span hidden> <input type="submit" id="button" value="Submit"> </span>
                    <div class="card-body table-responsive">
                        <h3>Scan QR</h3>
                        <select class="custom-select form-control-border" name="select_camera" id="select_camera"></select><br>
                        <video id="preview" style="height: 300px; width: 400px;"></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>


<script type="text/javascript">
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false
    });
    scanner.addListener('scan', function(content) {
        // menampilkan hasil dari scan qr code
        console.log(content);
        if (content) {
            // alert('QR Code Scanned');
            $('#qrcode').val(content);
        }
        $('#button').submit();
    });

    select_camera = document.getElementById('select_camera');
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            cameras.forEach(function(camera) {
                var option = document.createElement('option');
                option.value = camera.id;
                option.text = camera.name;
                select_camera.appendChild(option);
            });
            scanner.start(cameras[0]);
            select_camera.onchange = function() {
                scanner.start(cameras[select_camera.selectedIndex]);
            };
        } else {
            console.error('camera tidak di temukan');
        }
    }).catch(function(e) {
        console.error(e);
    });
</script>