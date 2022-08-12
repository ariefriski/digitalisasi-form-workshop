<style>
    /* Ensure that the demo table scrolls */
    th, td { border: 1px solid; }
  /* Ensure that the demo table scrolls */
    table{
        width: 250%;
    }
</style>
<div class="row">
<div class="col-md-12">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <img src="<?php echo base_url().'assets/media/photos/cbi-logo.png';?>" alt="logo-cbi" width="50" height="50">
<h2  style="text-align: center;">Input Order</h2>
</div>
</div>
<table id="table-input-order" class="table table-vcenter" >
   
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Urgent</th>
                <th>Nomor Permintaan</th>
                <th>Requestor</th>
                <th>Dept</th>
                <th>Mesin</th>
                <th>Jumlah</th>
                <th>Material</th>
                <th>Item Pekerjaan</th>
                <th>Status</th>
                <th>COS MAT.</th>
                <?php
                    foreach ($columnTitle as $ct) {
                        echo '
                            <th>'.$ct['nama_proses'].'</th>
                        ';
                    }
                ?>                
             
                <th>Total Actual</th>
                
                <th colspan="4">Proses Design & CAM</th>
                <th colspan="2">Proses</th>
               
            </tr>
        </thead>
        <tbody>
                <tr>

                </tr>
        </tbody>
</table>

