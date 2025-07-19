<?php
    $nilai = array(5 => "Sangat Baik", 4 => "Baik", 3 => "Cukup", 2 => "Kurang", 1 => "Sangat Kurang");
?>

<p><strong>Kode Praktikum = <?=$kd_praktikum?></strong></p>

<?php if (count($status) == 1){ ?>
    <div class="alert alert-danger">
        <p>Terima kasih telah mengisi kuisioner</p>
    </div>

<?php } else { ?>
<form method="post" action="<?=base_url()?>index.php/kuisioner/store">
<div class="table-responsive">
<table class="table table-border table-striped">
<thead>
    <tr>
        <th>#</th>
        <th>Uraian Kinerja Dosen</th>
        <th width="550">Penilaian</th>
    </tr>
</thead>
<tbody>

<?php
$no = 1;

for ($i = 0; $i < count($kategori); $i++) {
?>
    <tr class="table-success">
        <th colspan="3"><?=$kategori[$i]['kategori']?></th>
    </tr>

<?php
    for ($j = 0; $j < count($uraian); $j++) {
        if ($uraian[$j]['id_kategori'] == $kategori[$i]['id']) {
?>
            <tr>
            <td><?=$no++?></td>
            <td><?=$uraian[$j]['uraian']?>
            <input type="hidden" name="id_uraian[<?=$j?>]" value="<?=$uraian[$j]['id']?>"/></td>
            <td>
<?php  
            foreach ($nilai as $key => $value){
?>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="nilai[<?=$j?>]" class="custom-control-input" value="<?=$key?>" required style="font-size:10px;"><span class="custom-control-label"><?=$value?></span>
                </label>

            <?php } ?>

            </td>
            </tr>
<?php 
        } 
    }
}
?>
<tr class="info">
    <th colspan="3">Tuliskan saran anda untuk laboratorium teknik informatika:</th>
</tr>
<tr>
    <td colspan="3">
        <textarea name="komentar" rows="5" class="form-control" required></textarea>
    </td>
</tr>

<tr>   
    <td colspan="3"><div class="text-center"><button class="btn btn-primary btn-lg" name="sbmtPenilaian"><strong>SUBMIT</strong></button></div></td>
</tr>
</tbody>
</table>
</div>
</form>
<?php } ?>