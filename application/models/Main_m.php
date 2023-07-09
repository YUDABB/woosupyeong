<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_m extends CI_Model
{

	function get_list($table, $type='', $offset='', $limit='', $search_word='')
	{
		$sword='';
		if ($search_word != ''){
// 검색어가 있을 경우의 처리
			$sword = ' WHERE subject_name like "%'.$search_word.'%" or professor_name like "%'.$search_word.'%"';
		}

		$limit_query = '';
		if ( $limit != '' OR $offset != '' )
		{
//페이징이 있을 경우의 처리
			$limit_query = ' LIMIT '.$offset.', '.$limit;
		}

		$sql = "SELECT * FROM ".$table.$sword." ORDER BY sub_id DESC".$limit_query;
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

    function get_list2($number, $type='', $offset='', $limit='')
    {
        $limit_query = '';
        if ( $limit != '' OR $offset != '' )
        {
//페이징이 있을 경우의 처리
            $limit_query = ' LIMIT '.$offset.', '.$limit;
        }

        $sql = "SELECT * FROM evaluation WHERE sub_id=" .$number. " ORDER BY id DESC".$limit_query;
        $query = $this->db->query($sql);
        if ( $type == 'count' )
        {
//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
            $result = $query->num_rows();
        }
        else
        {
//게시물 리스트 반환
            $result = $query->result();
        }
        return $result;
    }

    function get_view($table, $id)
    {

        $sql = "SELECT * FROM " .$table. " WHERE sub_id='" .$id. "'";
        $query = $this->db->query($sql);

        $result = $query->row();
        return $result;
    }

    function get_evaluation($id)
    {

        $sql = "SELECT * FROM evaluation WHERE sub_id='" .$id. "' ORDER BY id DESC";
        $query = $this->db->query($sql);

        $result = $query->result();
        return $result;
    }

    function insert_board($arrays)
    {
        $insert_array = array(
            'uid' => $arrays['uid'],
            'e_name' => $arrays['e_name'],
            'sub_id' => $arrays['sub_id'],
            'dedate' => $arrays['dedate'],
            'group_task' => $arrays['group_task'],
            'announcement' => $arrays['announcement'],
            'report' => $arrays['report'],
            'exploration' => $arrays['exploration'],
            'exam' => $arrays['exam'],
            'pf' => $arrays['pf'],
            'onli' => $arrays['onli'],
            'blen' => $arrays['blen'],
            'cap' => $arrays['cap'],
            'scope' => $arrays['scope'],
            'content' => $arrays['content'],
            'e_date' => date("Y-m-d H:i:s")
        );
        $result = $this->db->insert('evaluation', $insert_array);
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

        return $result;
    }

    function delete_content($table, $no)
    {
        $delete_array = array(
            'b_id' => $no
        );
        $result = $this->db->delete($table, $delete_array);

        return $result;
    }
}
