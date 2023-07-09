<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MBoard_m extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	function get_list($table, $type='', $offset='', $limit='', $search_word='')
	{
		$sword='';
		if ($search_word != ''){
			$sword = ' WHERE m_title like "%'.$search_word.'%" or m_contents like "%'.$search_word.'%"';
		}

		$limit_query = '';
		if ( $limit != '' OR $offset != '' )
		{
			$limit_query = ' LIMIT '.$offset.', '.$limit;
		}

		$sql = "SELECT * FROM ".$table.$sword." ORDER BY m_id DESC".$limit_query;
		$query = $this->db->query($sql);
		if ( $type == 'count' )
		{

			$result = $query->num_rows();
		}
		else
		{
			$result = $query->result();
		}
		return $result;
	}


	function get_view($table, $id)
	{
		//조회수 증가
		$sql0 = "UPDATE " .$table. " SET m_views=m_views+1 WHERE m_id='" .$id. "'";
		$this->db->query($sql0);

		$sql = "SELECT * FROM " .$table. " WHERE m_id='" .$id. "'";
		$query = $this->db->query($sql);


		$result = $query->row();
		return $result;
	}

	function insert_board($arrays)
	{
		$insert_array = array(
			//'b_id' => 0, //원글이라 0을 입력, 댓글일 경우 원글번호 입력
			'uid' => $arrays['uid'], // 로그인처리한 후에는 로그인한 아이디
			//'user_name' => '관리자',
            'm_name' => $arrays['m_name'],
			'm_title' => $arrays['m_title'],
			'm_contents' => $arrays['m_contents'],
			'm_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert($arrays['table'], $insert_array);
		return $result;


	}

	function modify_board($arrays)
	{
		$modify_array = array(
			'm_title' => $arrays['m_title'],
			'm_contents' => $arrays['m_contents']
		);
		$where = array(
			'm_id' => $arrays['m_id']
		);
		$result = $this->db->update($arrays['table'], $modify_array, $where);
		return $result;
	}


	function delete_content($table, $no)
	{
		$delete_array = array(
			'm_id' => $no
		);
		$result = $this->db->delete($table, $delete_array);

		return $result;
	}

 function insert_comment($arrays) {

        $udata = $this->session->userdata('user');
        $uid = $udata->uid;
        $c_name = $udata->name;

        $insert_array = array(
            'uid' => $uid,
            'c_name' => $c_name,
            'm_id' => $this->uri->segment(4),
            'c_contents' => $arrays['c_contents'],
            'c_date' => date('Y-m-d H:i:s')
        );

        $result = $this -> db -> insert('mcomment', $insert_array);

        return $result;

    }

    function get_comment($id) {
        $sql = "SELECT * FROM mcomment  WHERE m_id = '".$id."' ORDER BY c_id DESC";
        $query = $this -> db -> query($sql);
        $result = $query->result();
        return $result;
    }

}
