<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Main_m');
		$this->load->helper(array('url', 'date'));
	}

	public function index()
	{
		$this->lists();
	}

	public function _remap($method)
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
		$config['base_url'] = base_url('/capp/index.php/main/lists/professor/').$page_url.'/page/'; //페이징 주소
		$config['total_rows'] = $this->Main_m->get_list($this->uri->segment(3, 'professor'), 'count', '', '', $search_word); //게시물의 전체 갯수
		$config['per_page'] = 12; //한 페이지에 표시할 게시물 수
		$config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        $config['first_url'] = base_url('/capp/index.php/main/lists/professor/').$page_url.'/page/1'; //처음으로 url 설정
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

		$data['list'] = $this->Main_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
		$this->load->view('main/main_v', $data);
	}

    function view()
    {
        $uri_segment = 6;

        $this->load->library('pagination');
        $config['base_url'] = base_url('/capp/index.php/main/view/professor/').$this->uri->segment(4).'/page/'; //페이징 주소
        $config['total_rows'] = $this->Main_m->get_list2($this->uri->segment(4), 'count', '', ''); //게시물의 전체 갯수
        $config['per_page'] = 5; //한 페이지에 표시할 게시물 수
        $config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트
        $config['first_url'] = base_url('/capp/index.php/main/view/professor/').$this->uri->segment(4).'/page/1'; //처음으로 url 설정
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
        $data['pagination2'] = $this->pagination->create_links();
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

        echo '<meta charset= utf-8 />';
        $data['view'] = $this->Main_m->get_view($this->uri->segment(3), $this->uri->segment(4));
        $data['evaluation'] = $this->Main_m->get_evaluation($this->uri->segment(4));

        $this->load->view('main/view_v', $data);
    }

    function write()
    {
        echo '<meta charset= utf-8 />';

        $this->load->helper('alert');
        if($this->session-> userdata('user') == TRUE) {
            // 폼검증 라이브러리 로드
            $this->load->library('form_validation');
// 폼 검증할 필드와 규칙 사전 정의
            $this->form_validation->set_rules('content', '내용', 'required');
            $this->form_validation->set_rules('rating', '별점', 'required');
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
                if (!$this->input->post('content', TRUE) and !$this->input->post('rating', TRUE)) {
// 글 제목과 내용이 없을 경우, 프로그램 단에서 한번 더 체크
                    alert("비정상적인 접근입니다. ", base_url('/capp/index.php/main/view/') . $this->uri->segment(3) . '/' . $this->uri->segment(4));
                    exit;
                }
                //var_dump($_POST);
                $udata = $this->session->userdata('user');
                $b_uid = $udata->uid;
                $e_name = $udata->name;
                if(isset($_POST['dedate'])){ $dedate = 1; }
                else{ $dedate = 0; }
                if(isset($_POST['group_task'])){ $group_task = 1; }
                else{ $group_task = 0; }
                if(isset($_POST['announcement'])){ $announcement = 1; }
                else{ $announcement = 0; }
                if(isset($_POST['report'])){ $report = 1; }
                else{ $report = 0; }
                if(isset($_POST['exploration'])){ $exploration = 1; }
                else{ $exploration = 0; }
                if(isset($_POST['exam'])){ $exam = 1; }
                else{ $exam = 0; }
                if(isset($_POST['pf'])){ $pf = 1; }
                else{ $pf = 0; }
                if(isset($_POST['onli'])){ $onli = 1; }
                else{ $onli = 0; }
                if(isset($_POST['blen'])){ $blen = 1; }
                else{ $blen = 0; }
                if(isset($_POST['cap'])){ $cap = 1; }
                else{ $cap = 0; }
                $write_data = array( //DB에 넣을 값을 배열로 저장 ( DB필드명 => 넣을 값 )
                    'table' => $this->uri->segment(3), //게시판 테이블명
                    'uid' => $b_uid,
                    'e_name' => $e_name,
                    'sub_id' => $this->uri->segment(4),
                    'dedate' => $dedate,
                    'group_task' => $group_task,
                    'announcement' => $announcement,
                    'report' => $report,
                    'exploration' => $exploration,
                    'exam' => $exam,
                    'pf' => $pf,
                    'onli' => $onli,
                    'blen' => $blen,
                    'cap' => $cap,
                    'scope' => $this->input->post('rating'),
                    'content' => $this->input->post('content', TRUE),
                );
                $result = $this->Main_m->insert_board($write_data); // board_m 모델의 insert_board()함수에 위에서 만든 배열을 전달하여
// 데이터베이스에 입력하고 그 결과를 돌려받음.
                if ($result) // 모델에서 INSERT가 성공하면 TRUE가 반환됨
                {
//글 작성 성공시 게시판 목록으로
                    alert('입력되었습니다.', base_url('/capp/index.php/main/view/') . $this->uri->segment(3) . '/' . $this->uri->segment(4));
                    exit;
                } else {
                    //글 실패 시 게시판 목록으로
                    alert('다시 입력해 주세요.', base_url('/capp/index.php/main/view/') . $this->uri->segment(3) . '/' . $this->uri->segment(4));
                    exit;
                }
            } else {
                //글쓰기 버튼을 눌렀을 때 쓰기폼 view 호출
                $this->load->view('main/write_v');
            }
        }
        else{
            alert('로그인 후 작성하세요', '/capp/index.php/user/');
        }
    }

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

            if ( !$this->input->post('b_title', TRUE) AND !$this->input->post('b_contents', TRUE) )
            {
//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
                alert('비정상적인 접근입니다.', base_url('/capp/index.php/board/lists/').$this->uri->segment(3));
                exit;
            }
//var_dump($_POST);
            $modify_data = array(
                'table' => $this->uri->segment(3), //게시판 테이블명
                'b_id' => $this->uri->segment(4), //게시물번호
                'b_title' => $this->input->post('b_title', TRUE),
                'b_contents' => $this->input->post('b_contents', TRUE)
            );
            $result = $this->Board_m->modify_board($modify_data);
            if ( $result )
            { //글 작성 성공시 게시판 목록으로
                alert('수정되었습니다.', base_url('/capp/index.php/board/lists/').$this->uri->segment(3));
                exit;
            }
            else { //글 수정 실패시 글 내용으로
                alert('다시 수정해 주세요.', base_url('/capp/index.php/board/view/'.$this->uri->segment(3).$this->uri->segment(4)));
                exit;
            }
        }
        else
        {
//게시물 내용 가져오기
            $data['views'] = $this->Board_m->get_view($this->uri->segment(3), $this->uri->segment(4));
//쓰기폼 view 호출
            $this->load->view('board/modify_v', $data);
        }
    }

    /** 게시물 삭제 */
    function delete()
    {
        echo '<meta charset=utf-8" />';
//경고창 헬퍼 로딩
        $this->load->helper('alert');
//게시물 번호에 해당하는 게시물 삭제
        $return = $this->Board_m->delete_content($this->uri->segment(3), $this->uri->segment(4));
//게시물 목록으로 돌아가기
        if ( $return )
        {
//삭제가 성공한 경우
            alert('삭제되었습니다.', base_url('/capp/index.php/board/lists/').$this->uri->segment(3));
        }
        else {
//삭제가 실패한 경우
            alert('삭제 실패하였습니다.', base_url('/capp/index.php/board/view/').$this->uri->segment(3).$this->uri->segment(4));
        }
    }

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

	function segment_explode($seg)
	{
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

    function enrolment(){
        $this->load->view('main/enrolment_v');
    }

    function education(){
        $this->load->view('main/education_v');
    }

}
