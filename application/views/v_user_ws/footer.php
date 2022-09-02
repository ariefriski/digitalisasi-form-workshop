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
            var table;

            $(document).ready(function() {

                // DATATABLE DASHBOARD
                table = $('#table-dashboard').DataTable({
                    "scrollX": true,
                    "ordering": false,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    "language": {
                        "infoFiltered": ""
                    },

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('user_ws/dashboard/order_list')?>",
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


        </script>

        
    </body>

</html>