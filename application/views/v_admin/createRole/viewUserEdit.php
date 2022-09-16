<!-- Main Container -->
<main id="main-container">
<!-- Page Content -->
<div class="content">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit User</h3>
        </div>

        <div class="blok-content" style="padding: 30px 30px;">
            <form action="<?= base_url() . 'admin/user/prosesEditUser'?>" method="post">
                <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?=$data[0]["id_user"]?>">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?=$data[0]["name"]?>">
                <br>
                <label for="name">Npk</label>
                <input type="text" class="form-control" id="npk" name="npk" value="<?=$data[0]["npk"]?>">
                <!-- <br>
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?=$data[0]["username"]?>"> -->
                <br>
                <label for="department-name">Level</label>
                <select class="form-control" id="level" name="level">
                    <option value="" disabled>Please select</option>
                    <option value="admin_ws" <?=($data[0]["level"] == "admin_ws") ? "selected" : "";?>>Admin Workshop</option>
                    <option value="kasie_user" <?=($data[0]["level"] == "kasie_user") ? "selected" : "";?>>Kepala Seksi User</option>
                    <option value="kadept_user" <?=($data[0]["level"] =="kadept_user") ? "selected" : "";?>>Kepala Department User</option>
                    <option value="kasie_ws" <?=($data[0]["level"] == "kasie_ws") ? "selected" : "";?>>Kepala Seksi Workshop</option>
                    <option value="user" <?=($data[0]["level"] == "user") ? "selected" : "";?>>User</option>
                    <option value="user_ws" <?=($data[0]["level"] =="user_ws") ? "selected" : "";?>>Operator</option>
                </select>
                <?php
                if ($data[0]["level"]  == 'admin_ws' ||$data[0]["level"] == 'kasie_ws' || $data[0]["level"] == 'kadept_ws' || $data[0]["level"] == 'user_ws') {
                    echo '<div id="department"></div>';
                    echo '<div id="section"></div>';
                } else if ($data[0]["level"] == "kadept_u") {
                    echo '
                    <div id="department">
                        <br>
                        <label for="department-name">Department Name</label>
                        <select class="form-control" id="id_department" name="id_department">
                            <option value="" disabled>Please select</option>';
                                $department = $this->m_user->getNameDepartment();
                                foreach ($department as $dept) {
                                    $selected = ($data[0]["id_department"] == $dept['id_department']) ? "selected" : "";
                                    echo '
                                        <option value="'.$dept['id_department'].'" '.$selected.'>'.$dept['department_name'].'</option>
                                    ';
                                }
                    echo '</select></div>';
                    echo '<div id="section"></div>';
                } else if ($data[0]["level"] == "user" || $data[0]["level"] == "kasie_user") {
                    echo '
                    <div id="department">
                        <br>
                        <label for="department-name">Department Name</label>
                        <select class="form-control" id="id_department" name="id_department">
                            <option value="" disabled>Please select</option>';
                                $department = $this->m_user->getNameDepartment();
                                foreach ($department as $dept) {
                                    $selectedDept = ($data[0]["id_department"] == $dept['id_department']) ? "selected" : "";
                                    echo '
                                        <option value="'.$dept['id_department'].'" '.$selectedDept.'>'.$dept['department_name'].'</option>
                                    ';
                                }
                    echo '</select></div>';
		            $section = $this->m_user->getNameSection($data[0]['id_department']);
                    echo '
                    <div id="section">
                        <br>
                        <label for="id_section">Section</label>
                        <select class="form-control" id="id_section" name="id_section">
                            <option value="" disabled>Please select</option>';
                                foreach ($section as $sect) {
                                    $selectedSect = ($data[0]["id_section"] == $sect['id_section']) ? "selected" : "";
                                    echo '
                                        <option value="'.$sect['id_section'].'" '.$selectedSect.'>'.$sect['section_name'].'</option>
                                    ';
                                }
                    echo '</select></div>';
                }
                ?>
                <div style="text-align: center; margin-top:35px;">
                    <a href="<?=base_url(); ?>super_admin/user/" class="btn btn-secondary">
                        <i class="si si-action-undo"></i>&nbsp;Kembali
                    </a>
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>            
        </div>
    </div>    
</div>
<!-- END Page Content -->
</main>
<!-- END Main Container -->
<script>
    $('#level').on('change', function () {
        var level = this.value;
        console.log(level);

        if (level == 'admin_ws' || level == 'kasie_ws' || level == 'kadept_ws' || level == 'user_ws') {
            $("#department").html(' ');
            $("#section").html(' ');
        } else if (level == 'kadept_u') {
            $("#department").html(' ');
            $("#section").html(' ');
            $("#department").append(`
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
            `);
        } else if (level == 'kasie_user' || level == 'user') {
            $("#department").html(`
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