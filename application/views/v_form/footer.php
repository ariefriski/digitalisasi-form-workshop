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

        <!-- Page JS Code -->
        <script src="<?=base_url() . 'assets/js/pages/be_tables_datatables.min.js'?>"></script>

        <!-- LOAD JS TO SETTING DATATABLE WHOLE PAGE IN ROLE ADMIN --><script>
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
                                            <div class="col-md-2">T
                                                <input type="number" class="form-control" id="tinggi" name="tinggi" placeholder="mm">
                                            </div>
                </div>
                `);
             }
            });
            $(document).on('click','#cancel_raw',function(){
                $("#dimensi2").remove();
            })

            $(document).on('click',"#inhouse",function(){
                $("#plan1").empty().append(`
                <div id="plan2">
                                        <div class="form-group row" id="plan">
                                            
                                            <label class="col-12" for="routing_plan">Routing Plan</label>
                                            <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_1" name="routing_item_1">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_2" name="routing_item_2">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_3" name="routing_item_3">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_4" name="routing_item_4">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_5" name="routing_item_5">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                                <select class="form-control" id="routing_plan_6" name="routing_item_6">
                                                    <option value="0">Please select</option>
                                                    <option value="CNC">CNC</option>
                                                    <option value="MILLING">Milling</option>
                                                    <option value="GRINDING">Grinding</option>
                                                    <option value="BUBUT">Bubut</option>
                                                    <option value="MANUAL_DRILL">Manual Drill</option>
                                                    <option value="SAW">SAW</option>
                                                    <option value="WELDING">Welding</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                            <input type="text" class="form-control" id="example-text-input" name="example-text-input" placeholder="0">
                                            </div>
                                        </div>
                                        </div>
                `);
            });

            
</script>

        
    </body>

</html>