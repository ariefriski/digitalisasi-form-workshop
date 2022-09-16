<!-- Main Container -->
<main id="main-container">
<!-- Page Content -->
<div class="content">
    <div class="block">
    <div class="block-header block-header-default">
            <h3 class="block-title">List Section</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <button type="button" class="btn btn-primary min-width-125" data-toggle="modal" data-target="#modal-normal">
                        <i class="fa fa-plus"></i>&nbsp; Add Section
                    </button>
                </div>
            </div>
        </div>
        <!-- Add Checksheet Modal -->
        <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url() . 'admin/section/addSection'?>" method="POST" enctype="multipart/form-data">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Add Section</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <label for="section-name">Section Name</label>
                                    <input type="text" class="form-control" id="section-name" name="section-name" placeholder="Masukan Nama Seksi..">
                                    <br>
                                    <label for="department-name">Department Name</label>
                                    <select class="form-control" id="id_department" name="id_department">
                                        <option value="" selected disabled>Please select</option>
                                        <?php 
                                            $department = $this->m_user->getNameDepartment();
                                            foreach ($department as $dept) {
                                                echo '
                                                    <option value="'.$dept['id_department'].'">'.$dept['department_name'].'</option>
                                                ';
                                            }
                                        ?>
                                    </select>
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
                        <th>Nama Section</th> 
                        <th>Departemen</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                    $no =1;
                    foreach($data as $section) {
                        echo '
                            <tbody id="show_data">
                                <tr>
                                    <td>
                                        '.$no.'
                                    </td>
                                    <td>'.$section['section_name'].'</td>
                                    <td>'.$section['department_name'].'</td>
                                    <td>
                                        <a href="#modalEditSection" class=" btn btn-sm btn-secondary item_edit" data-toggle="modal" data-id="'.$section['id_section'].'" data-name="'.$section['section_name'].'" data-department="'.$section['id_department'].'">
                                            <i class="fa fa-pencil"></i>
                                        </a>                                        
                                        <a id="id-delete" name="delete" href="'.base_url() . 'admin/section/deleteSection?id_section='.$section['id_section'].'" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete">
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

            <!-- Add Edit Section Modal -->
            <div class="modal" id="modalEditSection" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url() . 'admin/section/editSection'?>" method="POST" enctype="multipart/form-data">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Edit Section</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                            <i class="si si-close"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="section-id-edit" name="section-id-edit" placeholder="Masukan Nama Departemen..">
                                        <label for="section-name">Section Name</label>
                                        <input type="text" class="form-control" id="section-name-edit" name="section-name-edit" placeholder="Masukan Nama Departemen..">
                                        <br>
                                        <label for="department-name">Department Name</label>
                                        <select class="form-control" id="id_department_edit" name="id_department_edit">
                                            <option value="" selected disabled>Please select</option>
                                            <?php 
                                                $department = $this->m_user->getNameDepartment();
                                                foreach ($department as $dept) {
                                                    echo '
                                                        <option value="'.$dept['id_department'].'">'.$dept['department_name'].'</option>
                                                    ';
                                                }
                                            ?>
                                        </select>
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
            <!-- END Edit Section Modal -->
    </div>
    </div>
    
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".item_edit", function () {
            var id_section = $(this).data('id');
            var section_name = $(this).data('name');
            var id_department = $(this).data('department');
            $("#section-id-edit").val( id_section );
            $("#section-name-edit").val( section_name );
            $("#id_department_edit").val( id_department );
        });
    });
</script>