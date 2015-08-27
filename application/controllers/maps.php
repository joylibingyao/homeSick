<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
		$this->load->model('map');
	}
//view method
	public function index()
	{
		$locations=$this->map->get_all_location();
		$comments=$this->map->get_all_comment();
		$users=$this->map->get_all_users();

		$this->load->view('index.php',array('locations'=>$locations,'comments'=>$comments,'users'=>$users));
	}
	public function get_all_location()
	{
		$locations=$this->map->get_all_location();
		$comments=$this->map->get_all_comment();
		$this->load->view('partial',array('locations'=>$locations,'comments'=>$comments));
		//json_encode($locations);
		//echo json_encode($locations);	

	}

	public function signPage()
	{
		$this->load->view('login');//load register page
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
// functional method
	//public function get
	public function add_comment()
	{
		//$this->session->set_userdata('user_id',);
		$comment=array(
			'comment'=>$this->input->post('comment'),
			'user_id'=>$this->input->post('user_id'),
			'location_id'=>$this->input->post('location_id')
			);
		$this->map->add_comment($comment);
		redirect('/');
	}

	public function login(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|md5");
		if($this->form_validation->run() === FALSE){
			$logerrors = validation_errors();
			$this->session->set_flashdata("logerrors", $logerrors);
			redirect('/maps/signPage');
		}else{
			$password = $this->input->post("password");
			$email = $this->input->post("email");
			$user_info = $this->map->get_user_by_email($email);


			if($user_info['email'] == $email && $user_info['password'] == md5($password)){
				$this->session->set_userdata('user_info', $user_info);
				
				redirect('/');
			


			}else{
				$this->session->set_flashdata('loginfail', '<p>Log in credentials do not match!</p>');
				redirect('/maps/signPage');
			}
		}
	}
	public function getImage($city)
    {
        $city = preg_replace('/\s+/', '', $city);
        $url = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=$city";
        $response = file_get_contents($url);
        $json = json_decode($response,TRUE);
        $re = $json['responseData']['results'][0]['unescapedUrl'];
        
        return $re;
    }
	public function getXY($city)
    {
 	
 		$city = preg_replace('/\s+/', '', $city);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$city";
        $response = file_get_contents($url);
        $json = json_decode($response,TRUE);
        if ($json['status']=='OK') {

        	$name=$json['results'][0]['formatted_address'];
        	$lat=$json['results'][0]['geometry']['location']['lat'];
        	$lng=$json['results'][0]['geometry']['location']['lng'];
        	$array=array('lat'=>$lat,'lng'=>$lng,'name'=>$name);
        	//var_dump($array);
 			return $array;

        }
        elseif ($json['status']!=='OK'){
        	return false;
        }
    }

	public function checkcity(){
		if(null == ($this->input->post('city'))){
			return FALSE;
		}elseif($this->getXY($this->input->post('city')) == FALSE){
			RETURN FALSE;
		}else{
			RETURN TRUE;
		}
	}
	public function register(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "trim|required|matches[confirmpassword]|min_length[8]|md5");
		$this->form_validation->set_rules("confirmpassword", "Confirm Password", "trim|required");
		if($this->form_validation->run() === FALSE)
		{
			$errors = validation_errors();
		    $this->session->set_flashdata("errors", $errors);
		    redirect('/maps/signPage');
		}elseif($this->checkcity() === FALSE){
			$this->session->set_flashdata("citycheck", "Invalid City");
			redirect('/maps/signPage');
		}
		else
		{
		   	$cityInfo=$this->getXY($this->input->post('city'));
		   	$url=$this->getImage($this->input->post('city'));
			$info=array(
					'name'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'password'=>md5($this->input->post('password')),
					'city'=>$cityInfo['name'],
					'lat'=>$cityInfo['lat'],
					'lng'=>$cityInfo['lng'],
					'url'=>$url
					);
			$this->map->add_user($info);
			$user_info = $this->map->get_user_by_email($this->input->post('email'));
			$this->session->set_userdata('user_info', $user_info);
			// var_dump($this->map->get_user_by_email($this->input->post('email')));
			// $this->session->set_userdata('user_id')=$this->map->get_user_by_email($this->input->post('email'))['id'];
			redirect('/');
		}	
	}
	// public function login()
	// {
	// 	$this->load->helper(array('form','url'));
	// 	$this->load->library('form_validation');
	// 	if ($this->input->post('login')) 
	// 	{
	// 		if ($this->form_validation->run('login')) {

	// 			$this->load->model('user');
	// 			$userInfo=$this->user->get_by_email($this->input->post('email'));
	// 			if (!empty($userInfo)) 
	// 			{
	// 				$salt=$userInfo['salt'];
	// 				$match=md5($this->input->post('password').$salt);
	// 				if ($match===$userInfo['password']) 
	// 				{
	// 					$show=array(
	// 						'name'=>$userInfo['name'],
	// 						'email'=>$userInfo['email']
	// 						);
	// 					$this->load->view('welcome',array('show'=>$show));
	// 				}
	// 				else
	// 				{
	// 					redirect('/maps/signPage');
	// 				}
	// 			}else
	// 			{
	// 				$this->form_validation->set_message('wrong', 'Wrong email');
	// 				// var_dump($this->form_validation->message('wrong'));

	// 				$this->session->set_userdata('wrong','Wrong email or password');
	// 				redirect('/maps/signPage');
	// 			}
	// 		}else
	// 		{
	// 			$this->session->set_flashdata('error',validation_errors());
	// 			redirect('/maps/signPage');
	// 		}

	// 	}
	// 	if($this->input->post('register'))
	// 	{

	// 		if ( $this->getXY($this->input->post('city')) ) 
	// 		{
				
	// 			//echo "inside this";
	// 			$cityInfo=$this->getXY($this->input->post('city'));

	// 			$info=array(
	// 				'name'=>$this->input->post('name'),
	// 				'email'=>$this->input->post('email'),
	// 				'password'=>md5($this->input->post('password')),
	// 				'city'=>$cityInfo['name'],
	// 				'lat'=>$cityInfo['lat'],
	// 				'lng'=>$cityInfo['lng'],
	// 				);
	// 			$this->load->model('map');
	// 			//var_dump($info);
	// 			$this->map->add_user($info);//added to db
				



	// 		}
	// 		if ($this->getXY($this->input->post('city'))=="wrong city") {

	// 			$this->session->set_flashdata('wrongCity','Wrong city');
	// 			echo "wrogn city";
	// 			// redirect('/maps/signPage');
	// 		}
	// 		else
	// 		{
	// 			echo "wrong form";
	// 			$this->session->set_flashdata('error',validation_errors());
	// 			//redirect('/maps/signPage');
				
	// 		}
	// 	}
	// }///end of sign in or register

	// public function getXY($city)
 //    {
 	
 // 		$city = preg_replace('/\s+/', '', $city);
 //        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$city";
 //        $response = file_get_contents($url);
 //        $json = json_decode($response,TRUE);
 //        if ($json['status']=='OK') {

 //        	$name=$json['results'][0]['formatted_address'];
 //        	$lat=$json['results'][0]['geometry']['location']['lat'];
 //        	$lng=$json['results'][0]['geometry']['location']['lng'];
 //        	$array=array('lat'=>$lat,'lng'=>$lng,'name'=>$name);

 // 			return $array;

 //        }
 //        else{
 //        	return false;
 //        }
 //    }

}

//end of main controller