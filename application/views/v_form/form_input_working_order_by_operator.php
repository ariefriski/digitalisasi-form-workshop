<div class="row">
    <div class="col-md-2">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url().'assets/media/photos/cbi-logo.png';?>" alt="logo-cbi" width="120" height="120"><br>
        <p style="text-align: center;">PT. Century Batteries Indonesia</p>
    </div>
    <div class="col-md-8">
        <h2 class="content-heading" style="text-align: center;">ORDER PEMBUATAN REPAIR MODIFIKASI <br> KOMPONEN MESIN PERALATAN <br> <p style="font-size:small;">SEKSI WORKSHOP</p></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">FORM INPUT WORKING ORDER BY OPERATOR</h3>
                <!-- <div class="block-options">
                    <button type="button" class="btn-block-option">
                        <i class="si si-wrench"></i>
                    </button>
                </div> -->
            </div>
            <div class="block-content">
                <form id="insert_routing_actual" action="<?php echo base_url()?>user_ws/dashboard/input_actual_process" method="post" enctype="multipart/form-data">
                    <?php
                        foreach ($routing_plan as $rp) { ?>
                            <div class="form-group">
                                <label for="example-text-input"><?=$rp['nama_proses']?></label>
                                <input type="text" class="form-control" name="hour_proses[]" placeholder="Masukan total jam pengerjaan...">
                                <input type="hidden" class="form-control" name="id_proses[]" value="<?=$rp['id_proses']?>">
                            </div>
                    <?php    
                        }
                    ?>
                    <div class="form-group row">
                        <input type="hidden" class="form-control" name="id_order" value="<?=$rp['id_order']?>">
                        <input type="hidden" class="form-control" id="arr_id_proses" name="arr_id_proses" value="">
                        <input type="hidden" class="form-control" id="arr_hour_proses" name="arr_hour_proses" value="">
                        <button type="submit" class="btn btn-success" id="" onclick="getArrayIdProcess()" style="margin:auto;">
                            <i class="si si-check"></i>&nbsp;Submit
                        </button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<script>
    function getArrayIdProcess() {
        var IdProcess = document.getElementsByName('id_proses[]');
        var HourProcess = document.getElementsByName('hour_proses[]');
        var arrIdProcess = [];
        var arrHourProcess = [];

        for (var i = 0; i < IdProcess.length; i++) {
            arrIdProcess.push(IdProcess[i].value);
            arrHourProcess.push(HourProcess[i].value);            
        }

        console.log(arrIdProcess);
        console.log(arrHourProcess);

        $("#arr_id_proses").val(arrIdProcess);
        $("#arr_hour_proses").val(arrHourProcess);
    }
</script>