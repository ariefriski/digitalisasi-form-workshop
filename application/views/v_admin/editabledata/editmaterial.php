<div class="content">
                    <!-- Default Table Style -->
        <h2 class="content-heading">Dashboard data admin</h2>

        <!-- Table -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Database Material</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <button type="button" class="btn btn-primary min-width-125" data-toggle="modal" data-target="#modal-normal">
                        <i class="fa fa-plus"></i>&nbsp; Tambah Material
                    </button>
                </div>
            </div>
            </div>
                        <!-- START MODAL -->
<div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?= base_url() . 'admin/edit/insertMaterial'?>" method="POST" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add New Material</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group" >
                        <label for="title">Nama Material</label>
                        <input type="text" class="form-control" id="nama_material" name="nama_material" placeholder="Masukan Nama Material.." required>
                        <label for="title">Price Raw/kg</label>
                        <input type="number" class="form-control" id="price_kg" name="price_kg" placeholder="Masukan Harga Raw/Kg" required>
                        <label for="title">Type</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Masukan Type" required>
                        <label for="title">Massa Jenis[g/cm^3]</label>
                        <input type="number" step="0.1" class="form-control" id="massa_jenis" name="massa_jenis" placeholder="Masukan Masa Jenis" required>
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
                        <label for="title">Nama Material</label>
                        <input name="id_material_edit" id="id_material_edit" class="form-control" type="hidden" placeholder="ID Karyawan" style="width:335px;" readonly>
                        <input type="text" class="form-control" id="nama_material_edit" name="nama_material_edit" placeholder="Masukan Nama Material">
                        <label for="title">Price Raw/kg</label>
                        <input type="number" class="form-control" id="price_kg_edit" name="price_kg_edit" placeholder="Masukan Harga Raw/Kg" >
                        <label for="title">Type</label>
                        <input type="text" class="form-control" id="type_edit" name="type_edit" placeholder="Masukan Type" >
                        <label for="title">Massa Jenis[g/cm^3]</label>
                        <input type="number" step="0.1" class="form-control" id="massa_jenis_edit" name="massa_jenis_edit" placeholder="Masukan Masa Jenis" >
                        
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

                    <input type="hidden" name="id_material" id="textid" value="">
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
        <table id="table-edit-material" class="table table-vcenter">
            <thead>
                <tr>
                    <th class="text-center"style="width: 50px;">#</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Produk</th>
                    <th>Price Raw Material/KG</th>
                    <th>TYPE</th>
                    <th>Massa Jenis[g/cm^3]</th>
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
    $('#show_data').on('click', '.item_edit', function() {
				var id_material = $(this).attr('data');
				$.ajax({
					type: "GET",
					url: "<?php echo base_url('admin/edit/showModalByIdMaterial') ?>",
					dataType: "JSON",
					data: {
						id_material: id_material,
                        
					},
					success: function(data) {
						$.each(data, function(id_material, nama_material) {
							$('#modal-edit').modal('show');
							$('[name="id_material_edit"]').val(data.id_material);
                            $('[name="nama_material_edit"]').val(data.nama_material);
                            $('[name="price_kg_edit"]').val(data.price_kg);
                            $('[name="type_edit"]').val(data.type);
                            $('[name="massa_jenis_edit"]').val(data.massa_jenis);
                        });  
                        
					}
				});
				return false;
                
			});

            $('#btn_update').on('click', function() {
				var id_material = $('#id_material_edit').val();
				var nama_material = $('#nama_material_edit').val();
				var price_kg = $('#price_kg_edit').val();
                var type = $('#type_edit').val();
				var massa_jenis = $('#massa_jenis_edit').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('admin/edit/updateMaterial') ?>",
					dataType: "JSON",
					data: {
                        id_material:id_material,
						nama_material :nama_material,
                        price_kg :price_kg,
                        type :type,
                        massa_jenis :massa_jenis
					},
					success: function(data) {
						$('[name="id_material_edit"]').val("");
                            $('[name="nama_material_edit"]').val("");
                            $('[name="price_kg_edit"]').val("");
                            $('[name="type_edit"]').val("");
                            $('[name="massa_jenis_edit"]').val("");
                       
						pagereload();
					}
				});
				return false;
			});

            $('#btn_hapus').on('click', function() {
				var id_material = $('#textid').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('admin/edit/deleteMaterial') ?>",
					dataType: "JSON",
					data: {
						id_material: id_material
					},
					success: function(data) {
						$('#modal-hapus').modal('hide');
						pagereload();
					}
				});
				return false;
			});

            $('#show_data').on('click', '.item_delete', function() {
				var id_material = $(this).attr('data');
				$('#modal-hapus').modal('show');
				$('[name="id_material"]').val(id_material);
			});

function pagereload(){
    location.reload();
}
</script>
            