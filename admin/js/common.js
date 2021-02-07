//사이드 네비 토글
function side_nav_toggle(){
  $(".nav, .nav_dim").toggleClass("open");

  if($(".nav").hasClass("open")){

    $.lockBody();
  } else {
    $.unlockBody();
  }
}

// // 전체동의폼 ::민지
// function allCheckFunc( obj ) {
//   $("[name=checkOne]").prop("checked", $(obj).prop("checked") );
// }
//
//   /* 체크박스 체크시 전체선택 체크 여부 */
// function oneCheckFunc( obj ){
//   var allObj = $("[name=checkAll]");
//   var objName = $(obj).attr("name");
//
//   if( $(obj).prop("checked") ){
//     checkBoxLength = $("[name="+ objName +"]").length;
//     checkedLength = $("[name="+ objName +"]:checked").length;
//
//     if( checkBoxLength == checkedLength ) {
//         allObj.prop("checked", true);
//     } else {
//         allObj.prop("checked", false);
//     }
//   }
//   else
//   {
//     allObj.prop("checked", false);
//   }
// }
//
// $(function(){
//   $("[name=checkAll]").click(function(){
//     allCheckFunc( this );
//   });
//   $("[name=checkOne]").each(function(){
//     $(this).click(function(){
//       oneCheckFunc( $(this) );
//     });
//   });
// });
//
// // JavaScript Document
// $(document).ready(function() {
//   //클릭 이벤트
//   $(".img_search").click(function(){
//     $(".search_layer").stop().slideToggle(300);
//     return false;
//   });
//
// });
//

//
// $(document).ready(function() {
//
//   //tab_1-------------------------------------------------------------------------------------
//
//   $(".tab_1 .tab_menu a").click(function(){
//     if($(this).hasClass("active")){
//       return false;
//     }
//
//     $(".tab_1 .tab_menu a").removeClass("active");
//     $(this).addClass("active");
//
//     var tab_num = $(".tab_1 .tab_menu a").index(this); //클릭한 메뉴와 같은 순서의 탭 내용 show
//     $(".tab_1 .tab_content").hide();
//     $(".tab_1 .tab_content").eq(tab_num).fadeIn();
//   });
//   //------------------------------------------------------------------------------------------
//
// });
//
//
// //basic_modal-------------------------------------------------------------------------------------
//
// function modal_open(element){
//   $(".md_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 100);
//   $(".modal_" + element).css({display: "block"});
// }
//
// function modal_close(element){
//   $(".md_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 100);
//   $(".modal_" + element).css({display: "none"});
// }
//
// //------------------------------------------------------------------------------------------
//
//
//
// //모달 백그라운드 스크롤 막기
// var scrollTop;
//
// $.lockBody = function() {
//   if(window.pageYOffset) {
//     scrollTop = window.pageYOffset;
//     $(".wrap").css({
//       top: - (scrollTop)
//     });
//   }
//
//   $('html, body').css({
//     height: "100%",
//     overflow: "hidden"
//   });
// }
//
// $.unlockBody = function() {
//   $('html, body').css({
//     height: "",
//     overflow: ""
//   });
//
//   $(".wrap").css({
//     top: ''
//   });
//
//   window.scrollTo(0, scrollTop);
//   window.setTimeout(function () {
//     scrollTop = null;
//   }, 0);
//
// }
//
// //아코디언
// $(document).on("click",".accordion .trigger",function(){
//   var my_trigger = $(this);
//   var my_panel = $(this).siblings(".panel");
//   var my_list_item = $(this).siblings(".list_item_title");
//
//   var accordion_group = $(this).parents('.accordion'); //해당 아코디언 그룹
//
//   if( my_trigger.hasClass('active') ){  //열려있을 때
//     //해당 슬리아드 비활성화
//     my_panel.stop().slideUp();
//     my_trigger.removeClass('active');
//   } else {  //닫혀있을 때
//     accordion_group.find('.panel').stop().slideUp();
//     accordion_group.find('.trigger').removeClass('active');
//
//
//     //해당 슬라이드 활성화
//     my_panel.stop().slideDown();
//     my_trigger.addClass('active');
//     my_list_item.addClass('active')
//   }
// });
//
//
// //전체선택(함수는 lable에서 지정해야 합니다.)
// function COM_check_box_all_fn(all_clase,select_class){
//   var all_check = $('.'+all_clase); //전체 동의 체크박스
//   var checkbox_num = $('.filter_wrap').find('.'+select_class).length; //체크 항목 개수
//   var checkbox = $('.filter_wrap').find('.'+select_class); //전체동의를 제외한 체크박스
//
//   //전체 동의 체크 했을 때
//   all_check.click(function(){
//     if(all_check.prop("checked") == true){
//       checkbox.prop("checked",true);
//     } else {
//       checkbox.prop("checked",false);
//     }
//   });
//
//   //전체동의 체크 해제 상태에서 모두 체크 되었을때, 전체동의 체크 상태에서 하나라도 해제 했을 때
//   checkbox.click(function(){
//     var checked_num = $("."+select_class+":checked").length; //체크된 박스 개수
//     if(checked_num == checkbox_num){ //모두 체크 되었을 때
//       all_check.prop("checked",true);
//     } else {
//       all_check.prop("checked",false);
//     }
//   });
// }
//
//
//
// //------------------------------------------------------------------------------------------
// //지역코드 세팅------------------------------------------------------------------------------
// var get_area_list = function(area_code,depth,db_val) {
// $.ajax({
//  url: "/p_common/get_area_list",
//  type: 'POST',
//  dataType: 'json',
//  async: true,
//  data: {
//      "area_code" : area_code,
//      "depth" : depth,
//  },
//  success: function(dom){
//
//    var selectStr = "";
//    var sel = "";
//     //select 선택 세팅
//    if(depth=="1"){
//       $('#do_code').html("<option value=''>시/도선택</option>");
//    }
//    if(depth=="2"){
//       $('#si_code').html("<option value=''>구/시선택</option>");
//    }
//    if(depth=="3"){
//       $('#dong_code').html("<option value=''>읍/면/동선택</option>");
//    }
//    if(depth=="4"){
//       $('#ri_code').html("<option value=''>리/선택</option>");
//    }
//    // option vaue 세팅
//    if(dom.length != 0) {
//
//      for(var i = 0; i < dom.length; i ++) {
//       sel ="";
//       if(depth=="1"){
//         if(dom[i].do_code ==db_val){ sel ="selected";}
//       selectStr += "<option value='"+ dom[i].do_code  + "'  "+sel+" >" + dom[i].do + "</option>";
//       }
//       if(depth=="2"){
//         if(dom[i].si_code ==db_val){ sel ="selected";}
//        selectStr += "<option value='"+ dom[i].si_code  + "' "+sel+" >" + dom[i].si + "</option>";
//       }
//       if(depth=="3"){
//         if(dom[i].dong_code ==db_val){ sel ="selected";}
//        selectStr += "<option value='"+ dom[i].dong_code  + "' "+sel+" >" + dom[i].dong + "</option>";
//       }
//       if(depth=="4"){
//         if(dom[i].ri_code ==db_val){ sel ="selected";}
//        selectStr += "<option value='"+ dom[i].ri_code  + "' "+sel+" >" + dom[i].ri + "</option>";
//       }
//
//      }
//      if(depth=="1"){
//         $('#do_code').append(selectStr);
//      }
//      if(depth=="2"){
//         $('#si_code').append(selectStr);
//      }
//      if(depth=="3"){
//         $('#dong_code').append(selectStr);
//      }
//      if(depth=="4"){
//         $('#ri_code').append(selectStr);
//      }
//
//    }
//  }
// });
// }
// //------------------------------------------------------------------------------------------
//
// // 숫자만 입력-------------------------------------------------------------------------------
// // 숫자및 콤마사용(호출 ::onkeyup="return numkey_check(event)")
// function numkey_check(evt) {
// var _pattern = /^(\d{1,10}\)?)?$/;
// var _value = event.srcElement.value;
// if (!_pattern.test(_value)) {
//   alert("숫자만 허용됩니다.");
//   event.srcElement.value = event.srcElement.value.substring(0,event.srcElement.value.length - 1);
//   event.srcElement.focus();
// }
// }
//
// function numkey_comma_check(evt) {
// var _pattern = /^(\d{1,5}([.]\d{0,2})?)?$/;
// var _value = event.srcElement.value;
// if (!_pattern.test(_value)) {
//   alert("숫자만 입력가능하며,\n소수점 둘째자리까지만 허용됩니다.");
//   event.srcElement.value = event.srcElement.value.substring(0,event.srcElement.value.length - 1);
//   event.srcElement.focus();
// }
// }
//
// //3자리 단위마다 콤마 생성
// function addCommas(x) {
//   return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// }
//
// //모든 콤마 제거
// function removeCommas(x) {
//   if(!x || x.length == 0) return "";
//   else return x.split(",").join("");
// }
// //------------------------------------------------------------------------------------------
//
// // checkbox 쉼표로 가져오기-----------------------------------------------------------------
// //checkbox 쉼표로 가져오기
// function get_checkbox_value(name){
//
//   var selected_idx = "";
//   var num = 0;
//   $("input[name="+name+"]:checked").each(function() {
//     if(num == 0){
//       selected_idx += $(this).val();
//     }else{
//       selected_idx += ','+$(this).val();
//     }
//     num++;
//   });
//   return selected_idx;
// }
//
// function get_checkbox_value_type_slash(name){
//
//   var selected_idx = "";
//   var num = 0;
//   $("input[name="+name+"]:checked").each(function() {
//     if(num == 0){
//       selected_idx += $(this).val();
//     }else{
//       selected_idx += '/'+$(this).val();
//     }
//     num++;
//   });
//   return selected_idx;
// }
// //------------------------------------------------------------------------------------------
//
// // 파일업로드-------------------------------------------------------------------------------
// var file_cnt = 0;
// // 이미지 업로드 함수 trigger(img_id:id,limit_cnt:파일갯수,file_type:(image:이미지,file:파일)
// function file_upload_click(img_id,file_type,limit_cnt){
// $('body').append('<form id="file_form" method="post"></form>');
// var fileUpload = "<input type='file' name='file[]' id='ex_file' onchange=\"file_upload('"+img_id+"','"+file_type+"','"+limit_cnt+"');\" style='display:none' >";
// $('#file_form').html(fileUpload);
// $('#ex_file').click();
// }
//
//
// //파일업로드함수
// function file_upload(img_id,file_type,limit_cnt){
//
//   var formdata = new FormData($("#file_form")[0]);
//   if(limit_cnt!=""){
//     if($(".flie_li").length >= parseInt(limit_cnt)){
//       alert('업로드는 '+limit_cnt+'개 까지만 등록 가능합니다.');
//       return;
//     }
//   }
//
//   $.ajax({
//     url         : "/common/multi_fileUpload",
//     type        : 'post',
//     dataType    : 'json',
//     processData : false,
//     contentType : false,
//     data        : formdata,
//     success     : function(img_list){
//
//       var str="";
//
//       for(var i = 0; i < img_list.length; i++){
//         str="<li id='id_file_"+i+"_"+file_cnt+"' class='flie_li' style='display:inline-block;width:300px;float:left;'>"
//         if(file_type !="file"){
//           str+="<img class='preview_img' src='"+img_list[i].path+"'>";
//         }else{
//           str+= img_list[i].orig_name;
//         }
//         str+= "<img src='/images/btn_del.gif' style='width:15px;cursor:pointer' onclick=\"file_upload_remove('"+i+"_"+file_cnt+"');\"/>";
//         str+="<input type='hidden'  name='"+img_id+"_orig_name[]' id='"+img_id+"_orig_name_"+i+"' value='"+img_list[i].orig_name+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_org_path[]' id='"+img_id+"_org_"+i+"' value='"+img_list[i].orig_name+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_path[]' id='"+img_id+"_path_"+i+"' value='"+img_list[i].path+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_width[]' id='"+img_id+"_width_"+i+"' value='"+img_list[i].image_width+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_height[]' id='"+img_id+"_height_"+i+"' value='"+img_list[i].image_height+"'/>";
//         str+="</li>";
//
//         $('#'+img_id).append(str);
//
//         $("#file_img_path").attr("src", img_list[i].path);
//         $("#_img_path").val(img_list[i].path);
//         $("#_img_org_name").val(img_list[i].orig_name);
//
//         $("#li_"+img_id).attr("src", img_list[i].path);
//         $("#li_path_"+img_id).val(img_list[i].path);
//
//         $("#"+img_id+"_path").val(img_list[i].path);
//         console.log(img_list[i].path);
//         console.log("성공!!");
//         $("#reprot_"+img_id).attr("src","/p_images/img_check.png");
//         $("#reprot_txt_"+img_id).text("등록되었습니다.");
//
//         //펀드투자설명서 저장
//         if(img_id.indexOf('instructions')>-1){
//           invest_instructions_path_mod_up(img_id,img_list[i].path);
//         }
//
//         // 공인중개사 마이페이지 프로필 이미지 삭제버튼 활성화
//         if(img_id.indexOf('member_img')>-1){
//           $('#member_img_del').css({'display':'block'});
//         }
//
//         // 공인중개사 마이페이지 ㅐ경 이미지 삭제버튼 활성화
//         if(img_id.indexOf('back_img')>-1){
//           $('#back_img_del').css({'display':'block'});
//         }
//
//       }
//       file_cnt++;
//     }
//
//   });
//
// }
//
// function file_upload_click2(img_id,file_type,limit_cnt){
// $('body').append('<form id="file_form" method="post"></form>');
// var fileUpload = "<input type='file' name='file[]' id='ex_file' onchange=\"file_upload2('"+img_id+"','"+file_type+"','"+limit_cnt+"');\" style='display:none' >";
// $('#file_form').html(fileUpload);
// $('#ex_file').click();
// }
//
// //파일업로드함수_2 ::재명
// function file_upload2(img_id,file_type,limit_cnt){
//
//   var formdata = new FormData($("#file_form")[0]);
//   if(limit_cnt!=""){
//     if($(".flie_li2").length >= parseInt(limit_cnt)){
//       alert('업로드는 '+limit_cnt+'개 까지만 등록 가능합니다.');
//       return;
//     }
//   }
//
//   $.ajax({
//     url         : "/common/multi_fileUpload",
//     type        : 'post',
//     dataType    : 'json',
//     processData : false,
//     contentType : false,
//     data        : formdata,
//     success     : function(img_list){
//
//       var str="";
//
//       for(var i = 0; i < img_list.length; i++){
//         str="<li id='id_file_"+i+"_"+file_cnt+"' class='flie_li2' style='display:inline-block;width:300px;float:left;'>"
//         if(file_type !="file"){
//           str+="<img style='width:100%;' class='preview_img' src='"+img_list[i].path+"'>";
//         }else{
//           str+= img_list[i].orig_name;
//         }
//         str+= "<img src='/images/btn_del.gif' style='width:15px;cursor:pointer' onclick=\"file_upload_remove('"+i+"_"+file_cnt+"');\"/>";
//         str+="<input type='hidden'  name='"+img_id+"_orig_name[]' id='"+img_id+"_orig_name_"+i+"' value='"+img_list[i].orig_name+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_org_path[]' id='"+img_id+"_org_"+i+"' value='"+img_list[i].orig_name+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_path[]' id='"+img_id+"_path_"+i+"' value='"+img_list[i].path+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_width[]' id='"+img_id+"_width_"+i+"' value='"+img_list[i].image_width+"'/>";
//         str+="<input type='hidden' name='"+img_id+"_height[]' id='"+img_id+"_height_"+i+"' value='"+img_list[i].image_height+"'/>";
//         str+="</li>";
//
//         $('#'+img_id).append(str);
//       }
//       file_cnt++;
//     }
//
//   });
//
// }
//
// var file_upload_remove = function(file_no){
// $("#id_file_"+file_no).remove();
// }
// // -------------------------------------------------------------------------------------
//
//
// // 파일 업로드 :: 재명 수정3
// // 이미지 업로드 함수 trigger(img_id:id,limit_cnt:파일갯수,file_type:(image:이미지,file:파일)
//
//
// //파일업로드함수
// function file_upload3(img_id){
//
//   var formdata = new FormData($('#file_form_'+ img_id)[0]);
//
//   $.ajax({
//     url         : "/common/multi_fileUpload",
//     type        : 'post',
//     dataType    : 'json',
//     processData : false,
//     contentType : false,
//     data        : formdata,
//     success     : function(img_list){
//       for(var i = 0; i < img_list.length; i++){
//         $("#"+img_id+"_path").val(img_list[i].path);
//       }
//       file_cnt++;
//     }
//   });
// }
//
//
// // -------------------------------------------------------------------------------------
//
//
// function COM_set_timer(set_minute,id){
//  //초기값
//  var temp_minute = "";
//  var temp_second = "";
//  var hour = 0;
//  var minute = set_minute;
//  var second = 1;
//
//  var timer = setInterval(function () {
//
//
//   if(minute<10){
// 	 temp_minute ="0"+minute;
//    }else{
// 	 temp_minute =minute;
//    }
//
//    if(second<10){
// 	 temp_second ="0"+second;
//    }else{
// 	 temp_second =second;
//    }
//
//    var_time =  temp_minute +"분"+temp_second+"초";
//
//   $("#"+id).html(var_time);
//
//   if(second == "1" && minute == "0" ){
// 	$("#"+id).html('인증 확인 시간을 초과 하였습니다');
// 	$("#time_over_yn").val('N');
//     clearInterval(timer); /* 타이머 종료 */
//   }else{
//    second--;
//    // 분처리
//    if(second == 0){
//   	minute--;
//   	second = 59;
//    }
//    //시간처리
//    if(minute == 0){
//   	if(hour > 0){
//   	 hour--;
//   	 minute = 59;
//   	}
//    }
//
//   }
//  }, 1000); /* millisecond 단위의 인터벌 */
//
// }
