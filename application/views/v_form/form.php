<div class="row">
<div class="col-md-2">
<img src="<?php echo base_url().'assets/media/photos/cbi-logo.png';?>" alt="logo-cbi" width="120" height="120">
</div>
<div class="col-md-8">
<h2 class="content-heading" style="text-align: center;">ORDER PEMBUATAN REPAIR MODIFIKASI <br> KOMPONEN MESIN PERALATAN <br> <p style="font-size:small;">SEKSI WORKSHOP</p></h2>
</div>
</div>
<div class="col-md-6">
    <div class="form-group row">
        <label class="col-8" for="example-text-input">Nomor Order</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="Nomor Order" disabled="">
                                                
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
                                    <form action="be_forms_elements_bootstrap.html" method="post" enctype="multipart/form-data" onsubmit="return false;">
                                    <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Nomor NPK</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="nomor_npk" name="nomor_npk" placeholder="NPK">
                                                <div class="form-text text-muted">Input NPK</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-disabled-input">Departemen</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="department" name="department" placeholder="Departemen A" disabled="">
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
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="nama_part" name="nama_part" placeholder="Masukan nama part">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Jumlah</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12">Raw type</label>
                                            <div class="col-12">
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
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-text-input">Dimensi Produk</label>
                                            <br><br>
                                            <div class="col-md-2">P
                                                <input type="text" class="form-control" id="panjang" name="panjang" placeholder="Masukan Jumlah">
                                            </div>
                                            <div class="col-md-2">L
                                                <input type="text" class="form-control" id="lebar" name="lebar" placeholder="Masukan Jumlah">
                                            </div>
                                            <div class="col-md-2">T
                                                <input type="text" class="form-control" id="tinggi" name="tinggi" placeholder="Masukan Jumlah">
                                            </div>
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
                                        <div class="col-8">
                                                <button type="submit" class="btn btn-alt-primary">Submit</button>
                                            </div>
                                        </div>
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
                                    <form action="be_forms_elements_bootstrap.html" method="post" enctype="multipart/form-data" onsubmit="return false;">
                                    <div class="form-group row">
                                            <label class="col-8" for="example-text-input">Order Response</label>
                                            <div class="col-6">
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="r_order_response" >
                                                <span class="css-control-indicator"></span> Accept
                                            </label>
                                            
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="r_order_response">
                                                <span class="css-control-indicator"></span> Reject
                                            </label>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="example-textarea-input">*Masukan Alasan Jika Reject</label>
                                            <div class="col-12">
                                                <textarea class="form-control" id="alasan" name="alasan" rows="6" placeholder="Alasan..."></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-8" for="example-text-input">Process Order</label>
                                            <div class="col-6">
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="r_process_order" >
                                                <span class="css-control-indicator"></span> Inhouse
                                            </label>
                                            
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="radio" class="css-control-input" name="r_process_order">
                                                <span class="css-control-indicator"></span> Subcount
                                            </label>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="routing_plan">Routing Plan</label>
                                            <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_1" name="routing_item_1">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_2" name="routing_item_2">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_3" name="routing_item_3">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_4" name="routing_item_4">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_5" name="routing_item_5">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_6" name="routing_item_6">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
</div>
</div>


 
 