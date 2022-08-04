<?php
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');    
    }
    
    // Showing  Login page here 
    function index()
    {
        $this->load->view('login'); 
    }


    /**
    * check the username and the password with the database
    * @return void
    */
    function validate()
    {  
        $username = $this->input->post('login-username');
        $password = $this->input->post('login-password');
        // $hash_password = password_hash($password,PASSWORD_DEFAULT);
        $is_valid = $this->m_login->validate($username, $password);

        if($is_valid)/*If valid username and password set */
        {
            $get_id = $this->m_login->get_id($username, $password);                
                
            foreach($get_id as $val)
            {            
                // $id_order = $val->id_order;                                                           
                $name = $val->name;                  
                $password = $val->password;                 
                $level=$val->level;
                $id_user = $val->id_user;
                $id_department = $val->id_department;
                $npk = $val->npk;
                $department_name = $val->department_name;

                if($level=='user')
                {
                    $data = array(
                        'user_name' =>$name, 
                        'user_password' => $password,
                        'level'=>$level,
                        'user_is_logged_in' => true,
                        'id_user' => $id_user,
                        'id_department' =>$id_department,
                        'npk' =>$npk,
                        'department_name' =>$department_name
                    );
                    
                    $this->session->set_userdata($data); /*Here  setting the user datas in session */
                    redirect(base_url('user/dashboard/'));
                }

                if($level=='kadept')
                {
                    $data = array(
                        'kadept_name' =>$name, 
                        'kadept_password' => $password,
                        'level'=>$level,
                        'kadept_is_logged_in' => true,
                        'id_user' => $id_user,
                        'id_department' => $id_department
                        );
                    
                    $this->session->set_userdata($data); /*Here  setting the Admin datas in session */
                    redirect(base_url('kadept/dashboard/'));
                }

                if($level=='admin')
                {
                    $data = array( 
                        'admin_name'=>$name,
                        'admin_password'=>$password,
                        'level'=>$level,
                        'admin_is_logged_in'=>true,
                        'id_user' => $id_user,
                        'id_department' => $id_department,
                        // 'id_order' => $id_order
                    );
                    $this->session->set_userdata($data); /*Here  setting the User datas in session */
                    redirect('admin/dashboard');
                }
            }       
        }
        else // incorrect username or password
        {
            $this->session->set_flashdata('msg1', 'Username or Password Incorrect!');
            redirect('login');
        } 
    }

    public function kadept_logout()
    {
        $array_items = array(
			'kadept_name', 
			'kadept_password', 
			'level',
			'kadept_is_logged_in',
		);

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'Kadept Signed Out Now!');
        redirect('login');
    }

    public function admin_logout()
    {
        $array_items = array(
			'admin_name', 
			'admin_password', 
			'level',
			'admin_is_logged_in',
		);

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'Admin Signed Out Now!');
        redirect('login');
    }

    public function user_logout()
    {
        $array_items = array(   
		    'user_name',
            'user_password' ,
            'level',
            'user_is_logged_in'
        );

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'user Signed Out Now!');
        redirect('login');       
    }
}
?>