<!-- Main Container -->
<main id="main-container">
<!-- Page Content -->
<div class="content">
    <div class="block">
    <div class="block-header block-header-default">
            <h3 class="block-title">List Department</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <button type="button" class="btn btn-primary min-width-125" data-toggle="modal" data-target="#modal-normal">
                        <i class="fa fa-plus"></i>&nbsp; Add Department
                    </button>
                </div>
            </div>
        </div>
        <!-- Add Department Modal -->
        <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url() . 'admin/department/addDepartment'?>" method="POST" enctype="multipart/form-data">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Add Department</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <label for="department-name">Department Name</label>
                                    <input type="text" class="form-control" id="department-name" name="department-name" placeholder="Masukan Nama Departemen..">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-alt-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Normal Modal -->

        <div class="block-content">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 100px;">#</th>
                        <th>Nama Department</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                    $no =1;
                    foreach($data as $department) {
                        echo '
                            <tbody id="show_data">
                                <tr>
                                    <td>
                                        '.$no.'
                                    </td>
                                    <td>'.$department['department_name'].'</td>
                                    <td>
                                        <a href="#modalEditDepartment" class=" btn btn-sm btn-secondary item_edit" data-toggle="modal" data-id="'.$department['id_department'].'" data-name="'.$department['department_name'].'">
                                            <i class="fa fa-pencil"></i>
                                        </a>                                        
                                        <a id="id-delete" name="delete" href="'.base_url() . 'admin/department/deleteDepartment?id_department='.$department['id_department'].'" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        ';
                        $no++;
                    }
                ?>
            </table>

            <!-- Edit Department Modal -->
            <div class="modal" id="modalEditDepartment" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url() . 'admin/department/editDepartment'?>" method="POST" enctype="multipart/form-data">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Edit Department</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                            <i class="si si-close"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="department-id-edit" name="department-id-edit" placeholder="Masukan Nama Departemen..">
                                        <label for="department-name">Department Name</label>
                                        <input type="text" class="form-control" id="department-name-edit" name="department-name-edit" placeholder="Masukan Nama Departemen..">
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-alt-success">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Edit Department Modal -->
    </div>
    </div>
    
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".item_edit", function () {
            var id_department = $(this).data('id');
            var department_name = $(this).data('name');
            $("#department-id-edit").val( id_department );
            $("#department-name-edit").val( department_name );
        });
    });
</script>