<!DOCTYPE html>
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
                <!-- 좌측 contents wrapper -->
                <div class="contents-wrapper" style="box-shadow: 5px 15px 30px 0.5px #E6E6E6;margin-left: 20px;margin-top: 50px;box-sizing:border-box;height:400px;width:350px;"></div>
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
                        <div style="font-weight:bold;line-height:60px;text-align:center;height:70px;width:1000px;margin-bottom: 10px;box-sizing:border-box;border-bottom:1px solid #E6E6E6;">
                            <div style="height:60px;width:100px;float:left;font-size:1.3em;">번호</div>
                            <div style="height:60px;width:500px;float:left;font-size:1.3em;">제목</div>
                            <div style="height:60px;width:400px;float:left;font-size:1.3em;">등록일</div>
                        </div>

                        <!-- 리스트 내용 -->
                        <div style="margin-bottom: 10px;height:auto;overflow: hidden;width:1000px;box-sizing:border-box;border-bottom:1px solid #E6E6E6;">
          							<?php foreach ($noticeList as $row) {?>
          								<div OnClick="location.href ='http://admin.mingo.pe.kr/notice/noticeDetail?notice_idx=<?=$row['notice_idx']?>'" style="text-align:center;line-height:60px;height:60px;width:100px;float:left;font-size:1.3em;"><?=$row['notice_idx']?></div>
          								<div OnClick="location.href ='http://admin.mingo.pe.kr/notice/noticeDetail?notice_idx=<?=$row['notice_idx']?>'" style="text-align:center;line-height:60px;height:60px;width:500px;float:left;font-size:1.3em;"><?=$row['title']?></div>
          								<div OnClick="location.href ='http://admin.mingo.pe.kr/notice/noticeDetail?notice_idx=<?=$row['notice_idx']?>'" style="text-align:center;line-height:60px;height:60px;width:400px;float:left;font-size:1.3em;"><?=$row['ins_date']?></div>
          							<?php } ?>
                        </div>

                        <!-- 글쓰기 버튼 -->
                        <div OnClick="location.href ='http://admin.mingo.pe.kr/notice/noticeWriteForm'" style="float:right;margin-right: 10px; text-align:center; line-height:45px; font-size:1.0em; border-radius:5px;width:100px;height:45px;background-color:#0B3861;color:#FFFFFF;">글쓰기</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer 영역 -->
        <div class="footer" style="height:300px;background-color:#585858;"></div>

    </body>
</html>
