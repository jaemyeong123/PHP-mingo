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
  <body style="margin: 0; padding: 0; background-color: #fafafa;">
    <div style="width: 100%;margin: 0 auto 40px;position: absolute;top: 0;">
      <div style="max-width: 500px;  margin: 50px auto; border-radius: 10px; background-color: #fff; padding: 50px;">
      <!--
  	  <h1 style="text-align: center; margin-bottom: 30px;"><img src="http://api.pitchfit.co.kr/images/logo.png" class="pw_logo" alt="logo" style="width:120px;" /></h1>
      -->
      <h1 style="text-align: center; margin-bottom: 30px;"><?=SERVICE_NAME?></h1>
        <h2 style="text-align: center; margin-bottom: 20px; margin-top: 20px; color:#000">비밀번호 변경</h2>
        <p style="text-align: center; margin: 20px 0; line-height:160%;">
          비밀번호 변경을 위해 아래 링크로 이동해주세요. <br />
        </p>
        <a href="http://www.catchobb.com/find_pw_to_email/member_pw_change_key_check?p_code=<?=$data['change_pw_key']?>" style="background-color: #777; width:300px; margin:40px auto; padding: 15px 20px; display: block; text-align: center; text-decoration: none; color: #fff; font-weight:bold; border-radius:5px;">링크로 이동</a>
      </div>
    </div>
  </body>
  </script>
</html>
