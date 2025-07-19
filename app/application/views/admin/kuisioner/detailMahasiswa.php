<div class="col-lg-12">
	<h1 class="page-header">Detail Penilaian Praktikum <?=$kd_praktikum?></h1>
</div>
<div class="col-lg-12">
<a href="<?=base_url()?>index.php/admin/kuisioner_mahasiswa"> <i class="glyphicon glyphicon-arrow-left"></i> kembali</a>
<hr/>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#uraian" aria-controls="home" role="tab" data-toggle="tab">Uraian Penilaian</a></li>
    <li role="presentation"><a href="#komentar" aria-controls="profile" role="tab" data-toggle="tab">Komentar</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="uraian">
    
	<table class="table table-bordered table-hover">
    	<thead>
        	<tr>
            	<th>No</th>
                <th>Uraian</th>
                <th>Nilai Rata-Rata</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        for ($i=0; $i < count($kategori); $i++) { 
        ?>
            <tr>
            	<td colspan="3"><strong><?=$kategori[$i]['kategori']?></strong></td>
            </tr>
        <?php
            for ($j=0; $j < count($uraian); $j++) { 
                if ($uraian[$j]['kategori'] == $kategori[$i]['kategori']) {
        ?>
            <tr>
            	<td><?=$no++?></td>
            	<td><?=$uraian[$j]['uraian']?></td>
                <td><?=$uraian[$j]['nilai']?></td>
            </tr>
        <?php
                }
            }
        }
		?>
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="komentar">
        <br/>
        <?php
            foreach ($komentar as $key => $value) {
        ?>
        <div class="alert alert-info">
            <p><?=$value['komentar']?></p>
        </div>
        <?php } ?>
    </div>
</div>
</div>