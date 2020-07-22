
<?php
//$noticeRow = $_REQUEST['noticeRow'];
?>
<html>
    <head>
        <title>php 게시판</title>
        <style></style>
    </head>
    <body>
        <!-- header 영역 -->
        <div class="header" style="height:200px;border-bottom:1px solid #E6E6E6;"></div>

        <!-- contentss 영역 -->
        <div class="contentss" style="height:800px;width:1600px;">
            <!-- 좌측 contentss -->
            <div class="left-contents" style="float:left;box-sizing:border-box;height:800px;width:400px;">
                <!-- 좌측 conten1t wrapper -->
                <div class="contents-wrapper" style="box-shadow: 5px 15px 30px 0.5px #E6E6E6;margin-left: 20px;margin-top: 50px;box-sizing:border-box;height:400px;width:350;"></div>
            </div>

            <!-- 우측 contentss -->
            <div class="right-contents" style="float:left;box-sizing:border-box;height:800px;width:1200px;">

                <!-- 우측 contents wrapper -->
                <div class="contents-wrapper" style="box-shadow: 5px 15px 30px 0.5px #E6E6E6;margin-left: 25px;box-sizing:border-box;height:600px;width:1100px;">
                    <!-- 리스트 wrapper -->
                    <div class="contents-list" style="margin-left: 50px;margin-top: 50px;box-sizing:border-box;height:600px;width:1000px;">

                        <!-- 게시판 이름 -->
                        <div style="font-size:1.7em;font-weight:bold;line-height:100px;height:100px;width:1000px;margin-bottom: 10px;box-sizing:border-box;border-bottom:2px solid #E6E6E6;">자유게시판</div>

                        <!-- 리스트 제목 -->
                        <div style="height:100px;width:1000px;margin-bottom: 10px;box-sizing:border-box;border-bottom:1px solid #E6E6E6;">
                            <div style="height:60px;width:500px;font-weight:bold;line-height:60px;font-size:1.3em;"><?=$noticeRow->title?></div>
                            <div style="height:30px;width:400px;line-height:30px;font-size:0.7em;">작성일 : <?=$noticeRow->regdate?></div>
                        </div>

                        <!-- 리스트 내용 -->
                        <div style="margin-bottom: 10px;padding:20px; height:300px;width:1000px;font-size:1.3em;box-sizing:border-box;border-bottom:1px solid #E6E6E6;"><?=$noticeRow->contents?></div>
                        <div OnClick="location.href ='http://localhost/index.php/noticeController/noticeDelete?notice_idx=<?=$noticeRow->notice_idx?>'" style="float:right;margin-right: 10px;text-align:center; line-height:45px; font-size:1.0em;border-radius:5px;width:100px;height:45px;background-color:#0B3861;color:#FFFFFF;">삭제</div>
                        <div OnClick="location.href ='http://localhost/index.php/noticeController/noticeModifyForm?notice_idx=<?=$noticeRow->notice_idx?>'" style="float:right;margin-right: 10px;text-align:center; line-height:45px; font-size:1.0em;border-radius:5px;width:100px;height:45px;background-color:#0B3861;color:#FFFFFF;">수정</div>
                        <div OnClick="location.href ='http://localhost/index.php/noticeController/baordGetList'" style="float:right;margin-right: 10px; text-align:center; line-height:45px; font-size:1.0em; border-radius:5px;width:100px;height:45px;background-color:#0B3861;color:#FFFFFF;">목록보기</div>

                    </div>
                </div>
            </div>
        </div>

        <!-- footer 영역 -->
        <div class="footer" style="height:300px;background-color:#585858;"></div>

    </body>
</html>
