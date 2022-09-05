<div class="content">
                    <!-- Default Table Style -->
<h2 class="content-heading">Dashboard data admin</h2>

<!-- Table -->
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Database Proses</h3>
    <div class="block-options">
        <div class="block-options-item">
            <button type="button" class="btn btn-primary min-width-125" data-toggle="modal" data-target="#modal-normal">
                <i class="fa fa-plus"></i>&nbsp; Tambah Proses
            </button>
        </div>
    </div>
    </div>
                        <!-- START MODAL -->
<div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?= base_url() . 'admin/edit/insertProses'?>" method="POST" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add New Proses</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group" >
                        <label for="title">Nama Proses</label>
                        <input type="text" class="form-control" id="nama_proses" name="nama_proses" placeholder="Masukan Nama Proses..">
                        <label for="title">Harga Mesin</label>
                        <input type="number" class="form-control" id="harga_mesin" name="harga_mesin" placeholder="Masukan Harga Mesin..">
                        <label for="title">MC/JAM</label>
                        <input type="number" class="form-control" id="harga_perjam" name="harga_perjam" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">MP/JAM</label>
                        <input type="number" class="form-control" id="harga_perjam_manusia" name="harga_perjam_manusia" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">Consumable</label>
                        <input type="number" class="form-control" id="consumable" name="consumable" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">Listrik</label>
                        <input type="number" class="form-control" id="listrik" name="listrik" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">Total Cost</label>
                        <input type="number" class="form-control" name="total_cost" id="total_cost" placeholder=""> 
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-alt-success">Add</button>
            </div>
        </form>
    </div>
</div>
    </div>
             <!-- END MODAL -->
             <!-- edit MODAAL -->
<div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="#" method="POST" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit Proses</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group" >
                        <label for="title">Nama Proses</label>
                        <input name="id_proses_edit" id="id_proses_edit" class="form-control" type="hidden" placeholder="ID Karyawan" style="width:335px;" readonly>
                        <input type="text" class="form-control" id="nama_proses_edit" name="nama_proses_edit" placeholder="Masukan Nama Proses..">
                        <label for="title">Harga Mesin</label>
                        <input type="number" class="form-control" id="harga_mesin_edit" name="harga_mesin_edit" placeholder="Masukan Harga Mesin..">
                        <label for="title">MC/JAM</label>
                        <input type="number" class="form-control" id="harga_perjam_edit" name="harga_perjam_edit" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">MP/JAM</label>
                        <input type="number" class="form-control" id="harga_perjam_manusia_edit" name="harga_perjam_manusia_edit" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">Consumable</label>
                        <input type="number" class="form-control" id="consumable_edit" name="consumable_edit" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">Listrik</label>
                        <input type="number" class="form-control" id="listrik_edit" name="listrik_edit" placeholder="Isi 0 jika dikosongkan">
                        <label for="title">Total Cost</label>
                        <input type="number" class="form-control" name="total_cost_edit" id="total_cost_edit" placeholder=""> 
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-alt-success" id="btn_update">Update</button>
            </div>
        </form>
    </div>
</div>
    </div>
             <!-- END MODAL -->
             <!--MODAL HAPUS-->
<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <input type="   " name="id_proses" id="textid" value="">
                    <div class="alert alert-warning">
                        <p>Apakah Anda yakin mau menghapus?</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
		<!--END MODAL HAPUS-->
    <div class="block-content">
        <table id="table-edit-proses" class="table table-vcenter">
            <thead>
                <tr>
                    <th class="text-center"style="width: 50px;">#</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Proses</th>
                    <th>Harga Mesin</th>
                    <th>MC/JAM</th>
                    <th>MP/JAM</th>
                    <th class="d-none d-sm-table-cell" style="width: 10%;">Consumable</th>
                    <th >Listrik</th>
                    <th >Total Cost</th>
                    <th class="text-center" >Actions</th>
                </tr>
            </thead>
            <tbody id="show_data">

            </tbody>
        </table>
    </div>
</div>
                  
</div>
             

<script>
 
    $(document).ready(function(){
    var harga_perjam=$("#harga_perjam");
    var listrik = $("#listrik");
    var consumable =$('#consumable');
    var harga_perjam_manusia = $('#harga_perjam_manusia');
    harga_perjam.keyup(function(){
        var total=parseInt(harga_perjam.val())+ parseInt(listrik.val()) + parseInt(harga_perjam_manusia.val()) + parseInt(consumable.val());
        $("#total_cost").val(total);
    });
    listrik.keyup(function(){
        var total=parseInt(harga_perjam.val())+ parseInt(listrik.val()) + parseInt(harga_perjam_manusia.val()) + parseInt(consumable.val());
        $("#total_cost").val(total);
    });
    consumable.keyup(function(){
        var total=parseInt(harga_perjam.val())+ parseInt(listrik.val()) + parseInt(harga_perjam_manusia.val()) + parseInt(consumable.val());
        $("#total_cost").val(total);
    });
    harga_perjam_manusia.keyup(function(){
        var total=parseInt(harga_perjam.val())+ parseInt(listrik.val()) + parseInt(harga_perjam_manusia.val()) + parseInt(consumable.val());
        $("#total_cost").val(total);
    });

    var harga_perjam_edit=$("#harga_perjam_edit");
    var listrik_edit = $("#listrik_edit");
    var consumable_edit =$('#consumable_edit');
    var harga_perjam_manusia_edit = $('#harga_perjam_manusia_edit');
    harga_perjam_edit.keyup(function(){
        var total=parseInt(harga_perjam_edit.val())+ parseInt(listrik_edit.val()) + parseInt(harga_perjam_manusia_edit.val()) + parseInt(consumable_edit.val());
        $("#total_cost_edit").val(total);
    });
    listrik_edit.keyup(function(){
        var total=parseInt(harga_perjam_edit.val())+ parseInt(listrik_edit.val()) + parseInt(harga_perjam_manusia_edit.val()) + parseInt(consumable_edit.val());
        $("#total_cost_edit").val(total);
    });
    consumable_edit.keyup(function(){
        var total=parseInt(harga_perjam_edit.val())+ parseInt(listrik_edit.val()) + parseInt(harga_perjam_manusia_edit.val()) + parseInt(consumable_edit.val());
        $("#total_cost_edit").val(total);
    });
    harga_perjam_manusia_edit.keyup(function(){
        var total=parseInt(harga_perjam_edit.val())+ parseInt(listrik_edit.val()) + parseInt(harga_perjam_manusia_edit.val()) + parseInt(consumable_edit.val());
        $("#total_cost_edit").val(total);
    });


$('#show_data').on('click', '.item_edit', function() {
    var id_proses = $(this).attr('data');
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/edit/showModalById') ?>",
        dataType: "JSON",
        data: {
            id_proses: id_proses,
            
        },
        success: function(data) {
            $.each(data, function(id_proses, nama_proses) {
                $('#modal-edit').modal('show');
                $('[name="id_proses_edit"]').val(data.id_proses);
                $('[name="nama_proses_edit"]').val(data.nama_proses);
                $('[name="harga_perjam_edit"]').val(data.harga_perjam);
                $('[name="harga_perjam_manusia_edit"]').val(data.harga_perjam_manusia);
                $('[name="consumable_edit"]').val(data.consumable);
                $('[name="listrik_edit"]').val(data.listrik);
                $('[name="harga_mesin_edit"]').val(data.harga_mesin);
                $('[name="total_cost_edit"]').val(data.total_cost);
            });  
            
        }
    });
    return false;
    
});

            $('#show_data').on('click', '.item_delete', function() {
				var id_proses = $(this).attr('data');
				$('#modal-hapus').modal('show');
				$('[name="id_proses"]').val(id_proses);
			});

            $('#btn_hapus').on('click', function() {
				var id_proses = $('#textid').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('admin/edit/deleteProses') ?>",
					dataType: "JSON",
					data: {
						id_proses: id_proses
					},
					success: function(data) {
						$('#modal-hapus').modal('hide');
						pagereload();
					}
				});
				return false;
			});



            $('#btn_update').on('click', function() {
				var id_proses = $('#id_proses_edit').val();
				var nama_proses = $('#nama_proses_edit').val();
				var harga_perjam = $('#harga_perjam_edit').val();
                var harga_perjam_manusia = $('#harga_perjam_manusia_edit').val();
				var consumable = $('#consumable_edit').val();
				var listrik = $('#listrik_edit').val();
				var harga_mesin = $('#harga_mesin_edit').val();
				var total_cost = $('#total_cost_edit').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('admin/edit/updateProses') ?>",
					dataType: "JSON",
					data: {
                        id_proses:id_proses,
						nama_proses :nama_proses,
                        harga_perjam :harga_perjam,
                        harga_perjam_manusia :harga_perjam_manusia,
                        consumable :consumable, 
                        listrik :listrik, 
                        harga_mesin :harga_mesin, 
                        total_cost :total_cost 
					},
					success: function(data) {
						$('[name="id_proses_edit"]').val("");
                        $('[name="nama_proses_edit"]').val("");
                        $('[name="harga_perjam_edit"]').val("");
                        $('[name="harga_perjam_manusia_edit"]').val("");
                        $('[name="consumable_edit"]').val("");
                        $('[name="listrik_edit"]').val("");
                        $('[name="harga_mesin_edit"]').val("");
                        $('[name="total_cost_edit"]').val("");
						$('#modal-edit').modal('hide');
						pagereload();
					}
				});
				return false;
			});
});

function pagereload(){
    location.reload();
}
</script>