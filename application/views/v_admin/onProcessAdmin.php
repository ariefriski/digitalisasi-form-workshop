<body>
<div class="content">
                    <!-- Default Table Style -->
    <h2 class="content-heading">Dashboard Admin</h2>

    <!-- Table -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Form Order</h3>
            
        </div>
        <div class="block-content">
            <table id="table-onprocess" class="table table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Nama Part</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th >Kategori</th>
                        <th>Departement</th>
                        <th>Status Pengerjaan</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        
<div id="klik-modal">
<!-- MODAL EDIT -->
<div class="modal" id="modal-jadwal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
     <form action="<?= base_url() . 'admin/response/addJadwal'?>" method="POST" >
     <input type="hidden" id="id_order" name="id_order">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Scheduling</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group" >
                    <input type="text" id="jadwal" name="daterange" value="" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-alt-success" id="btn_submit">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<!-- END MODAL EDIT -->
            
        </div>
    </div>
                   
</div>


