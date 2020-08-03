<div class="login_logo">
  <img src="/images/logo.png" alt="리판">
</div>
<div class="form_wrap login">
  <ul class="tab_toggle_menu login_ul">
    <li class="">
      <a href="#">
        공인중개사
      </a>
    </li>
    <li class="active">
      <a href="#">
        펀드매니져
      </a>
    </li>
    <li class="">
      <a href="#">
        투자자
      </a>
    </li>
  </ul>
  <div class="tab_area_wrap">
    <!-- 첫 번째 탭 영역 : s -->
    <div class="">
      <label>아이디</label>
      <input type="text" id="member_id" name="member_id" class="mb30">
      <label>비밀번호</label>
      <input type="password" id="member_pw" name="member_pw" class="mb20">

      <div class="mt10 btn_full_weight btn_point">
        <a href="javascript:void(0)" onClick="login_action_member();" class="margin_auto trigger">로그인하기</a>
      </div>
      <ul class="login_find_ul row mt20">
        <li>
          <a href="/<?=mapping('find_id')?>?type=0">
            아이디 찾기
          </a>
        </li>
        <li>
          <a href="/<?=mapping('find_pw')?>?type=0">
            비밀번호 찾기
          </a>
        </li>
        <li>
          <a href="/<?=mapping('join')?>">
            회원가입
          </a>
        </li>
      </ul>
    </div>
    <!-- 첫 번째 탭 영역 : e -->
    <!-- 두 번째 탭 영역 : s -->
    <div class="">
      <label>아이디</label>
      <input type="text" id="corp_id" name="corp_id" class="mb30">
      <label>비밀번호</label>
      <input type="password" id="corp_pw" name="corp_pw" class="mb20">

      <div class="mt10 btn_full_weight btn_point">
        <a href="javascript:void(0)" onClick="login_action_corp();" class="margin_auto trigger">로그인하기</a>
      </div>
      <ul class="login_find_ul row mt20">
        <li>
          <a href="/<?=mapping('find_id')?>?type=1">
            아이디 찾기
          </a>
        </li>
        <li>
          <a href="/<?=mapping('find_pw')?>?type=1">
            비밀번호 찾기
          </a>
        </li>
      </ul>
    </div>
    <!-- 두 번째 탭 영역 : e -->
    <!-- 세 번째 탭 영역 : s -->
    <div class="">
      <label>아이디</label>
      <input type="text" id="investor_id" name="investor_id" class="mb30">
      <label>비밀번호</label>
      <input type="password" id="investor_pw" name="investor_pw" class="mb20">

      <div class="mt10 btn_full_weight btn_point">
        <a href="javascript:void(0)" onClick="login_action_investor();" class="margin_auto trigger">로그인하기</a>
      </div>

    </div>
    <!-- 세 번째 탭 영역 : e -->
  </div>

</div>

<form id="hidden_form" name="hidden_form"  method="get" >
  <?php
  foreach($_GET as $key => $value){
  if($key !="return_url"){
  ?>
  <input type="hidden" name="<?=$key?>" id="<?=$key?>" value="<?=$value?>">
  <?php }}?>
</form>

<script type="text/javascript">
//  투자자 로그인
function login_action_investor(){

  var form_data = {
    'investor_id' : $('#investor_id').val(),
    'investor_pw' : $('#investor_pw').val()
  };

  $.ajax({
    url      : "/<?=mapping('login')?>/login_action_investor",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      //alert(result);
      if(result.code == '-1'){
      alert(result.code_msg);
      $("#"+result.focus_id).focus();
      return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      } else {
        alert(result.code_msg);
        <?if($return_url !=""){?>
        $("#hidden_form")[0].action="<?=$return_url?>";
        $("#hidden_form")[0].submit();
        <?}else{?>
        location.href ='/<?=mapping('fn_main')?>';
        <?}?>
      }
    }
  });
}



// 펀드매니저 로그인
function login_action_corp(){

  var form_data = {
    'corp_id' : $('#corp_id').val(),
    'corp_pw' : $('#corp_pw').val()
  };

  $.ajax({
    url      : "/<?=mapping('login')?>/login_action_corp",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      //alert(result);
      if(result.code == '-1'){
      alert(result.code_msg);
      $("#"+result.focus_id).focus();
      return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      } else {
        alert(result.code_msg);
        <?if($return_url !=""){?>
        $("#hidden_form")[0].action="<?=$return_url?>";
        $("#hidden_form")[0].submit();
        <?}else{?>
        location.href ='/<?=mapping('fn_main')?>';
        <?}?>
      }
    }
  });
}

// 공인중개사 로그인
function login_action_member(){

  var form_data = {
    'member_id' : $('#member_id').val(),
    'member_pw' : $('#member_pw').val()
  };

  $.ajax({
    url      : "/<?=mapping('login')?>/login_action_member",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      //alert(result);
      if(result.code == '-1'){
      alert(result.code_msg);
      $("#"+result.focus_id).focus();
      return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      } else {
        alert(result.code_msg);
        <?if($return_url !=""){?>
        $("#hidden_form")[0].action="<?=$return_url?>";
        $("#hidden_form")[0].submit();
        <?}else{?>
        location.href ='/<?=mapping('main')?>';
        <?}?>
      }
    }
  });
}
</script>

<script type="text/javascript">

  $(document).ready(function() {
    // 민지:: 탭 메뉴 토글기능
    $(".tab_area_wrap > div").hide();
    $(".tab_area_wrap > div").last().show();
    $(".tab_toggle_menu li").click(function() {
      var list = $(this).index();
      $(".tab_toggle_menu li").removeClass("active");
      $(this).addClass("active");
      $(".tab_area_wrap > div").hide();
      $(".tab_area_wrap > div").eq(list).show();
    });
  });

</script>
