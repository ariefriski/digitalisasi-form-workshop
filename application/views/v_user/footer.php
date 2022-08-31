            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        Crafted with <i class="fa fa-heart text-pulse"></i>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->
        <script src="<?=base_url() . 'assets/js/codebase.core.min.js'?>"></script>

        <!-- Codebase JS-->
        <script src="<?=base_url() . 'assets/js/codebase.app.min.js'?>"></script>

        <!-- Page JS Plugins -->
        <script src="<?=base_url() . 'assets/js/plugins/datatables/jquery.dataTables.min.js'?>"></script>
        <script src="<?=base_url() . 'assets/js/plugins/datatables/dataTables.bootstrap4.min.js'?>"></script>
        <script src="<?=base_url() .'assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js'?>"></script>
        <!-- Page JS Code -->
        <script src="<?=base_url() . 'assets/js/pages/be_tables_datatables.min.js'?>"></script>

        <!-- LOAD JS TO SETTING DATATABLE WHOLE PAGE IN ROLE ADMIN -->
        <script>
            $(document).on('click','#reject',function(){
                $("#reason1").empty().append (`
                <div class="form-group row" id="reason">
                <label class="col-12" for="example-textarea-input">*Masukan Alasan Reject</label>
                    <div class="col-12">
                        <textarea class="form-control" id="alasan" name="alasan" rows="6" placeholder="Alasan..."></textarea>
                    </div>
                </div>
                `);
            });


            $(document).on('click','#accept',function(){
                $("#reason").remove(); 
            });
            $(document).on('click','#subcount',function(){
                $("#plan2").remove(); 
                

            
                
            });

            // $(document).on('click','#r_block',function(){
            //     alert("adada");
            // });


            // if($('#r_block').is(':checked')){
            //     alert("ADADA");
            // }
            $('#rawradio').click(function(){
             if (($('#r_block').is(':checked'))||($('#r_fabrikasi').is(':checked'))) {
                $("#dimensi").empty().append(`
                <div class="form-group row" id="dimensi2">
                    <label class="col-12" for="example-text-input">Dimensi Produk</label>
                    <br><br>
                    <div class="col-md-2">P
                        <input type="number" class="form-control" id="panjang" name="panjang" placeholder="mm">
                    </div>
                    <div class="col-md-2">L
                        <input type="number" class="form-control" id="lebar" name="lebar" placeholder="mm">
                    </div>
                    <div class="col-md-2">Diamter/Tebal
                        <input type="number" class="form-control" id="diameter" name="diameter" placeholder="mm">
                    </div>
                </div>
                `);
             }else if (($('#r_cylinder').is(':checked'))){
                $("#dimensi").empty().append(`
                <div class="form-group row" id="dimensi2">
                    <label class="col-12" for="example-text-input">Dimensi Produk</label>
                    <br><br>
                    <div class="col-md-2">P
                        <input type="number" class="form-control" id="panjang" name="panjang" placeholder="mm">
                    </div>
                    <div class="col-md-2">L
                        <input type="text" class="form-control" id="lebar" name="lebar" value="0" readonly>
                    </div>
                    <div class="col-md-2">Diamter/Tebal
                        <input type="number" class="form-control" id="diameter" name="diameter" placeholder="mm">
                    </div>
                </div>
                `);
             }
            });
            $(document).on('click','#cancel_raw',function(){
                $("#dimensi2").remove();
                $("input[type=radio][name=raw_type]").prop('checked', false);
            })

            

var table;

$(document).ready(function() {

    // DATATABLE DASHBOARD
table = $('#table-dashboard').DataTable({ 

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    "language": {
        "infoFiltered": ""
    },

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('user/dashboard/order_list')?>",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
        // "defaultContent": "-",
        // "targets": "_all"
    },
    ],
  });
});

var table2;

$(document).ready(function() {

    // DATATABLE DASHBOARD
table2 = $('#table-response').DataTable({ 

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    "language": {
        "infoFiltered": ""
    },

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('user/response/order_list')?>",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
        // "defaultContent": "-",
        // "targets": "_all"
    },
    ],
  });
});

var table3;

$(document).ready(function() {

    // DATATABLE DASHBOARD
table2 = $('#table-onprocess').DataTable({ 

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    "language": {
        "infoFiltered": ""
    },

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('user/response/onprocess_list')?>",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
        // "defaultContent": "-",
        // "targets": "_all"
    },
    ],
  });
});


</script>

        
    </body>

</html>