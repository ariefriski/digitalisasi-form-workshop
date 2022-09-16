<!-- Main Container -->
<main id="main-container">
<!-- Page Content -->
<div class="content">
    <div class="block">
    <div class="block-header block-header-default">
            <h3 class="block-title">List User</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <button type="button" class="btn btn-primary min-width-125" data-toggle="modal" data-target="#modal-normal">
                        <i class="fa fa-plus"></i>&nbsp; Add User
                    </button>
                </div>
            </div>
        </div>
        <!-- Add User Modal -->
        <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="js-validation-bootstrap" action="<?= base_url() . 'admin/user/addUser'?>" method="POST" enctype="multipart/form-data">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title">Add User</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama ..." required>
                                    <br>
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username ..." required>
                                    <br>
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control valid" id="password" name="password" placeholder="Masukan Password ..." aria-describedby="val-password-error" aria-invalid="true" required>                                   
                                    <br>
                                    <label for="npk">NPK</label>
                                    <input type="text" class="form-control" id="npk" name="npk" placeholder="Masukan Nomor NPK  ..." required>
                                    <br>
                                    <label for="department-name">Level</label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="" selected disabled>Please select</option>
                                        <option value="admin_ws">Admin Workshop</option>
                                        <option value="kasie_user">Kepala Seksi User</option>
                                        <option value="kadept_user">Kepala Department Seksi User</option>
                                        <option value="kasie_ws">Kepala Seksi Workshop</option>
                                        <option value="kadept_ws">Kepala Department Workshop</option>
                                        <option value="user">User</option>
                                        <option value="user_ws">Operator</option>
                                    </select>
                                    <br>
                                    <div id="department"></div>
                                    <div id="section"></div>
                                    <script>
                                        $('#level').on('change', function () {
                                            var level = this.value;
                                            console.log(level);

                                            if (level == 'admin_ws' || level == 'kasie_ws' || level == 'kadept_ws' || level == 'user_ws' ) {
                                                $("#department").html(' ');
                                                $("#section").html(' ');
                                            } else if (level == 'kadept_u') {
                                                $("#department").html(' ');
                                                $("#section").html(' ');
                                                $("#department").append(`
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
                                                `);
                                            } else if (level == 'kasie_user' || level == 'user') {
                                                $("#department").html(`
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
                                                `); 
                                                $("#section").html(' ');                                                
                                                $('#id_department').on('change', function () {
                                                    var id_department = this.value;
                                                    console.log(id_department);

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?=base_url(); ?>admin/user/getSection", // Name of the php files
                                                        data:{
                                                            id_department:id_department
                                                        },
                                                        success: function(data)
                                                        {
                                                            $("#section").html(data);
                                                        }
                                                    });
                                                });
                                            } 
                                            
                                        });
                                    </script>
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
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Npk</th>
                        <th>Departemen</th>
                        <th>Section</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                    $no =1;
                    foreach($data as $user) {
                        echo '
                            <tbody id="show_data">
                                <tr>
                                    <td>
                                        '.$no.'
                                    </td>
                                    <td>'.$user['name'].'</td>
                                    <td>'.$user['username'].'</td>
                                    <td>'.$user['npk'].'</td>';
                                    if (!empty($user['department_name'])) {
                                        echo '<td>'.$user['department_name'].'</td>';
                                    } else {
                                        echo '<td>-</td>';
                                    }

                                    if (!empty($user['section_name'])) {
                                        echo '<td>'.$user['section_name'].'</td></td>';
                                    } else {
                                        echo '<td>-</td>';
                                    }
                                                                    
                                    
                                    if ($user['level'] == 'kasie_user') {
                                        echo '<td><span class="badge badge-primary">Head Section</span></td>';
                                    } else if ($user['level'] == 'kadept_user') {
                                        echo '<td><span class="badge badge-success">Head Department</span></td>';
                                    } else if ($user['level'] == 'kasie_ws') {
                                        echo '<td><span class="badge badge-danger">Head Section Workshop</span></td>';
                                    } else if ($user['level'] == 'kadept_ws') {
                                        echo '<td><span class="badge badge-danger">Head Department Workshop</span></td>';
                                    }else if ($user['level'] == 'admin_ws') {
                                        echo '<td><span class="badge badge-info">Admin Workshop</span></td>';
                                    }else if ($user['level'] == 'user_ws') {
                                        echo '<td><span class="badge badge-secondary" >Operator</span></td>';
                                    }
                                     else {
                                        echo '<td><span class="badge badge-secondary">User</span></td>';
                                    }
                                echo '
                                    <td>
                                        <a href="'.base_url() . 'admin/user/editUser?id='.$user['id_user'].'" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#modalEditPasswordUser" class="btn btn-sm btn-secondary item_edit" data-id="'.$user['id_user'].'" data-username="'.$user['username'].'" data-toggle="modal" title="Change Password">
                                            <i class="fa fa-lock"></i>
                                        </a>   
                                        <a id="id-delete" name="delete" href="'.base_url() . 'admin/user/deleteUser?id_user='.$user['id_user'].'" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete">
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

            <!-- Edit User Modal -->
            <div class="modal" id="modalEditPasswordUser" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url() . 'admin/user/editPasswordUser'?>" method="POST" enctype="multipart/form-data">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">Change Password</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                            <i class="si si-close"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="user-id-edit" name="user-id-edit">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username-edit" name="user-name-edit" disabled>
                                        <br>
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control" id="password-edit" name="password-edit" placeholder="Masukan Password Baru ..">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-alt-success">Ok</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Edit User Modal -->
    </div>
    </div>
    
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".item_edit", function () {
            var id_user = $(this).data('id');
            var username = $(this).data('username');
            $("#user-id-edit").val( id_user );
            $("#username-edit").val( username );
        });
    });
</script>