$(document).ready(function(e) {
//modal konfirmasi hapus
	$('.hapus').click(function(){
			var url = $('input',this).val();
				tipe = $(this).attr('title');
			$('.modal-body').html('');
			$("#hapus").show();
			
			if(tipe == 'logout'){
				$('.modal-body').html('Apakah anda yakin ingin <b>Logout</b> ?');
			}
			else if(tipe == 'hapus'){
				$('.modal-body').html('Apakah anda yakin ingin menghapus ini ?');
			}
			else if(tipe == 'Kosongkan Pesan'){
				$('.modal-body').html('Apakah anda yakin ingin menghapus semua pesan ?');
			}
            else if(tipe == 'Tidak bisa hapus'){
                $('.modal-body').html('Data tidak bisa dihapus, data sudah digunakan pada menu sebelumnya.');
                $("#hapus").hide();
            }
			$("#hapus").attr('href', url);
			
			$('.konfirmasi-modal').modal('toggle');
			return false;
	});
});
