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
  </ul>
  <div class="tab_area_wrap">
    <!-- 첫번째 탭 영역 : s -->
    <div class="">
      <label>아이디</label>
      <input type="text" id="member_id" name="member_id" class="mb30">
      <label>비밀번호</label>
      <input type="password" id="member_pw" name="member_pw" class="mb20">

      <div class="mt10 btn_full_weight btn_point">
        <a hhref="javascript:void(0)" onclick="" class="margin_auto trigger">로그인하기</a>
      </div>
      <ul class="login_find_ul row mt20">
        <li>
          <a href="/<?=mapping('find_id')?>">
            아이디 찾기
          </a>
        </li>
        <li>
          <a href="/<?=mapping('find_pw')?>">
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
    <!-- 첫번째 탭 영역 : e -->
    <!-- 두번째 탭 영역 : s -->
    <div class="">
      <label>아이디</label>
      <input type="text" id="member_id" name="member_id" class="mb30">
      <label>비밀번호</label>
      <input type="password" id="member_pw" name="member_pw" class="mb20">

      <div class="mt10 btn_full_weight btn_point">
        <a hhref="javascript:void(0)" onclick="" class="margin_auto trigger">로그인하기</a>
      </div>
      <ul class="login_find_ul row mt20">
        <li>
          <a href="/<?=mapping('find_id')?>">
            아이디 찾기
          </a>
        </li>
        <li>
          <a href="/<?=mapping('find_pw')?>">
            비밀번호 찾기
          </a>
        </li>
      </ul>
    </div>
    <!-- 두번째 탭 영역 : e -->
  </div>

</div>

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
