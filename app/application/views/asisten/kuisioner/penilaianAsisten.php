<div class="col-lg-12">
	<h1 class="page-header">Penilaian Asisten</h1>
</div>
<div class="col-lg-12">
    <p>
    Selamat datang <strong><?=$_SESSION['nama']?></strong>, anda akan melakukan penilaian kinerja terhadap asisten lainnya
</p>
<hr/>
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
                if ($value['username'] !== $_SESSION['username']) {
        ?>
        <tr>
            	<td><?=$i++?></td>
            	<td><?=$value['username']?></td>
                <td><?=$value['nama']?></td>
                <td>
                    <?php
                        if ($value['status'] !== '1') {
                            echo '<a href="'.base_url().'index.php/asisten/penilaian_asisten/'.$value['username'].'" class="btn btn-danger btn-xs"> Belum Mengisi</a>';
                        } else {
                            echo "<div class='label label-success'>Sudah mengisi</div>";
                        }
                    ?>
                </td>
            </tr>
        <?php } }?>
        </tbody>
    </table>
</div>