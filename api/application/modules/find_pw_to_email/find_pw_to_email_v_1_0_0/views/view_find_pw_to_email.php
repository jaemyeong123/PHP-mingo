<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <!-- Favicon -->
    <link rel="shortcut icon" href="#">
    <title><?=SERVICE_NAME?></title>
    <style>
    </style>
  </head>
  <body style="width:100%; margin: 0 auto;">
    <div style="min-width:600px; overflow: hidden; width:100%; margin: 0 auto; padding: 20px 20px 100px 20px;box-sizing: border-box;background-color: #F9F9F9;">
      <div style="max-width:560px;width:600px; margin:0 auto;">
        <header>
          <img src="http://pw.ourdong.com/images/logo_mail.png" alt="우리동네" style="width:170px; margin-top:60px;">
        </header>
        <p style="font-size:26px; font-weight: bold; font-weight:bold;margin:70px 0 30px 0;">우리동네에서 비밀번호 재설정 안내</p>
        <div style="background:#fff; border-radius: 10px; padding:40px; box-sizing:border-box;">
          <p style="color:#333; font-size:15px; line-height:26px;margin:0;padding:0">
            <?=$data['member_name']?>님, 안녕하세요.<br>
            비밀번호 재설정 안내 메일입니다.<br><br>
            비밀번호 변경을 원하신다면,<br>
            하단 버튼을 클릭 후 비밀번호를 재설정해주세요!<br>
            만약 비밀번호 재설정을 요청하지 않으셨다면,<br>
            해당 메일을 무시해주셔도 좋습니다.<br><br>
            하단에 비밀번호 재설정 하기 버튼을 클릭하여<br>
            비밀번호를 변경하기 전에는<br>
            계정의 비밀번호는 변경되지 않습니다.</p>
          <div style="text-align:center;margin: 0 auto; width:260px; margin-top:40px;">
            <a href="http://pw.ourdong.com/find_pw_to_email/member_pw_change_key_check?p_code=<?=$data['change_pw_key']?>" style="font-size:15px; font-weight: bold;padding: 13px; text-decoration: none; display: block; background:#002554;border-radius:10px; color:#fff; text-align:center;">비밀번호 재설정하기</a>
          </div>
        </div>
      </div>
    </div>
    <div style="background:#eee; height:auto; width:100%;min-width:600px; overflow: hidden; ">
      <div style="min-width:600px; width:600px; overflow: hidden; margin:0 auto; padding:30px 0; box-sizing:border-box;">
        <p style="font-size:14px; color:#666; line-height:24px; margin:0; padding:0 20px; box-sizing:border-box;">우리동네를 이용해주시는 고객님께 감사드립니다.<br>
          본 메일은 발신 전용으로 회신되지 않습니다.<br>궁금하신 사항이 있으신 경우에는 아래 고객센터로 문의해 주세요.<br><br>
          고객센터<br>
          070-8624-0122<br>
          오전 8시 ~ 오후 8시 (점심: 오후 12시~오후 1시) 주말, 공휴일 휴무<br>
          이메일 : contact@finaltor.com<br>
          우리동네 ㅣ 대표이사 : 김홍범 ㅣ 주소 : 서울특별시 영등포구 국제금융로 6길 33, 919호<br>
          대표전화 : [00-0000-0000]<br>
          사업자등록번호 : 642-81-01758 ㅣ 통신판매업 신고 : 2020-서울영등포-2263<br>
          개인정보관리책임자 : 조현준 (chohj0108@finaltor.com)
        </p>
        <p style="color:#999;font-size:14px;margin-top:30px;margin-block-end:0; padding:0 20px; box-sizing:border-box;">Finaltor Co., Ltd. 2020 by Finaltor Inc All Rights Reserved</p>
      </div>
    </div>
  </body>
</html>
