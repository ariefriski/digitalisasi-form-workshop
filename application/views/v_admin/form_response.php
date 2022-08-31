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
        <?php 
                                foreach($accept_response as $ar) { 
                            ?>
    <div class="col-md-6">
        <input type="text" class="form-control" id="no_order" name="no_order" placeholder="Nomor Order" disabled  value="<?php echo $ar['id_order'];?>">
        <div class="form-text text-muted">di isi oleh admin PE</div>
        <?php }?>                      
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
                        <input type="text" class="form-control" id="nomor_npk" name="nomor_npk" value="<?php echo $ar['npk'];?>"  disabled >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="example-disabled-input">Nama/Departemen</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="department" name="department" value="<?php echo $ar['name'];?>/<?php echo $ar['department_name'];?>" disabled="">
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
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_block" value="1" <?php if($ar['id_raw_type']==1) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_block">Block</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_cylinder" value="2" <?php if($ar['id_raw_type']==2) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_cylinder">Cylinder</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="raw_type" id="r_fabrikasi" value="3" <?php if($ar['id_raw_type']==3) echo 'checked'?> disabled>
                            <label class="custom-control-label" for="r_fabrikasi">Fabrikasi</label>
                        </div>
                        
                    </div>
                    
                    
                </div>
                
                <div id="dimensi">
                    <?php if($ar['id_raw_type'] != NULL){ ?>
                        <div class="form-group row" id="dimensi2">
                        <label class="col-12" for="example-text-input">Dimensi Produk</label>
                    <br><br>
                    <div class="col-md-2">P
                        <input type="number" class="form-control" id="panjang" name="panjang" value="<?php echo $ar['panjang'];?>" disabled>
                    </div>
                    <div class="col-md-2">L
                        <input type="number" class="form-control" id="lebar" name="lebar" value="<?php echo $ar['lebar'];?>" disabled >
                    </div>
                    <div class="col-md-2">Diameter/Tebal
                        <input type="number" class="form-control" id="diameter" name="diameter" value="<?php echo $ar['diameter'];?>" disabled>
                    </div>
                </div>
                    <?php } ?>
                </div>
                
                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Material</label>
                    <div class="col-md-4" id="selectmaterial">
                        <input type="text" class="form-control" id="material" name="material" value="<?php echo $ar['nama_material'];?>" disabled="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-8" for="example-text-input">Gambar Keterangan</label>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-6 animated fadeIn">
                <?php if($ar['attachment']!=NULL){ ?>
                <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="<?=base_url() .'uploads/'.$ar['attachment']?>">
                        <img class="img-fluid" src="<?=base_url() .'uploads/'.$ar['attachment']?>" alt="pict"  >
                    </a>
                <?php }else{?>
                    <p>Gambar Tidak Ada</p>
                <?php }?>
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
            
            <form action="<?php echo base_url()?>admin/dashboard/acceptPIC" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="id_order" value="<?php echo $ar['id_order']; ?>" >
            <div class="form-group row" >
                    <label class="col-8" for="example-text-input">Kasie/Kadept Approval Department X</label>
                    <div class="col-6">
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="r_order_response" id="accept" value="accept" <?php if($ar['status_approval_1']=='Disetujui') echo 'checked'?> disabled>
                        <span class="css-control-indicator"></span> Accept
                    </label>
                    
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="r_order_response" id="reject" value="reject" <?php if($ar['status_approval_1']=='Ditolak') echo 'checked'?> disabled>
                        <span class="css-control-indicator"></span> Reject
                    </label>
                </div>
            </div>    
            <!-- PIC APPROVE -->
            <div class="form-group row" >
            <label class="col-8" for="example-text-input">PIC Workshop Approval</label>
                <div class="col-6">
                    
                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="pic_response" id="accept" value="accept" >
                        <span class="css-control-indicator"></span> Accept
                    </label>
                    
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="pic_response" id="reject" value="reject">
                        <span class="css-control-indicator"></span> Reject
                    </label>
                    <?php }?>
                </div>
            </div>    
        
                <div  id="reason1">
                 
                </div>
                <?php if($ar['status_approval_1']=='Disetujui') {?>
                    <?php if($ar['id_order']== NULL){?>
                    <div class="form-group row">
                            <label class="col-8" for="example-text-input">Nomor Order</label>
                    <div class="col-md-6">
                            <input type="text" class="form-control" id="no_order" name="no_order" placeholder="Nomor Order" required>
                    </div>
                    </div>
                        <?php } ?>   
                      
                    <div class="form-group row">
                    <?php if(($ar['kategori']=='urgent')&&($ar['approve3']=='Done')){ ?>
                    <label class="col-8" for="example-text-input">Process Order</label>
                    <div class="col-6">
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="response_order" id="inhouse" value="inhouse" >
                        <span class="css-control-indicator"></span> Inhouse
                    </label>
                    
                    <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                        <input type="radio" class="css-control-input" name="response_order" id="outhouse" value="outhouse">
                        <span class="css-control-indicator"></span> Outhouse
                    </label>
                </div>
                    </div>
                <?php } ?>
                </div>
               
                <?php } ?> 
                <div id="plan1">
                    
                </div>
                <div class="form-group row">
                <div class="col-8">
                        <button type="submit" id="submit_bt" class="btn btn-alt-primary"> Sumbit </button>
                    </div>
                </div>
        </form>
        </div>
    </div>
                            
                            
</div>
</div>

 
 <script>
     $(document).on('click',"#inhouse",function(){
                $("#plan1").empty().append(`
                <div id="plan2">
                                        <div class="form-group row" id="planxxx">
                                            
                                            <label class="col-12" for="routing_plan">Routing Plan</label>
                                            <div class="form-group row" id="form-group">
                                            <div class="col-md-8">
                                                <select class="form-control"  name="inputorder[]">
                                                <option value="0">Select</option>
                                                <?php foreach($get_Routing as $gr){ ?>
                                                <option value="<?php echo "$gr[id_proses]"?>"><?php echo "$gr[nama_proses]"?></option>
                                                <?php } ?>    
                                                </select>
                                                
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" id="example-text-input" name="hour[]" placeholder="0">
                                            </div>
                                            </div>

                                            
                                            
                                        </div>
                                        <button type="button" class="btn btn-sm btn-circle btn-alt-success mr-5 mb-5" id="add_process">
                                             <i class="fa fa-plus"></i>
                                         </button>
                                        <button type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5" id="remove_process" hidden>
                                        <i class="fa fa-times"></i>
                                         </button>    
                </div>
                `);
            });

            $(document).on('click',"#outhouse",function(){
                $("#plan1").empty().append(`
                <div id="plan2">
                                        <div class="form-group row" id="planxxx">
                                            
                                            <label class="col-12" for="routing_plan">Routing Plan</label>
                                            <div class="form-group row" id="form-group">
                                            <div class="col-md-8">
                                                <select class="form-control"  name="inputorder[]">
                                                <option value="0">Select</option>
                                                <?php foreach($get_Routing as $gr){ ?>
                                                <option value="<?php echo "$gr[id_proses]"?>"><?php echo "$gr[nama_proses]"?></option>
                                                <?php } ?>    
                                                </select>
                                                
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" id="example-text-input" name="hour[]" placeholder="0">
                                            </div>
                                            </div>

                                            
                                            
                                        </div>
                                        <button type="button" class="btn btn-sm btn-circle btn-alt-success mr-5 mb-5" id="add_process">
                                             <i class="fa fa-plus"></i>
                                         </button>
                                        <button type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5" id="remove_process" hidden>
                                        <i class="fa fa-times"></i>
                                         </button>    
                </div>
                `);
            });
        
            $(document).on('click',"#add_process",function(){
                $("#planxxx").append(`

                <div class="form-group row" id="form-group_1">
                                            <div class="col-md-8">
                                                <select class="form-control"  name="inputorder[]">
                                                <option value="0">Select</option>
                                                <?php foreach($get_Routing as $gr){ ?>
                                                <option value="<?php echo "$gr[id_proses]"?>"><?php echo "$gr[nama_proses]"?></option>
                                                <?php } ?>    
                                                </select>
                                                
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" id="example-text-input" name="hour[]" placeholder="0">
                                            </div>
                                            </div>

                `)
                $("#remove_process").removeAttr('hidden');

            });  
            $(document).on('click','#remove_process',function(){
                $("#form-group_1").remove();
               
            });

            if ($('#inhouse').is(':checked')){
                $("#submit_bt").attr('disabled','disabled');
            }else if ($('#outhouse').is(':checked')){
                $("#submit_bt").attr('disabled','disabled');
            }
 </script>