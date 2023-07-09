<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('board_m');
		//csrf 방지
		$this->load->helper('form');
	}

	public function index(){
		$this->load->library('session');

		if($this->session->userdata('user')){
			$this->load->view('board/list_v');
		}
		else{
			$this->load->view('login/login_page');
		}
	}



	public function login(){
		$this->load->library('session');

		$data = $this->board_m->login(array('id'=>$this->input->post('id')));

		$this->load->helper('alert');
		if($this->input->post('id') == $data->id &&
			password_verify($this->input->post('password'),$data->password)){
			$this->session->set_userdata('user', $data);
			alert("로그인 성공. ", base_url('/capp/index.php/main/lists/professor/page/1'));
		}
		else{
			header('location:'.base_url('/capp/index.php/user'));
			$this->session->set_flashdata('error','사용자를 찾을 수 없어욤');
		}
	}


	public function logout(){
		$this->load->library('session');
		$this->load->helper('alert');
		$this->session->unset_userdata('user');
		alert("로그아웃. ", base_url('/capp/index.php/main/lists/professor/page/1'));
	}

	public function regist(){
		echo '<meta charset= utf-8 />';
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name','이름','trim|required|min_length[2]|max_length[30]|callback_name_check');
		$this->form_validation->set_rules('id','아이디','trim|min_length[3]|max_length[30]|callback_id_check');
		$this->form_validation->set_rules('email','이메일','required|valid_email');
		$this->form_validation->set_rules('password','비밀번호','required|min_length[8]');
		$this->form_validation->set_rules('passwordt','비밀번호 확인','required|matches[password]');

		if ($this->form_validation->run() == TRUE) {

			$this->load->helper('alert');
			$regist_data = array(
				'id' =>  $this->input->post('id', TRUE),
				'name' => $this->input->post('name', TRUE),
				'email' => $this->input->post('email',TRUE),
				'password' => $this->input->post('password', TRUE),
			);

			$data = $this->board_m->registerUser($regist_data);
			if ($data) {

				alert('회원가입 성공', base_url('/capp/index.php/user')); # url 경로가 이상하다...
				$this -> load -> helper('url');
				redirect('/');
				exit;
			} else {
				alert('다시 입력해 주세요.', base_url('/capp/index.php/user/regist/'));
				exit;
			}
		}
		else{
			$this->load->view('login/sing_page'); }

	}

	public function	name_check($name) {
		$this->load->database();
		if($name){
			$result = array();
			$sql="SELECT * FROM users WHERE name='".$name."'";
			$query=$this->db->query($sql);
			$result=$query->row();

			if ($result){
				$this->form_validation->set_message('name_check',$name.'은 중복되는 닉네임입니다.');
				return FALSE;
			}
			else{
				return TRUE;}

		}
		else{
			return FALSE;}
	}

	public function	id_check($id) {
		$this->load->database();
		if($id){
			$result = array();
			$sql="SELECT * FROM users WHERE id='".$id."'";
			$query=$this->db->query($sql);
			$result=$query->row();

			if ($result){
				$this->form_validation->set_message('id_check',$id.'은 중복되는 아이디입니다.');
				return FALSE;
			}
			else{
				return TRUE;}

		}
		else{
			return FALSE;}
	}
}

