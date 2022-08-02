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
        <input type="text" class="form-control" id="no_order" name="no_order" placeholder="Nomor Order" >
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
                            <?php 
                                foreach($accept_response as $ar) { 
                            ?>
                                <div class="block-content">
                                    <form action="be_forms_elements_bootstrap.html" method="post" enctype="multipart/form-data" onsubmit="return false;">
                                    <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Nomor NPK</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="nomor_npk" name="nomor_npk" placeholder="NPK"  disabled >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-disabled-input">Nama/Departemen</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="department" name="department" placeholder="Arief/Departemen A" disabled="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12">Jenis Pekerjaan</label>
                                            <div class="col-12">
                                                <div class="custom-control custom-radio mb-5">
                                                    <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_part_baru" value="Part Baru" <?php if($ar['order_type']=='Part Baru') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_part_baru">Part Baru</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-5">
                                                    <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_repair" value="Repair" <?php if($ar['order_type']=='Repair') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_repair">Repair</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-5">
                                                    <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_modifikasi" value="Modifikasi" <?php if($ar['order_type']=='Modifikasi') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_modifikasi">Modifikasi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12">Respon yang di inginkan</label>
                                            <div class="col-12">
                                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                                    <input class="custom-control-input" type="radio" name="kategori" id="r_urgent" value="urgent" <?php if($ar['kategori']=='urgent') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_urgent">Mendesak (Ugent)*</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                                    <input class="custom-control-input" type="radio" name="kategori" id="r_biasa" value="biasa" <?php if($ar['kategori']=='biasa') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_biasa">Biasa</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Nama Part</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $ar['nama_part'];?>" disabled>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Jumlah</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" value="<?php echo $ar['jumlah'];?>" disabled>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12">Raw type</label>
                                            <div class="col-12" id="rawradio">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="raw_type" id="r_block" value="block" <?php if($ar['raw_type']=='block') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_block">Block</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="raw_type" id="r_cylinder" value="cylinder" <?php if($ar['raw_type']=='cylinder') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_cylinder">Cylinder</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="raw_type" id="r_fabrikasi" value="fabrikasi" <?php if($ar['raw_type']=='fabrikasi') echo 'checked'?> disabled>
                                                    <label class="custom-control-label" for="r_fabrikasi">Fabrikasi</label>
                                                </div>
                                               
                                            </div>
                                            
                                            
                                        </div>
                                        
                                        <div id="dimensi">
                                            <?php if($ar['raw_type'] != NULL){ ?>
                                                <div class="form-group row" id="dimensi2">
                                                <label class="col-12" for="example-text-input">Dimensi Produk</label>
                                            <br><br>
                                            <div class="col-md-2">P
                                                <input type="number" class="form-control" id="panjang" name="panjang" value="<?php echo $ar['panjang'];?>" disabled>
                                            </div>
                                            <div class="col-md-2">L
                                                <input type="number" class="form-control" id="lebar" name="lebar" value="<?php echo $ar['panjang'];?>" disabled >
                                            </div>
                                            <div class="col-md-2">T
                                                <input type="number" class="form-control" id="tinggi" name="tinggi" value="<?php echo $ar['panjang'];?>" disabled>
                                            </div>
                                        </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-8" for="example-text-input">Material</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="material" name="material" placeholder="Material" value="<?php echo $ar['material'];?>" disabled>
                                            </div>                                          
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-8" for="example-text-input">Gambar Keterangan</label>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-6 animated fadeIn">
                                        <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="<?=base_url() .'uploads/'.$ar['attachment']?>">
                                                <img class="img-fluid" src="<?=base_url() .'uploads/'.$ar['attachment']?>" alt="pict"  >
                                            </a>
                                        </div>
                                        <br><br>
                                <?php }?>
                                    </form>
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
                                <?php 
                                foreach($accept_response as $ar) { 
                                ?>
                                    <form action="be_forms_elements_bootstrap.html" method="post" enctype="multipart/form-data" onsubmit="return false;">
                                    <div class="form-group row" >
                                            <label class="col-8" for="example-text-input">Kadept Approval Department X</label>
                                            <div class="col-6">
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="r_order_response" id="accept" value="accept" <?php if($ar['approve']=='accept') echo 'checked'?> disabled>
                                                <span class="css-control-indicator"></span> Accept
                                            </label>
                                            
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="r_order_response" id="reject" value="reject" <?php if($ar['approve']=='reject') echo 'checked'?> disabled>
                                                <span class="css-control-indicator"></span> Reject
                                            </label>
                                        </div>
                                        </div>
                                        <div  id="reason1">
                                        <?php if($ar['alasan'] != NULL){ ?>
                                        <div class="form-group row" id="reason">
                                            <label class="col-12" for="example-textarea-input">*Alasan Reject</label>
                                        <div class="col-12">
                                            <textarea class="form-control" id="alasan" name="alasan" rows="6" placeholder="Alasan..." disabled>
                                            <?php echo $ar['alasan'];?>
                                            </textarea>
                                        </div>
                                        </div>
                                            <?php } ?>    
                                        </div>
                                        <?php if($ar['approve']=='accept') {?>
                                        <div class="form-group row">
                                            <label class="col-8" for="example-text-input">Process Order</label>
                                            <div class="col-6">
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="response_order" id="inhouse" >
                                                <span class="css-control-indicator"></span> Inhouse
                                            </label>
                                            
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="response_order" id="subcount">
                                                <span class="css-control-indicator"></span> Subcount
                                            </label>
                                        </div>
                                        </div>
                                        <?php } else {?>
                                            <?php echo 'Request Di Tolak'?>
                                        <?php } ?>
                                        <div id="plan1">
                                        
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-8">
                                                <button type="submit" class="btn btn-alt-primary"> Sumbit </button>
                                            </div>
                                        </div>
                                </form>
                                </div>
                                <?php 
                              } 
                            ?>
                            </div>
                            
</div>
</div>

 
 