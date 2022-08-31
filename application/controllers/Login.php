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
                $id_section = $val->id_section;

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
                        'department_name' =>$department_name,
                        'id_section'=>$id_section
                    );
                    
                    $this->session->set_userdata($data); /*Here  setting the user datas in session */
                    redirect(base_url('user/dashboard/'));
                }

                if($level=='kasie_user')
                {
                    $data = array(
                        'kasie_user_name' =>$name, 
                        'kasie_user_password' => $password,
                        'level'=>$level,
                        'kasie_user_is_logged_in' => true,
                        'id_user' => $id_user,
                        'id_department' => $id_department,
                        'id_section'=>$id_section
                        );
                    
                    $this->session->set_userdata($data); /*Here  setting the Admin datas in session */
                    redirect(base_url('kasie_user/dashboard/')); // ganti
                }


                if($level=='kadept_user')
                {
                    $data = array(
                        'kadept_user_name' =>$name, 
                        'kadept_user_password' => $password,
                        'level'=>$level,
                        'kadept_user_is_logged_in' => true,
                        'id_user' => $id_user,
                        'id_department' => $id_department,
                        
                        );
                    
                    $this->session->set_userdata($data); /*Here  setting the Admin datas in session */
                    redirect(base_url('kadept_user/dashboard/'));//ganti
                }

                if($level=='admin_ws')
                {
                    $data = array(
                        'admin_ws_name' =>$name, 
                        'admin_ws_password' => $password,
                        'level'=>$level,
                        'admin_ws_is_logged_in'=>true,
                        
                        );
                    
                    $this->session->set_userdata($data); /*Here  setting the Admin datas in session */
                    redirect(base_url('admin/dashboard/'));//ganti
                }

                if($level=='kasie_ws')
                {
                    $data = array(
                        'kasie_ws_name' =>$name, 
                        'kasie_ws_password' => $password,
                        'level'=>$level,
                        'kasie_ws_is_logged_in' => true,
                        'id_user' => $id_user
                        
                        );
                    
                    $this->session->set_userdata($data); /*Here  setting the Admin datas in session */
                    redirect(base_url('kasie_ws/dashboard/'));//ganti
                }

                if($level=='kadept_ws')
                {
                    $data = array(
                        'kadept_ws_name' =>$name, 
                        'kadept_ws_password' => $password,
                        'level'=>$level,
                        'kadept_ws_is_logged_in' => true,
                        'id_user' => $id_user
                        );
                    
                    $this->session->set_userdata($data); /*Here  setting the Admin datas in session */
                    redirect(base_url('kadept_ws/dashboard/'));//ganti
                }
            }       
        }
        else // incorrect username or password
        {
            $this->session->set_flashdata('msg1', 'Username or Password Incorrect!');
            redirect('login');
        } 
    }

    public function kasie_user_logout()
    {
        $array_items = array(
			'kasie_user_name', 
			'kasie_user_password', 
			'level',
			'kasie_user_is_logged_in',
		);

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'Kasie User Signed Out Now!');
        redirect('login');
    }

    public function kadept_user_logout()
    {
        $array_items = array(
			'kadept_user_name', 
			'kadept_user_password', 
			'level',
			'kadept_user_is_logged_in',
		);

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'Kadept User Signed Out Now!');
        redirect('login');
    }

    public function admin_ws_logout()
    {
        $array_items = array(
			'admin_ws_name', 
			'admin_ws_password', 
			'level',
			'admin_ws_is_logged_in',
		);

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'Admin ws Signed Out Now!');
        redirect('login');
    }

    public function kasie_ws_logout()
    {
        $array_items = array(
			'kasie_ws_name', 
			'kasie_ws_password', 
			'level',
			'kasie_ws_is_logged_in',
		);

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'Kasie ws Signed Out Now!');
        redirect('login');
    }

    public function kadept_ws_logout()
    {
        $array_items = array(
			'kadept_ws_name', 
			'kadept_ws_password', 
			'level',
			'kadept_ws_is_logged_in',
		);

        $this->session->unset_userdata($array_items);
        $this->session->set_flashdata('msg', 'Kadept ws Signed Out Now!');
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