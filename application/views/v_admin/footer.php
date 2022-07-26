<footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                        Crafted with d <i class="fa fa-heart text-pulse"></i>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://1.envato.market/95j" target="_blank">Codebase 3.0</a> &copy; <span class="js-year-copy">2022</span>
                    </div>
                </div>
</footer>
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
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="<?=base_url() . 'assets/js/pages/momentjs-business.js'?>"></script>
        <!-- EXPORT -->
   
        
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
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
var table;

    $(document).ready(function() {

        // DATATABLE DASHBOARD
        table = $('#table-dashboard').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
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
            "language": {
                "infoFiltered": ""
            },
            "searching" : false,
            dom: 'Bfrtip',
            buttons: [
                'excel'
             ],  
            
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

var table10;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table10 = $('#table-input-order-actual').DataTable({ 
        "scrollX": true,
        "ordering":false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "language": {
            "infoFiltered": ""
        },
        "searching" : false,
        dom: 'Bfrtip',
        buttons: [
            'excel'
            ],  
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/dashboard/inputListActual')?>",
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
        dom: 'Bfrtip',
            buttons: [
                'excel'
             ],  

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
        dom: 'Bfrtip',
            buttons: [
                'excel'
             ],  

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

var table8;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table8 = $('#table-finish').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/response/finish_list')?>",
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

var table9;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table8 = $('#table-working').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/response/working_list')?>",
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

var table11;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table11 = $('#table-wait').DataTable({ 
        
        "ordering":false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "language": {
            "infoFiltered": ""
        },
        "searching" : false,

        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/response/waiting_working')?>",
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



$(function() {
    $('input[name="daterange"]').daterangepicker({
                    opens: 'left',
                    isInvalidDate: function(date) {
                    if (date.day()>=1 && date.day()<=5 )
                    return false;
                    return true;
                }
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
    $('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
                $('input[name="daterange"]').daterangepicker({
                opens: 'left'
                }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            }
            else if($(this).is(":not(:checked)")){
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left',
                    isInvalidDate: function(date) {
                    if (date.day()>=1 && date.day()<=5 )
                    return false;
                    return true;
                }
                }, function(start, end, label) {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
            }
        });

});

// $(function() {
  
// });

// $('#weekend').click(function(){
//         $("#jadwal2").removeAttr('hidden');
//         $("#jadwal").attr("hidden",true);
//   });

// $(document).ready(function(){
//         $('input[type="checkbox"]').click(function(){
//             if($(this).is(":checked")){
//                 $("#jadwal2").removeAttr('hidden');
//                 $("#jadwal").attr("hidden",true);
//             }
//             else if($(this).is(":not(:checked)")){
//                 $("#jadwal2").attr('hidden',true);
//                 $("#jadwal").removeAttr('hidden');
//             }
//         });
//     });

var table13;

$(document).ready(function() {

    // DATATABLE DASHBOARD
    table13 = $('#table-ditolak').DataTable({ 
        

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "language": {
            "infoFiltered": ""
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/dashboard/ditolak')?>",
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




function pagereload(){
location.reload();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click', '.id-jadwal', function() {
    var id_order = $(this).data('id');
    $("#id_order").val(id_order);
});
});
</script>
        
</body>


    
</html>

