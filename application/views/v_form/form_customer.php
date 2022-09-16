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
            <form action="<?php echo base_url()?>user/dashboard/createOrder" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                    <label class="col-12" for="example-text-input">Nomor NPK</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="nomor_npk" name="db_nomor_npk" placeholder="<?=$this->session->userdata('npk')?>" disabled>
                        <input type="hidden" name= "id_user" value="<?=$this->session->userdata('id_user')?>">
                        <input type="hidden" name= "id_department" value="<?=$this->session->userdata('id_department')?>">
                        <input type="hidden" name= "id_section" value="<?=$this->session->userdata('id_section')?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-disabled-input">Nama/Departemen</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="department" name="db_department" placeholder="<?=$this->session->userdata('user_name')?>/<?=$this->session->userdata('department_name')?>" disabled="">
                    </div>
                </div>
            <div class="form-group row">
                    <label class="col-12">Jenis Pekerjaan</label>
                    <div class="col-12">
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" required type="radio" name="r_jenispekerjaan" id="r_part_baru" value="Part Baru">
                            <label class="custom-control-label" for="r_part_baru">Part Baru</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" required type="radio" name="r_jenispekerjaan" id="r_repair" value="Repair">
                            <label class="custom-control-label"  for="r_repair">Repair</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input" required type="radio" name="r_jenispekerjaan" id="r_modifikasi" value="Modifikasi">
                            <label class="custom-control-label" for="r_modifikasi">Modifikasi</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Respon yang di inginkan</label>
                    <div class="col-12">
                        <div class="custom-control custom-radio custom-control-inline mb-5">
                            <input class="custom-control-input" required type="radio" name="kategori" id="r_urgent" value="urgent">
                            <label class="custom-control-label" for="r_urgent">Mendesak (Ugent)*</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline mb-5">
                            <input class="custom-control-input"  required type="radio" name="kategori" id="r_biasa" value="biasa">
                            <label class="custom-control-label" for="r_biasa">Biasa</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Nama Part</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" required id="nama_part" name="nama_part" placeholder="Masukan nama part">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Jumlah</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" required id="jumlah" name="jumlah" placeholder="Masukan Jumlah">
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Raw type</label>
                    <div class="col-12" id="rawradio">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_block" value="1">
                            <label class="custom-control-label" for="r_block">Block</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_cylinder" value="2">
                            <label class="custom-control-label" for="r_cylinder">Cylinder</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_fabrikasi" value="3">
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
                    <label class="col-12" for="example-text-input">Material</label>
                    <select class="form-control col-md-4" id="material" name="material">
                        <option value="" disabled selected>--Select Material--</option>
                        <?php foreach($material as $m){ ?>
                            <option value="<?php echo $m['id_material']; ?>"><?php echo $m['nama_material']; ?> </option>
                        <?php } ?>                
                    </select>
                    
                </div>
                <div class="form-group row">
                    <label class="col-8" for="example-text-input">Upload Gambar Keterangan</label>
                    <div class="col-md-5">
                        <input type="file" name="userfile" size="20">    
                    </div>
                    
                </div>
                <br><br>
                <div class="form-group row">
                
                <button class="btn btn-success" id="">
                    <i class="si si-check"></i>&nbsp;Submit
                </button>
            </form>
        </div>
    </div>
                            <!-- END Default Elements -->
 </div>
 
</div>

<script>
    
</script>

 
 