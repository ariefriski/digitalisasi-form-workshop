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
                            </div>
                            <!-- Default Elements -->
                            <div class="block">
                                <div class="block-content">
                                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return false;">
                                    <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Nomor NPK</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="nomor_npk" name="nomor_npk" placeholder="NPK">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-disabled-input">Nama/Departemen</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="department" name="department" placeholder="Arief/Departemen A" disabled="">
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                            <label class="col-12">Jenis Pekerjaan</label>
                                            <div class="col-12">
                                                <div class="custom-control custom-radio mb-5">
                                                    <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_part_baru" value="Part Baru">
                                                    <label class="custom-control-label" for="r_part_baru">Part Baru</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-5">
                                                    <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_repair" value="Repair">
                                                    <label class="custom-control-label" for="r_repair">Repair</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-5">
                                                    <input class="custom-control-input" type="radio" name="r_jenispekerjaan" id="r_modifikasi" value="Modifikasi">
                                                    <label class="custom-control-label" for="r_modifikasi">Modifikasi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12">Respon yang di inginkan</label>
                                            <div class="col-12">
                                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                                    <input class="custom-control-input" type="radio" name="respon" id="r_urgent" value="urgent">
                                                    <label class="custom-control-label" for="r_urgent">Mendesak (Ugent)*</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                                    <input class="custom-control-input" type="radio" name="respon" id="r_biasa" value="biasa">
                                                    <label class="custom-control-label" for="r_biasa">Biasa</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Nama Part</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="nama_part" name="nama_part" placeholder="Masukan nama part">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Jumlah</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12">Raw type</label>
                                            <div class="col-12" id="rawradio">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="raw_type" id="r_block" value="block">
                                                    <label class="custom-control-label" for="r_block">Block</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="raw_type" id="r_cylinder" value="cylinder">
                                                    <label class="custom-control-label" for="r_cylinder">Cylinder</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input class="custom-control-input" type="radio" name="raw_type" id="r_fabrikasi" value="fabrikasi">
                                                    <label class="custom-control-label" for="r_fabrikasi">Fabrikasi</label>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5" id="cancel_raw">
                                    <i class="fa fa-times"></i>
                                </button>
                                            </div>
                                            
                                        </div>
                                        
                                        <div id="dimensi">
                                            
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-8" for="example-text-input">Material</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="material" name="material" placeholder="Material">
                                            </div>                                          
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-8" for="example-text-input">Upload Gambar Keterangan</label>
                                            <div class="col-md-5">
                                            <input type="file" id="upload_gambar" name="upload_gambar" multiple="">
                                            </div>
                                            
                                        </div>
                                        <br><br>
                                        <div class="form-group row">
                                        <a href="<?php echo base_url(); ?>user/dashboard" class="btn btn-secondary" id="">
                                            <i class="si si-check"></i>&nbsp;Submit
                                        </a>
                                    </form>
                                </div>
                            </div>
                            <!-- END Default Elements -->
 </div>
 
</div>

 
 