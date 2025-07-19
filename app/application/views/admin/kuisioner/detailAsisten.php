<div class="col-lg-12">
	<h1 class="page-header">Detail Penilaian Asisten</h1>
</div>
<div class="col-lg-12">
    <strong>Kode Asisten</strong>
    <p><?=$asisten[0]['username']?></p>
    <strong>Nama Asisten</strong>
    <p><?=$asisten[0]['nama']?></p>
    <strong>Jabatan</strong>
    <p><?=$asisten[0]['id_jabatan']?></p>

    <hr/>

    <a href="<?=base_url()?>index.php/admin/kuisioner_asisten"> <i class="glyphicon glyphicon-arrow-left"></i> kembali</a>

    <hr/>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#penilaian" aria-controls="home" role="tab" data-toggle="tab">Penilaian Asisten Lainnya</a></li>
    <li role="presentation"><a href="#hasil" aria-controls="profile" role="tab" data-toggle="tab">Hasil Penilaian Asisten Lainnya</a></li>
    <li role="presentation"><a href="#komentar" aria-controls="messages" role="tab" data-toggle="tab">Komentar dari Asisten Lainnya</a></li>
    <li role="presentation"><a href="#diri" aria-controls="messages" role="tab" data-toggle="tab">Hasil Penilaian Diri</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="penilaian">
	<table class="table table-bordered table-hover">
    	<thead>
        	<tr>
            	<th>No</th>
                <th>Kode Asisten</th>
                <th>Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
            foreach ($menilai as $key => $value) {
                if ($value['username'] !== $asisten[0]['username']) {
        ?>
        <tr>
            	<td><?=$i++?></td>
            	<td><?=$value['username']?></td>
                <td><?=$value['nama']?></td>
                <td>
                    <?php
                        if ($value['status'] == '1') {
                            echo "<div class='label label-success'>Sudah</div>";
                        } else {
                            echo "<div class='label label-danger'>Belum</div>";
                        }
                    ?>
                </td>
            </tr>
        <?php } }?>
        </tbody>
    </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="hasil">
    <br/>
    <strong>Rerata Nilai: <?=@$nilai[0]['nilai']?></strong>
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

    <div role="tabpanel" class="tab-pane" id="diri">
        <br/>
        <div class="alert alert-info">
            <strong>Deskripsi kelebihan dan kekurangan diri:</strong>
            <p><?=@$diri[0]['deskripsi1']?></p>
        </div>
        <div class="alert alert-info">
            <strong>Solusi mengatasi kekurangan diri:</strong>
            <p><?=@$diri[0]['deskripsi2']?></p>
        </div>
        <div class="alert alert-info">
            <strong>Memanfaatkan potensi kelebihan diri:</strong>
            <p><?=@$diri[0]['deskripsi3']?></p>
        </div>
    </div>
</div>

    

    

</div>