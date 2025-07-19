<div class="col-lg-12">
	<h1 class="page-header">Penilaian Diri</h1>
</div>
<div class="col-lg-12">

<?php
    if (count($status) == 1) {
        echo "<div class='alert alert-danger'><p>Terima kasih. Anda telah mengisi penilaian diri.</p></div>";
    } else {
?>
<p>
    Selamat datang <strong><?=$_SESSION['nama']?></strong>, anda akan melakukan penilaian kinerja terhadap diri anda sendiri.
</p>
<hr/>
<form method="post" action="<?=base_url()?>index.php/asistenkuisioner/storePenilaianDiri">
    <div class="form-group">
        <label>Deskripsikan kelebihan dan kekurangan diri anda:</label>
        <textarea class="form-control" name="deskripsi1" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label>Bagaimana solusi anda mengatasi kekurangan pada diri anda:</label>
        <textarea class="form-control" name="deskripsi2" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label>Bagaimana anda memanfaatkan potensi kelebihan anda secara maksimal:</label>
        <textarea class="form-control" name="deskripsi3" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <?php } ?>
</div>