<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board_m extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	function get_list($table, $type='', $offset='', $limit='', $search_word='')
	{
		$sword='';
		if ($search_word != ''){
// 검색어가 있을 경우의 처리
			$sword = ' WHERE b_title like "%'.$search_word.'%" or b_contents like "%'.$search_word.'%"';
		}

		$limit_query = '';
		if ( $limit != '' OR $offset != '' )
		{
//페이징이 있을 경우의 처리
			$limit_query = ' LIMIT '.$offset.', '.$limit;
		}

		$sql = "SELECT * FROM ".$table.$sword." ORDER BY b_id DESC".$limit_query;
		$query = $this->db->query($sql);
		if ( $type == 'count' )
		{
//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
			$result = $query->num_rows();
//$this->db->count_all($table);
		}
		else
		{
//게시물 리스트 반환
			$result = $query->result();
		}
		return $result;
	}


	/*
	* 게시물 상세보기 가져오기
	* @param string $table 게시판 테이블
	* @param string $id 게시물번호
	* @return array
	*/

	function get_view($table, $id)
	{
		//조회수 증가
		$sql0 = "UPDATE " .$table. " SET b_views=b_views+1 WHERE b_id='" .$id. "'";
		$this->db->query($sql0);

		$sql = "SELECT * FROM " .$table. " WHERE b_id='" .$id. "'";
		$query = $this->db->query($sql);

		//게시물 내용 반환
		$result = $query->row(); // 한 개의 결과물만 가져옴
								// mysqli_fetch_rows()와 동일한 실행결과
		return $result;
	}

	/* 게시물 입력
	* @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	* @return boolean 입력 성공여부
	*/
	function insert_board($arrays)
	{
		$insert_array = array(
			//'b_id' => 0, //원글이라 0을 입력, 댓글일 경우 원글번호 입력
            'uid' => $arrays['uid'], // 로그인처리한 후에는 로그인한 아이디
			//'user_name' => '관리자',
            'b_name' => $arrays['b_name'],
			'b_title' => $arrays['b_title'],
			'b_contents' => $arrays['b_contents'],
			'b_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert($arrays['table'], $insert_array);
// INSERT INTO $arrays['table'] (board_pid, user_id, user_name, subject, contents, reg_date)
// VALUES (0, 'advisor', '관리자', $arrays['subject'], $arrays['contents'], date("Y-m-d H:i:s")
// 참고: http://www.ciboard.co.kr/user_guide/kr/database/query_builder.html#inserting-data
//결과 반환
		return $result;
	}

	function modify_board($arrays)
	{
		$modify_array = array(
			'b_title' => $arrays['b_title'],
			'b_contents' => $arrays['b_contents']
		);
		$where = array(
			'b_id' => $arrays['b_id']
		);
		$result = $this->db->update($arrays['table'], $modify_array, $where);
// UPDATE $arrays[‘table’] SET subject = $arrays[‘subject’], contents = $arrays[‘content’]
// WHERE id = $id
// 참고: http://www.ciboard.co.kr/user_guide/kr/database/query_builder.html#inserting-data
//결과 반환
		return $result;
	}

	/**게시물 삭제
	 * @param string $table 테이블명
	 * @param string $no 게시물번호
	 * @return boolean 삭제 성공여부
	 */
	function delete_content($table, $no)
	{
		$delete_array = array(
			'b_id' => $no
		);
		$result = $this->db->delete($table, $delete_array);
// DELETE FROM $table
// WHERE board_id = $no
// 참고: http://www.ciboard.co.kr/user_guide/kr/database/query_builder.html#inserting-data
//결과 반환
		return $result;
	}

	function writer_check(){
		$table = $this->uri->segment(3);
		$b_id = $this->uri->segment(5);
		$sql = "SELECT uid FROM " .$table." WHERE b_id = '".$b_id."'";
		$query = $this->db->query($sql);

		return $query->row();
	}

	private function hash_password($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function registerUser($arrays)
	{
		$data = array(
			'id' => $arrays['id'],
			'name' => $arrays['name'],
			'email' => $arrays['email'],
			'password' => $this->hash_password($arrays['password']),
		);
		return $this->db->insert('users', $data);
	}

	public function login($arrays)
	{
		$query = $this->db->get_where('users', array('id' => $arrays['id'])) -> row();
		return $query;
	}
function insert_comment($arrays) {

        $udata = $this->session->userdata('user');
        $uid = $udata->uid;
        $c_name = $udata->name;

        $insert_array = array(
            'uid' => $uid,
            'c_name' => $c_name,
            'b_id' => $this->uri->segment(4),
            'c_contents' => $arrays['c_contents'],
            'c_date' => date('Y-m-d H:i:s')
        );

        $result = $this -> db -> insert('comment', $insert_array);

        return $result;

    }

    function get_comment($id) {
        $sql = "SELECT * FROM comment  WHERE b_id = '".$id."' ORDER BY c_id DESC";
        $query = $this -> db -> query($sql);
        $result = $query->result();
        return $result;
    }

}
