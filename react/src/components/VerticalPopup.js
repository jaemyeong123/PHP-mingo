import React from 'react';

/* 로그인 */
.login_logo{width: 125px;margin: 10px auto 40px auto;display: block;}
.login_wrap{transition: 0.3s ease-out;border-radius: 40px 40px 0px 0px;background: #FAFAFA;position: fixed; bottom:-400px; z-index: 300; left:0;width:100%; padding: 30px 40px; box-sizing: border-box; margin: 0 auto;}
.modal_login .md_close{position: absolute;z-index: 1; top:20px;right:20px;width: 24px;height: 24px;}
.login_wrap ul{margin-top: 12px;overflow: hidden}
.login_wrap ul li{float: left;margin-right: 20px;position: relative;}
.login_wrap ul li.mr0{margin-right: 0;}
.login_wrap ul li:first-child::after{content: ''; display: block; width: 3px; height: 3px; border-radius: 50%; background: #F8B62B;position: absolute;z-index: 1; right:-12px;top:7px;}
.login_wrap ul li.point{float: right;color:#399D26;font-family: 'NanumSquareRoundB'}



class VerticalPopup extends Component{
  constructor() {

  }


  return (
    <div>
      <div class="login_wrap modal_login">
        <img src="/images/head_btn_close.png" alt="닫기" onclick="modal_close_login('login')" class="md_close"/>
        <img src="/images/logo.png" alt="망고하다" class="login_logo"/>
        <input type="text" autocomplete="off" id="member_id" name="member_id" class="login_id" placeholder="아이디"/>
        <input type="password" autocomplete="off" id="member_pw" name="member_pw" class="login_pw mt12" placeholder="비밀번호"/>
        <div class="btn_point btn_full_weight mt30">
          <a href="javascript:void(0)" onClick="login_action_member();">로그인</a>
        </div>
        <ul>
          <li>
            <a href="">아이디 찾기</a>
          </li>
          <li class="mr0">
            <a href="">비밀번호 찾기</a>
          </li>
          <li class="point mr0">
            <a href="">회원가입</a>
          </li>
        </ul>
      </div>
      <div class="md_overlay md_overlay_login" onclick="modal_close_login('login')"></div>
    </div>


  );
}

export default VerticalPopup;
