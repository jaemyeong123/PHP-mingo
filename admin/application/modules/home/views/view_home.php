<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:side_nav_toggle()"><img class="w100" src="/images/head_btn_menu.png" alt="뒤로가기"></a>
  <h2 class="head_title">밍고 초기 진입 화면!!</h2>
</header>
<!-- header : e -->


<div class="test_wrap" style="margin-top:100px;">
	<!-- <p id="test">테스트!!</p> -->
	<div id="like_button_container"></div>
	<img src="/images/user_default.png" alt="">
  <a href="javascript:void(0)" onclick="play_audio()">플레이</a>

  <audio></audio>
  <audio src='/audio/normal.mp3'id="normal">


</div>
<script type="text/javascript">

var audio_normal = document.getElementById('normal');
function play_audio(){
  audio_normal.play();
}





</script>

<script type="text/babel" src="/reactjs/like_button.js" ></script>
