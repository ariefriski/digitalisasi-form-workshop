<!doctype html>
<html lang="en" class="no-focus">
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Print</title>
    <style>
        table, th, td {
  border: 1px solid;
}
    </style>
    </head>
    <body>
    <div id="page-container" class="side-scroll page-header-modern main-content-boxed">
            <!-- END Sidebar -->

            <!-- Header -->
            
            <!-- END Header -->
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content" style="max-width:100%;">
        <!-- Default Table Style -->
        <!-- Table -->
        <div class="block">
            <div class="block-content" style="padding-bottom: 20px;">
                <table class="table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Urgent</th>
                        <th>No Order</th>
                        <th>Request By</th>
                        <th>Department</th>
                        <th>Nama Part</th>
                        <th>Jumlah</th>
                        <th>Material</th>
                        <th>Item Pekerjaan</th>
                        <th>Status</th>
                        <th>Cost Material</th>
                        <th>Cost Process</th>
                        <th>Cost Total</th>
                        <?php
                            foreach ($columnTitle as $ct) {
                                echo '
                                    <th>'.$ct['nama_proses'].'</th>
                                ';
                            }
                        ?>                
                    
                        <th>Total Actual</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=0;?>
                    <?php foreach($list as $l){ ?>
                        <?php $tanggal = date_create($l->tanggal); ?>
                      <tr>
                        <td><?php echo date_format($tanggal,"d/m/Y") ;?></td>
                        <td><?php echo $l->kategori ;?></td>
                        <td><?php echo $l->id_order ;?></td>
                        <td><?php echo $l->name ;?></td>
                        <td><?php echo  $l->department_name ;?></td>
                        <td><?php echo $l->nama_part ;?></td>
                        <td><?php echo $l->jumlah ;?></td>
                        <td><?php echo $l->nama_material;?></td>
                        <td><?php echo $l->order_type;?></td>
                        <td><?php echo $l->status_pengerjaan;?></td>
                        <td><?php echo 'Rp '.number_format($l->total_cost_material, 0, ',', '.');?></td>
                        <td><?php echo 'Rp '.number_format($l->total_cost_process, 0, ',', '.');?></td>
                        <td><?php echo 'Rp '.number_format($l->total_all, 0, ',', '.');?></td>

                        <?php $columnTitle = $this->m_proses->showDatabaseProcess();?>
			              <?php   $idOrder = $this->m_proses->getIdOrderProcess(); ?>
                        
                        <?php foreach ($columnTitle as $ct) { ?>
                         <?php  $detailProcess = $this->m_proses->getDataProcessing($idOrder[$i]['id_order'],$ct['id_proses']); ?>   
                        <?php if(!empty($detailProcess[0]['hour'])) { ?>
                            <td><?php echo $detailProcess[0]['hour']; ?></td>
                        <?php }else{ ?>    
                            <td><?php echo "-" ?></td>
                        <?php }?>
                        <?php  } ?>
                        <td><?php echo $l->total_hour;?></td>
                      </tr>
                      
                    <?php $i++;} ?>
                </tbody>
            </table>
        </div>
    </div>            
</div>
</main>
</body >

