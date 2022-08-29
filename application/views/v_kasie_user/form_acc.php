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
<div class="col-md-6">
    <div class="block-header block-header-default">
            <h3 class="block-title" style="text-align: center;">1. FORM PERMINTAAN (di isi oleh user)</h3> 
    </div>
    <!-- Default Elements -->
    <div class="block">
        <div class="block-content">
            
            <div class="form-group row">
                <?php foreach($accept as $a) { ?>
                    <label class="col-12" for="example-text-input">Nomor NPK</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="nomor_npk" name="nomor_npk" value="<?php echo $a['npk'];?>"  disabled >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-disabled-input">Nama/Departemen</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="department" name="department" value="<?php echo $a['name'];?>/<?php echo $a['department_name'];?>" disabled="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Jenis Pekerjaan</label>
                    <div class="col-12">
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_part_baru" value="Part Baru" <?php if($a['order_type']=='Part Baru') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_part_baru">Part Baru</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_repair" value="Repair" <?php if($a['order_type']=='Repair') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_repair">Repair</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_modifikasi" value="Modifikasi" <?php if($a['order_type']=='Modifikasi') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_modifikasi">Modifikasi</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Respon yang di inginkan</label>
                    <div class="col-12">
                        <div class="custom-control custom-radio custom-control-inline mb-5">
                            <input class="custom-control-input" type="radio" name="kategori" id="r_urgent" value="urgent" <?php if($a['kategori']=='urgent') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_urgent">Mendesak (Ugent)*</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline mb-5">
                            <input class="custom-control-input" type="radio" name="kategori" id="r_biasa" value="biasa" <?php if($a['kategori']=='biasa') echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_biasa">Biasa</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Nama Part</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $a['nama_part'];?>" disabled>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Jumlah</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" value="<?php echo $a['jumlah'];?>" disabled>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Raw type</label>
                    <div class="col-12" id="rawradio">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_block" value="1" <?php if($a['id_raw_type']==1) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_block">Block</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_cylinder" value="2" <?php if($a['id_raw_type']==2) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_cylinder">Cylinder</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_fabrikasi" value="3" <?php if($a['id_raw_type']==3) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_fabrikasi">Fabrikasi</label>
                        </div>
                    </div>
                </div>
                
                <div id="dimensi">
                    <?php if($a['id_raw_type'] != NULL){ ?>
                        <div class="form-group row" id="dimensi2">
                        <label class="col-12" for="example-text-input">Dimensi Produk</label>
                    <br><br>
                    <div class="col-md-2">P
                        <input type="number" class="form-control" id="panjang" name="panjang" value="<?php echo $a['panjang'];?>" disabled>
                    </div>
                    <div class="col-md-2">L
                        <input type="number" class="form-control" id="lebar" name="lebar" value="<?php echo $a['lebar'];?>" disabled >
                    </div>
                    <div class="col-md-2">Diameter/Tebal
                        <input type="number" class="form-control" id="diameter" name="diameter" value="<?php echo $a['diameter'];?>" disabled>
                    </div>
                </div>
                    <?php } ?>
                </div>
                
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Material</label>
                    <div class="col-md-4" id="selectmaterial">
                        <input type="text" class="form-control" id="material" name="material" value="<?php echo $a['nama_material'];?>" disabled="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-8" for="example-text-input">Gambar Keterangan</label>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn" id="gambar_keterangan">
                <?php if ($a['attachment'] != NULL) {?>
                <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="<?=base_url() .'uploads/'.$a['attachment']?>">
                        <img class="img-fluid" src="<?=base_url() .'uploads/'.$a['attachment']?>" alt="pict" >
                        
                    </a>
                    <?php } else {?>
                        <label class="col-8" for="example-text-input">Gambar Tidak Ada</label>
                        <?php }?>   
                </div>
                <br><br>
                <?php }?>
            
        </div>
    </div>
                            <!-- END Default Elements -->
 </div>
 <div class="col-md-6"> 
 <div class="block-header block-header-default">
<h3 class="block-title" style="text-align: center;">2. Response PIC Workshop</h3> 
</div>
        <div class="block">
        <div class="block-content">
        
        <?php foreach($accept as $a) { ?>
            <form action="<?php echo base_url()?>kasie_user/dashboard/acceptOrder?id=<?php echo $a['id_order']; ?>" method="post">
            <div class="form-group row" >
                    <label class="col-8" for="example-text-input">Kasie/Kadept Approval Department X</label>
                    <div class="col-6">
                    
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="r_order_response" id="accept" value="accept" <?php if($a['status_approval']=='Disetujui') echo 'checked'?>>
                        <span class="css-control-indicator"></span> Accept
                    </label>
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="r_order_response" id="reject" value="reject" <?php if($a['status_approval']=='Ditolak') echo 'checked'?>>
                        <span class="css-control-indicator"></span> Reject
                    </label>
                    <?php if($a['status_approval']!= NULL) { ?>
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <span class="css-control-indicator"></span> Accept By <?php echo $a['jenis_approval'] ?>
                    </label>
                    <?php } ?>
                </div>
                </div>
                <div  id="reason1">
                    
                </div>
                <div class="form-group row">
                <button class="btn btn-success" id="submit_btn">
                    <i class="si si-check"></i>&nbsp;Kirim
                </button>
                </div>
                <?php } ?>
            </form>
            
        </div>
    </div>
</div>
</div>

 
 