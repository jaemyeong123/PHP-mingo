import React, { Component } from 'react';
import '../css/style.css'

class VerticalPopup extends Component{

  // function modal_open(element){
  //   $(".md_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 100);
  //   $(".modal_" + element).css({display: "block"});
  // }
  //
  // function modal_close(element){
  //   $(".md_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 100);
  //   $(".modal_" + element).css({display: "none"});
  // }

  // function modal_open_login(e){
  //   $(".md_overlay_" + 'login').css("visibility", "visible").animate({opacity: 1}, 100);
  //   $(".modal_" + 'login').css({bottom: "0"});
  //   $.lockBody();
  // }
  //
  // function modal_close_login(e){
  //   $(".md_overlay_" + 'login').css("visibility", "hidden").animate({opacity: 0}, 100);
  //   $(".modal_" + 'login').css({bottom: "-400px"});
  //   $.unlockBody();
  // }

  constructor(props) {
    super(props);

  }

  modal_open_login2 = () => {
    this.setState({
      modal_show:"show"
    })
  }

  modal_close_login2 = () => {
    console.log("123123");
    this.setState({
      modal_show:"hide1"
    })

  }


  render() {

    const modal_close_login2 = this.modal_close_login2

    const modal_show = this.props.modal_show
    const modal_close_login = this.props.modal_close_login

    return (
      <div>
        <div className={`login_wrap modal_login ${modal_show==="show"? "show":"hide"}`} >
          <img src="/images/head_btn_close.png" alt="닫기" onClick={()=>modal_close_login2()} className="md_close"/>
          <img src="/images/logo.png" alt="망고하다" className="login_logo"/>
          <input type="text"  id="member_id" name="member_id" className="login_id" placeholder="아이디"/>
          <input type="password"  id="member_pw" name="member_pw" className="login_pw mt12" placeholder="비밀번호"/>
          <div className="btn_point btn_full_weight mt30">
            <a href="#" >로그인</a>
          </div>
          <ul>
            <li>
              <a href="">아이디 찾기</a>
            </li>
            <li className="mr0">
              <a href="">비밀번호 찾기</a>
            </li>
            <li className="point mr0">
              <a href="">회원가입</a>
            </li>
          </ul>
        </div>
        <div className="md_overlay md_overlay_login" onClick={()=>modal_close_login2()}></div>
      </div>
    );
  }


}

export default VerticalPopup;
