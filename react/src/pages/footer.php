
		<!-- footer : s -->
    <footer>
      <ul>
        <li class="<?php if($this->uri->segment(1)==null || $this->uri->segment(1)==mapping("main")) echo "active";?>"><a href="/<?=mapping('main')?>">
          <span><img src="/images/menu_1.png"></span>홈</a></li>
        <li class="<?php if($this->uri->segment(1)==mapping("content")) echo "active";?>"><a href="/<?=mapping('content')?>">
          <span><img src="/images/menu_2.png"></span>컨텐츠</a></li>
        <li class="<?php if($this->uri->segment(1)==mapping("my_will")) echo "active";?>"><a href="/<?=mapping('my_will')?>">
          <span><img src="/images/menu_3.png"></span>내 유언</a></li>
        <li class="<?php if($this->uri->segment(1)==mapping("expert")) echo "active";?>"><a href="/<?=mapping('expert')?>">
          <span><img src="/images/menu_4.png"></span>전문가</a></li>
        <li class="<?php if($this->uri->segment(1)==mapping("mypage")) echo "active";?>"><a href="/<?=mapping('mypage')?>">
          <span><img src="/images/menu_5.png"></span>더보기</a></li>
      </ul>
    </footer>
    <!-- footer : e -->

  </div>
  <!-- wrap : e -->
  <script type="text/javascript">
  function modal_open_login(e){
    $(".md_overlay_" + 'login').css("visibility", "visible").animate({opacity: 1}, 100);
    $(".modal_" + 'login').css({bottom: "0"});
    $.lockBody();
  }

  function modal_close_login(e){
    $(".md_overlay_" + 'login').css("visibility", "hidden").animate({opacity: 0}, 100);
    $(".modal_" + 'login').css({bottom: "-400px"});
    $.unlockBody();
  }
  </script>
</body>
</html>
