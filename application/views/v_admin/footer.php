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
            $(document).on('click','#outhouse',function(){
                $("#plan2").remove(); 
                

            
                
            });

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

         
            
            $(document).on('click',"#inhouse",function(){
                $("#plan1").empty().append(`
                <div id="plan2">
                                        <div class="form-group row" id="plan">
                                            
                                            <label class="col-12" for="routing_plan">Routing Plan</label>
                                            <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" id="routing1" name="inputorder[]" value="1" >
                                                <span class="css-control-indicator"></span> Manual
                                            </label>&#9;
                                            <div class="col-md-2" id="hour1">
                                            <input type="text" class="form-control"  name="hour[]" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="2" >
                                                <span class="css-control-indicator"></span> CNC
                                            </label>&#9;
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour2" name="hour[]" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="3" >
                                                <span class="css-control-indicator"></span> Milling
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour3" name="hour[]" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="4" >
                                                <span class="css-control-indicator"></span> Bubut
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour4" name="hour[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="5" >
                                                <span class="css-control-indicator"></span> Grinding
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour5" name="hour[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="6" >
                                                <span class="css-control-indicator"></span> Saw
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour7" name="hour[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="7" >
                                                <span class="css-control-indicator"></span> Drilling
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour5" name="hour[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="8" >
                                                <span class="css-control-indicator"></span> Man.Machining
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour5" name="hour[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="9" >
                                                <span class="css-control-indicator"></span> Welding
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour5" name="hour[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="css-control css-control-lg css-control-primary css-checkbox css-checkbox-rounded">
                                                <input type="checkbox" class="css-control-input" name="inputorder[]" value="10" >
                                                <span class="css-control-indicator"></span> Man.Fabrikasi
                                            </label>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="hour5" name="hour[]">
                                            </div>
                                        </div>
                                        
                `);
            });

        
           
        
            

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
            
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "language": {
                "infoFiltered": ""
            },

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


</script>

        
    </body>

    
</html>

