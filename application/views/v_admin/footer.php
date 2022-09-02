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
            // $(document).on('click','#outhouse',function(){
            //     $("#plan2").remove(); 
                

            
                
            // });

            // $(document).on('click','#r_block',function(){
            //     alert("adada");
            // });


            // if($('#r_block').is(':checked')){
            //     alert("ADADA");
            // }
            $('#rawradio').click(function(){
             if (($('#r_block').is(':checked'))||($('#r_cylinder').is(':checked'))||($('#r_fabrikasi').is(':checked'))) {
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
                                            <div class="col-md-2">Diameter/Tebal
                                                <input type="number" class="form-control" id="diameter" name="diameter" placeholder="mm">
                                            </div>
                </div>
                `);
             }
            });
            

            $(document).on('click','#cancel_raw',function(){
                $("#dimensi2").remove();
                $("input[type=radio][name=raw_type]").prop('checked', false);
            });

            // $(document).on('checked','#routing1',function(){
            //     $("#hour1").empty().append(`
            //     <input type="text" class="form-control"  name="hour_1" placeholder="0">
            //     `);
            // })

         
            
           

        
           
        
            

var table;

    $(document).ready(function() {

        // DATATABLE DASHBOARD
        table = $('#table-dashboard').DataTable({ 
            "scrollY": 200,
           "scrollX": true,

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "language": {
                "infoFiltered": ""
            },

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/dashboard/order_list')?>",
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
        table2 = $('#table-routing').DataTable({ 
            "scrollY": 200,
            "scrollX": true,

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "language": {
                "infoFiltered": ""
            },
            "ordering": false,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/dashboard/routingList')?>",
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
        table2 = $('#table-input-order').DataTable({ 
            "scrollX": true,
            "ordering":false,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "language": {
                "infoFiltered": ""
            },
            "searching" : false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/dashboard/inputList')?>",
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
    table3 = $('#table-edit-proses').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/edit/editProsesTable')?>",
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

var table4;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table4 = $('#table-edit-material').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/edit/editMaterialTable')?>",
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

var table5;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table5 = $('#table-response').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/response/order_list')?>",
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

var table6;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table6 = $('#table-route').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/response/order_list_route')?>",
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


var table7;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table7 = $('#table-onprocess').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/response/process_list_route')?>",
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

