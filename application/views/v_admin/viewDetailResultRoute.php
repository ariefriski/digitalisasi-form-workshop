<!-- Main Container -->
<main id="main-container">
<!-- Page Content -->
<div class="content">
    <!-- Default Table Style -->
    <h2 class="content-heading" style="text-align:center; font-weight:bold;">Detail Routing Plan</h2>
    <?php var_dump($dataRoutingPlan);?>
    <!-- Table -->
    <div class="block">
        <div class="block-header block-header-default">
            <?php 
                if (!empty($dataRoutingPlan)) { ?>
                <table>
                    <tr>
                        <td>No Order</td>
                        <td> : </td>
                        <td><?=$dataRoutingPlan[0]['id_order']?></td>
                    </tr>
                    <tr>
                        <td>Nama Part</td>
                        <td> : </td>
                        <td><?=$dataRoutingPlan[0]['nama_part']?></td>
                    </tr>
                    <tr>
                        <td>Tempat Pembuatan</td>
                        <td> : </td>
                        <td><?=$dataRoutingPlan[0]['tempat_pembuatan']?></td>
                    </tr>
                    <tr>
                        <td>Material</td>
                        <td> : </td>
                        <td><?=$dataRoutingPlan[0]['material']?></td>
                    </tr>
                    <tr>
                        <td>Cost Material</td>
                        <td> : </td>
                        <td><?=$dataRoutingPlan[0]['cost_material']?></td>
                    </tr>
                    <tr>
                        <td>Cost Process</td>
                        <td> : </td>
                        <td><?=$dataRoutingPlan[0]['cost_process']?></td>
                    </tr>
                    <tr>
                        <td>Total Cost</td>
                        <td> : </td>
                        <td><?=$dataRoutingPlan[0]['total_cost']?></td>
                    </tr>
                </table>
                    
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
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>            
</div>
</main>


