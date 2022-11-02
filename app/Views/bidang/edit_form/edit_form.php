<div class="content-wrapper">
    <section class="content">
        <?php foreach($nama_bidang as $b) {?>

        <form action="<?php echo base_url().'bidang/update'; ?>"
        method="post">

        <div class="form-group">
            <label>Nama Bidang</label>
            <input type="hidden" name="id" class="form-control" 
            value="<?php echo $b->id ?>">
            <input type="text" name="nama" class="form-control" 
            value="<?php echo $b->nama_bidang ?>">
        </div>



        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        
        </form>

        <?php } ?>
    </section>
</div>