<div class="content">
                    <!-- Default Table Style -->
                    <h2 class="content-heading">Dashboard User.</h2>

                    <!-- Table -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">List Form Order</h3>
                            <div class="block-options">
                                <div class="block-options-item">
                                <a href="<?php echo base_url(); ?>user/dashboard/createForm" type="button" class="btn btn-success mr-5 mb-5">
                                    <i class="fa fa-plus mr-5"></i>Add Order
                                </a>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <table id="table-dashboard" class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Nama Part</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th class="d-none d-sm-table-cell" style="width: 10%;">Kategori</th>
                                        <th >Status Laporan</th>
                                        <th >Status Pengerjaan</th>
                                        <th class="text-center" style="width: 18%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Table -->

                    <!-- Striped Table -->


                    <!-- Hover Table -->
                  
                    <!-- END Hover Table -->

                    <!-- Bordered Table -->
                   
                    <!-- END Contextual Table -->
                    <!-- END Default Table Style -->
</div>
                                    <!-- <?php 
                                    $no = 1;
                                    foreach($list as $l){
                                    ?>
                                    <tr>
                                        <th class="text-center" scope="row"><?php echo $no++;?></th>
                                        <td><?php echo $l->nama_part;?></td>
                                        <td><?php echo $l->tanggal;?></td>
                                        <td><?php echo date('G:i', strtotime($l->jam));?></td>
                                        
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-danger"><?php echo $l->kategori;?></span>
                                        </td>
                                        <?php echo "<h1>ddd</h1>" ?>
                                        <td>
                                        <button type="button" class="js-swal-warning btn btn-alt-secondary">
                                        <i class="fa fa-cog fa-spin"></i> <?php echo $l->status_laporan;?>
                                    </button>
                                        </td>
                                        <td><?php echo $l->status_pengerjaan;?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                     <tr>
                                        <th class="text-center" scope="row">2</th>
                                        <td>Water Leveling Charging</td>
                                        <td>07/07/2020</td>
                                        <td>08:30</td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-warning">Biasa</span>
                                        </td>
                                        <td>
                                        <button type="button" class="js-swal-success btn btn-alt-secondary">
                                        <i class="fa fa-check text-success mr-5"></i> Diterima
                                    </button>
                                        </td>
                                        <td>Selesai Dikerjakan</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">3</th>
                                        <td>Fire Hidrant</td>
                                        <td>07/07/2020</td>
                                        <td>08:32</td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-warning">Biasa</span>
                                        </td>
                                        <td>
                                        <button type="button" class="js-swal-error btn btn-alt-secondary">
                                        <i class="fa fa-times text-danger mr-5"></i> Ditolak
                                    </button>
                                        </td>
                                        <td>
                                            Sedang dikerjakan
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>  -->