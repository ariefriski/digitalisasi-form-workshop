<div class="row">
<div class="col-md-2">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url().'assets/media/photos/cbi-logo.png';?>" alt="logo-cbi" width="120" height="120"><br>
<p style="text-align: center;">PT. Century Batteries Indonesia</p>
</div>
<div class="col-md-8">
<h2 class="content-heading" style="text-align: center;">ORDER PEMBUATAN REPAIR MODIFIKASI <br> KOMPONEN MESIN PERALATAN <br> <p style="font-size:small;">SEKSI WORKSHOP</p></h2>
</div>
</div>
<div class="col-md-6">
    <div class="form-group row">
        <label class="col-8" for="example-text-input">Nomor Order</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="Nomor Order" disabled>
        <div class="form-text text-muted">di isi oleh admin PE</div>                      
    </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
    <div class="block-header block-header-default">
            <h3 class="block-title" style="text-align: center;">1. FORM PERMINTAAN (di isi oleh user)</h3> 
        
            <?php foreach($response as $r) { ?>
                <?php if($r['status_approval'] == 'Disetujui') { ?>
                    <?php echo '<button class="btn btn-info" id="edit-button" disabled >
                    <i class="si si-pencil"></i>&nbsp;Edit
                </button>' ?>
                <?php } else if ($r['status_approval'] == 'Ditolak') {?>
                    <?php echo '<button class="btn btn-info" id="edit-button" disabled >
                    <i class="si si-pencil"></i>&nbsp;Edit
                </button>' ?>
                <?php } else {?>
                    <?php echo '<button class="btn btn-info" id="edit-button">
                    <i class="si si-pencil"></i>&nbsp;Edit
                </button>' ?>
                <?php } ?>
            <?php }?>
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" id="cancel-button" disabled >
                    <i class="fa fa-close"></i>&nbsp;Cancel
                </button>
    </div>
    <!-- Default Elements -->
    <div class="block">
    
        <?php 
        foreach($response as $r) { ?>
        
        <div class="block-content">
            <form action="<?php echo base_url()?>user/dashboard/updateOrder?id=<?php echo $r['id_order']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                    <label class="col-12" for="example-text-input">Nomor NPK</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="nomor_npk" name="nomor_npk" value="<?php echo $r['npk'];?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-disabled-input">Nama/Departemen</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="department" name="department" value="<?php echo $r['name'];?>/<?php echo $r['department_name'];?>" disabled="">
                    </div>
                </div>
            <div class="form-group row">
                    <label class="col-12">Jenis Pekerjaan</label>
                    <div class="col-12">
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" require_once type="radio" name="r_jenispekerjaan" id="r_part_baru" value="Part Baru" <?php if($r['order_type']=='Part Baru') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_part_baru">Part Baru</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" require_once type="radio" name="r_jenispekerjaan" id="r_repair" value="Repair" <?php if($r['order_type']=='Repair') echo 'checked'?> disabled>
                            <label class="custom-control-label"  for="r_repair">Repair</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" require_once type="radio" name="r_jenispekerjaan" id="r_modifikasi" value="Modifikasi" <?php if($r['order_type']=='Modifikasi') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_modifikasi">Modifikasi</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Respon yang di inginkan</label>
                    <div class="col-12">
                        <div class="custom-control custom-radio custom-control-inline mb-5">
                            <input class="custom-control-input" require_once type="radio" name="kategori" id="r_urgent" value="urgent" <?php if($r['kategori']=='urgent') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_urgent">Mendesak (Ugent)*</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline mb-5">
                            <input class="custom-control-input" require_once type="radio" name="kategori" id="r_biasa" value="biasa" <?php if($r['kategori']=='biasa') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_biasa">Biasa</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Nama Part</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control"  required id="nama_part" name="nama_part" value="<?php echo $r['nama_part'];?>" disabled>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Jumlah</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="jumlah" required name="jumlah" placeholder="Masukan Jumlah" value="<?php echo $r['jumlah'];?>" disabled>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Raw type</label>
                    <div class="col-12" id="rawradio">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_block" value="1" <?php if($r['id_raw_type']==1) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_block">Block</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_cylinder" value="2" <?php if($r['id_raw_type']==2) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_cylinder">Cylinder</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_fabrikasi" value="3" <?php if($r['id_raw_type']==3) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_fabrikasi">Fabrikasi</label>
                        </div>
                        <button type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5" id="cancel_raw" disabled>
                            <i class="fa fa-times"></i>
                        </button> 
                    </div>
                    
                    
                    
                </div>
                
                <div id="dimensi">
                    <?php if($r['id_raw_type'] != NULL){ ?>
                        <div class="form-group row" id="dimensi2">
                        <label class="col-12" for="example-text-input">Dimensi Produk</label>
                    <br><br>
                    <div class="col-md-2">P
                        <input type="number" class="form-control" id="panjang" name="panjang" value="<?php echo $r['panjang'];?>" disabled>
                    </div>
                    <div class="col-md-2">L
                        <input type="number" class="form-control" id="lebar" name="lebar" value="<?php echo $r['lebar'];?>" disabled >
                    </div>
                    <div class="col-md-2">T
                        <input type="number" class="form-control" id="diameter" name="diameter" value="<?php echo $r['diameter'];?>" disabled>
                    </div>
                </div>
                    <?php } ?>
                </div>
                
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Material</label>
                    <div class="col-md-4" id="selectmaterial">
                        <input type="text" class="form-control" id="material" name="material" value="<?php echo $r['nama_material'];?>" disabled="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-8" for="example-text-input">Gambar Keterangan</label>
                </div>
                <div class="form-group row">
                    <label class="col-8" for="example-text-input">Upload Gambar Keterangan</label>
                    <div class="col-md-5">
                        <input type="hidden" name="userfile_old" value="<?php echo $r['attachment'];?>">
                        <input type="file" name="userfile" id="gambar" size="20" disabled>
                            
                    </div>
                    
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn" id="gambar_keterangan">
                <?php if ($r['attachment'] != NULL) {?>
                <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="<?=base_url() .'uploads/'.$r['attachment']?>">
                        <img class="img-fluid" src="<?=base_url() .'uploads/'.$r['attachment']?>" alt="pict" >
                        
                    </a>
                    <?php } else {?>
                        <label class="col-8" for="example-text-input">Gambar Tidak Ada</label>
                        <?php }?>   
                </div>
                <div class="form-group row">
                <button type="button" class="btn btn-success" id="ganti_btn" disabled  >
                    <i class="si si-check"></i>&nbsp;Ganti Gambar
                </button>
                </div>
                <br><br>
                <div class="form-group row">
                <button class="btn btn-success" id="submit_btn" disabled>
                    <i class="si si-check"></i>&nbsp;Submit
                </button>
                </div>
            </form>
        </div>
        <?php }?>
        
    </div>
                            <!-- END Default Elements -->
 </div>
 
</div>
<script>
    $('#edit-button').click(function(){
        $("#submit_btn").removeAttr('disabled');
        $("#r_part_baru").removeAttr('disabled');
        $("#r_repair").removeAttr('disabled');
        $("#r_modifikasi").removeAttr('disabled');
        $("#r_urgent").removeAttr('disabled');
        $("#r_biasa").removeAttr('disabled');
        $("#nama_part").removeAttr('disabled');
        $("#jumlah").removeAttr('disabled');
        $("#r_block").removeAttr('disabled');
        $("#r_cylinder").removeAttr('disabled');
        $("#r_fabrikasi").removeAttr('disabled');
        $("#panjang").removeAttr('disabled');
        $("#lebar").removeAttr('disabled');
        $("#diameter").removeAttr('disabled');
        // $("#material").removeAttr('disabled');
        $("#cancel_raw").removeAttr('disabled');
        $("#cancel-button").removeAttr('disabled');
        $("#ganti_btn").removeAttr('disabled');
        $("#material").remove(); 
        $("#selectmaterial").empty().append (`
        <select class="form-control col-md-4" id="material" name="material">
                    <?php foreach($material as $m){ ?>
            <option value="<?php echo $m['id_material']; ?>"><?php echo $m['nama_material']; ?> </option>
                    <?php } ?>                
        </select>
        `);
  });
  $('#cancel-button').click(function(){
    location.reload(true);
  });

  $('#ganti_btn').click(function(){
    $("#gambar").removeAttr('disabled');
  })
  
</script>

 
 