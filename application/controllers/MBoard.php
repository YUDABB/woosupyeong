<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MBoard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('MBoard_m');
		$this->load->helper(array('url', 'date'));
	}

	public function index()
	{
		$this->lists();
	}

	public function _remap($method) // 함수 요청을 재매핑
	{
		$this->load->view('header_v');
		if (method_exists($this, $method)) {
			$this->{"{$method}"}();
		}
		$this->load->view('footer_v');
	}


	public function lists()
	{

		$search_word = $page_url = '';
		$uri_segment = 5;
//$this->output->enable_profiler(TRUE);
//검색어 초기화

//주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());
		if( in_array('q', $uri_array) ) {
//주소에 검색어가 있을 경우의 처리. 즉 검색시
				$search_word = urldecode($this->url_explode($uri_array, 'q'));
//페이지네이션용 주소
				$page_url = '/q/'.$search_word;
				$uri_segment = 7;
			}

//페이지네이션 라이브러리 로딩 추가
        $this->load->library('pagination');
//페이지네이션 설정
        $config['base_url'] = base_url('/capp/index.php/board/lists/m_board/').$page_url.'/page/'; //페이징 주소
        $config['total_rows'] = $this->MBoard_m->get_list($this->uri->segment(3, 'm_board'), 'count', '', '', $search_word); //게시물의 전체 갯수
        $config['per_page'] = 15; //한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        $config['first_url'] = base_url('/capp/index.php/board/lists/m_board/').$page_url.'/page/1'; //처음으로 url 설정
        $config['first_link'] = '<<'; //처음으로 텍스트
        $config['last_link'] = '>>'; //끝으로 텍스트
        $config['prev_link'] = FALSE; //이전으로 링크 설정
        $config['next_link'] = FALSE; //다음으로 링크 설정
        $config['cur_tag_open'] = '<b class="w3-button  w3-round w3-blue">'; //현재 페이지 링크 설정
        $config['cur_tag_close'] = '</b>';
        $config['attributes'] = array('class' => 'w3-button w3-round w3-margin-top w3-margin-bottom'); //모든 페이지 링크 설정
		//원하는 설정값을 선언하고 페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination'] = $this->pagination->create_links();
		/*$page = $this->uri->segment(5, 1); // 5번째 세그먼트가 없으면, $page=1이 됨 */
		$page = $this->uri->segment($uri_segment, 1);
		if ( $page > 1 )
		{
		$start = (($page/$config['per_page'])) * $config['per_page'];
		}
		else
		{
		$start = ($page-1) * $config['per_page'];
		}
		$limit = $config['per_page'];

		/* 목록보기 */
		/* $data['list'] = $this->Board_m->get_list($this->uri->segment(3), '', $start, $limit); */
		                                           /* ci_board */
		$data['list'] = $this->MBoard_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
		$this->load->view('mboard/list_v', $data);
	}


    // 보기 기능 추가
	function view()
	{
 $this->load->helper('alert');

        if($this->session-> userdata('user') == TRUE) {
            $this->load->model('Board_m');

            $this->load->library('form_validation');
            $this->form_validation->set_rules('c_contents', '댓글', 'required');

            if ($this->form_validation->run() == TRUE) {

                if (!$this->input->post('c_contents', TRUE)) {
                    alert("비정상적인 접근입니다. ", base_url('/capp/index.php/mboard/view/') . $this->uri->segment(3));
                    exit;
                }

                $udata = $this->session->userdata('user');
                $b_uid = $udata->uid;
                $b_name = $udata->name;
                $write_data = array(
                    "table" => $this->input->post('table', TRUE),
                    'uid' => $b_uid,
                    'b_id' => $this->uri->segment(4),
                    'c_name' => $b_name,
                    'c_contents' => $this->input->post('c_contents', TRUE),
                );
                $result = $this->MBoard_m->insert_comment($write_data);
                if ($result) // 모델에서 INSERT가 성공하면 TRUE가 반환됨
                {
                    //글 작성 성공시 게시판 목록으로
                    alert('입력되었습니다.', base_url('/capp/index.php/mboard/view/') . $this->uri->segment(3)."/".$this->uri->segment(4));
                    exit;
                } else {
                    //글 실패 시 게시판 목록으로
                    alert('다시 입력해 주세요.', base_url('/capp/index.php/mboard/view/') . $this->uri->segment(3));
                    exit;
                }
            }
        } else {
            alert('로그인 후 작성하세요', '/capp/index.php/user/');


        }


        $data['views'] = $this->MBoard_m->get_view($this->uri->segment(3), $this->uri->segment(4));
        $data['comment_list'] = $this ->MBoard_m ->get_comment($this->uri->segment(4));



        $this->load->view('mboard/view_v', $data);	}

	/* 게시물 쓰기*/
	function write()
	{
		echo '<meta charset= utf-8 />';
		$this->load->helper('alert');
		if($this->session-> userdata('user') == TRUE) {
			// 폼검증 라이브러리 로드
			$this->load->library('form_validation');
// 폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('m_title', '제목', 'required');
			$this->form_validation->set_rules('m_contents', '내용', 'required');
			/*if( $_POST)*/ // 글쓰기 폼에 글 내용을 작성하고 전송 버튼을 눌렀을 때 처리. 글쓰기 POST 전송 시
			if ($this->form_validation->run() == TRUE) {// 글쓰기 폼에 글 내용을 작성하고 전송 버튼을 눌렀을 때 처리. 글쓰기 POST 전송 시
// 경고장 헬퍼 로딩. 코드에서 alert() 함수를 사용하기 위해 헬퍼를 선언
				$this->load->helper('alert');
				//주소중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());
				if (in_array('page', $uri_array)) // 주소 중에 ‘page’ 세그먼트가 있으면 그 값을 $page 변수에 할당.
				{
					$pages = urldecode($this->url_explode($uri_array, 'page'));
				} else // 그렇지 않으면 1을 할당
				{
					$pages = 1;
				}
				if (!$this->input->post('m_title', TRUE) and !$this->input->post('m_contents', TRUE)) {
// 글 제목과 내용이 없을 경우, 프로그램 단에서 한번 더 체크
					alert("비정상적인 접근입니다. ", base_url('/capp/index.php/mboard/lists/') . $this->uri->segment(3));
					exit;
				}
                //var_dump($_POST);
                $udata = $this->session->userdata('user');
                $m_uid = $udata->uid;
                $m_name = $udata->name;
                $write_data = array( //DB에 넣을 값을 배열로 저장 ( DB필드명 => 넣을 값 )
                    'table' => $this->uri->segment(3), //게시판 테이블명
                    'uid' => $m_uid,
                    'm_name' => $m_name,
					'm_title' => $this->input->post('m_title', TRUE),
					'm_contents' => $this->input->post('m_contents', TRUE),
				);
				$result = $this->MBoard_m->insert_board($write_data); // board_m 모델의 insert_board()함수에 위에서 만든 배열을 전달하여
// 데이터베이스에 입력하고 그 결과를 돌려받음.
				if ($result) // 모델에서 INSERT가 성공하면 TRUE가 반환됨
				{
//글 작성 성공시 게시판 목록으로
					alert('입력되었습니다.', base_url('/capp/index.php/mboard/lists/') . $this->uri->segment(3));
					exit;
				} else {
					//글 실패 시 게시판 목록으로
					alert('다시 입력해 주세요.', base_url('/capp/index.php/mboard/lists/') . $this->uri->segment(3));
					exit;
				}
			} else {
				//글쓰기 버튼을 눌렀을 때 쓰기폼 view 호출
				$this->load->view('mboard/write_v');
			}
		}
		else{
				alert('로그인 후 작성하세요', '/capp/index.php/user/');
			}
	}
/* 게시물 수정 */
	function modify()
	{
		echo '<meta charset=utf-8" />';
		if ($_POST)
		{
//경고창 헬퍼 로딩
			$this->load->helper('alert');
			//주소중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
			$uri_array = $this->segment_explode($this->uri->uri_string());

			if( in_array('page', $uri_array) )
			{
				$pages = urldecode($this->url_explode($uri_array, 'page'));
			}
			else
			{
				$pages = 1;
			}

			if ( !$this->input->post('m_title', TRUE) AND !$this->input->post('m_contents', TRUE) )
			{
//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
				alert('비정상적인 접근입니다.', base_url('/capp/index.php/mboard/lists/').$this->uri->segment(3));
exit;
}
//var_dump($_POST);
			$modify_data = array(
				'table' => $this->uri->segment(3), //게시판 테이블명
				'm_id' => $this->uri->segment(4), //게시물번호
				'm_title' => $this->input->post('m_title', TRUE),
				'm_contents' => $this->input->post('m_contents', TRUE)
			);
			$result = $this->MBoard_m->modify_board($modify_data);
			if ( $result )
			{ //글 작성 성공시 게시판 목록으로
				alert('수정되었습니다.', base_url('/capp/index.php/mboard/lists/').$this->uri->segment(3));
				exit;
				}
	else { //글 수정 실패시 글 내용으로
		alert('다시 수정해 주세요.', base_url('/capp/index.php/mboard/view/'.$this->uri->segment(3).$this->uri->segment(4)));
		exit;
		}
		}
		else
		{
//게시물 내용 가져오기
			$data['views'] = $this->MBoard_m->get_view($this->uri->segment(3), $this->uri->segment(4));
//쓰기폼 view 호출
			$this->load->view('mboard/modify_v', $data);
		}
	}

/** 게시물 삭제 */
	function delete()
	{
		echo '<meta charset=utf-8" />';
//경고창 헬퍼 로딩
		$this->load->helper('alert');
//게시물 번호에 해당하는 게시물 삭제
		$return = $this->MBoard_m->delete_content($this->uri->segment(3), $this->uri->segment(4));
//게시물 목록으로 돌아가기
		if ( $return )
		{
//삭제가 성공한 경우
			alert('삭제되었습니다.', base_url('/capp/index.php/mboard/lists/').$this->uri->segment(3));
}
else {
//삭제가 실패한 경우
alert('삭제 실패하였습니다.', base_url('/capp/index.php/mboard/view/').$this->uri->segment(3).$this->uri->segment(4));
}
	}



	/** url중 키값을 구분하여 값을 가져오도록.
	 * @param Array $url : segment_explode한 url값
	 * @param String $key : 가져오려는 값의 key
	 * @return String $url[$k] : 리턴값 */
	function url_explode($url, $key)
	{
		$cnt = count($url);
		for($i=0; $cnt>$i; $i++ )
		{
			if($url[$i] == $key)
			{
				$k = $i+1;
				return $url[$k];
			}
		}
	}
	/*HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꾸어 리턴한다.
	* @param string 대상이 되는 문자열
	* @return string[] */
	function segment_explode($seg)
	{
//세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
		$len = strlen($seg);
		if(substr($seg, 0, 1) == '/')
		{
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
		if(substr($seg, -1) == '/')
		{
			$seg = substr($seg, 0, $len-1);
		}
		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}


}
