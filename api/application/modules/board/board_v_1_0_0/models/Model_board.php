<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2020-09-08
| Memo : 게시판
|------------------------------------------------------------------------
*/

class Model_board extends MY_Model{

  //게시판 리스트
  public function board_list($data){

    $page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

    $board_type=$data['board_type'];
    $contents_type=$data['contents_type'];
    $title=$data['title'];

    $sql = "SELECT
              board_idx,
              board_type,
              title,
              board_img,
              contents_type,
              ins_date
    				FROM
    					tbl_board
    				WHERE
    					del_yn = 'N'
              AND display_yn = 'Y'
    ";

    if($board_type !=""){
			$sql .=" AND board_type ='$board_type' ";
		}
    if($title !=""){
			$sql .=" AND title LIKE '%$title%' ";
		}
    if($contents_type !=""){
			$sql .=" AND contents_type ='$contents_type' ";
		}

		$sql.=" ORDER BY board_idx DESC limit ?,?";

    return $this->query_result($sql,
                              array(
                              $page_no,
                              $page_size
                              ),$data
                              );
  }

  //게시판 리스트 총 카운트
  public function board_list_count($data){

    $board_type=$data['board_type'];
    $contents_type=$data['contents_type'];
    $title=$data['title'];

    $sql = "SELECT
              count(*) AS cnt
            FROM
    					tbl_board
    				WHERE
    					del_yn = 'N'
              AND display_yn = 'Y'
            ";

    if($board_type !=""){
			$sql .=" AND board_type ='$board_type' ";
		}
    if($title !=""){
			$sql .=" AND title LIKE '%$title%' ";
		}
    if($contents_type !=""){
			$sql .=" AND contents_type ='$contents_type' ";
		}

    return $this->query_cnt($sql,array());
  }


  public function board_detail($data){
    $board_idx=$data['board_idx'];

    $sql = "SELECT
              board_idx,
              title,
              contents,
              board_img,
              ins_date,
              board_type,
              contents_type
						FROM
							tbl_board
						WHERE
							board_idx=?
    ";

    return $this->query_row($sql,
														array(
														$board_idx
														),
														$data
														);
  }


  public function main_contents_detail($data){

    $board_type=$data['board_type'];

    $sql = "SELECT
              board_idx,
              title,
              board_img,
              ins_date,
              board_type,
              contents_type
						FROM
							tbl_board
						WHERE
							board_type=?
    ";

    return $this->query_row($sql,
														array(
														$board_type
														),
														$data
														);
  }

}
?>
