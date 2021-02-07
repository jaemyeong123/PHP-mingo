<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
</header>
<!-- header : e -->
<div class="inner_wrap">
  <h2 class="mt50">공지사항</h2>
  <div class="notice_title"><?=$result->title?></div>
  <div class="notice_date"><?=$result->ins_date?></div>
</div>
  <? if (!empty($result->img)) {?>
    <img src="<?=$result->img?>" class="img_block">
  <? }?>

<div class="inner_wrap">
  <p class="notice_content">
    <?=nl2br($result->contents)?>
  </p>
</div>
