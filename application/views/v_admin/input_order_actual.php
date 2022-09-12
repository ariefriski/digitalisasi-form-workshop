<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content" style="max-width:100%;">
        <!-- Default Table Style -->
        <h2 class="content-heading" style="text-align:center; font-weight:bold; font-size:28px;">Order List</h2>

        <!-- Table -->
        <div class="block">
            <div class="block-content" style="padding-bottom: 20px;">
                <table id="table-input-order-actual" class="table table-vcenter text-nowrap">
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
                    
                </tbody>
            </table>
        </div>
    </div>            
</div>
</main>

