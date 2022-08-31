<!-- Main Container -->
<main id="main-container">
<!-- Page Content -->
<div class="content">
    <!-- Default Table Style -->
    <h2 class="content-heading" style="text-align:center; font-weight:bold; font-size:28px;">Detail Routing Plan</h2>
    <!-- Table -->
    <div class="block">
        <div class="block-header block-header-default" style="display:block;">
            <?php 
                if (!empty($dataRoutingPlan)) { ?>
                <div class="row">
                    <div class="col-4">
                        <table>
                            <tr>
                                <th>No Order</th>
                                <td> : &nbsp;</td>
                                <td><?=$dataRoutingPlan[0]['id_order']?></td>
                            </tr>
                            <tr>
                                <th>Nama Part</th>
                                <td> : </td>
                                <td><?=$dataRoutingPlan[0]['nama_part']?></td>
                            </tr>
                            <tr>
                                <th>Tempat Pembuatan</th>
                                <td> : </td>
                                <td><?=$dataRoutingPlan[0]['tempat_pembuatan']?></td>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <td> : </td>
                                <td><?=$dataRoutingPlan[0]['nama_material']?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table>
                            <tr>
                                <th>Cost Material</th>
                                <td> : &nbsp;</td>
                                <td>Rp <?=number_format($dataRoutingPlan[0]['total_cost_material'], 0, ',', '.')?></td>
                            </tr>
                            <tr>
                                <th>Cost Process</th>
                                <td> : </td>
                                <td>Rp <?=number_format($dataRoutingPlan[0]['total_cost_process'], 0, ',', '.')?></td>
                            </tr>
                            <tr>
                                <th>Total Cost</th>
                                <td> : </td>
                                <td>Rp <?=number_format($dataRoutingPlan[0]['total_all'], 0, ',', '.')?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-2">
                        
                    </div>
                </div>
                
                
                    
            <?php 
                } else {
                    echo 'false';
                }
            ?>
            
        </div>
        <div class="block-content" style="padding-bottom: 20px;">
            <table class="table table-vcenter" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nama Proses</th> 
                        <th>Hour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($detailDataRoutingPlan as $data) { ?>
                        <tr>
                            <td><?=$data['nama_proses']?></td>
                            <td><?=$data['hour']?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>TOTAL HOUR</th> 
                        <th><?=$dataRoutingPlan[0]['total_hour']?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>            
</div>
</main>


