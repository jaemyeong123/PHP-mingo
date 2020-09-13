<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<input type="hidden" name="agent" id="agent" value="<?=$agent?>">


<script>
function authcomplete(){

	if($('#agent').val()=='android'){
	//window.rocateer.auth(member_name,member_tel,member_gender,member_birth);
		window.rocateer.auth('<?=$member_name?>','<?=$member_phone?>','<?=$member_gender?>','<?=$member_birth?>','<?=$auth_code?>');

	}else if($('#agent').val()=='ios'){
		var message = {"member_name":"<?=$member_name?>","member_tel":"<?=$member_phone?>","member_gender":"<?=$member_gender?>","member_birth":"<?=$member_birth?>","auth_code":"<?=$auth_code?>"};
		window.webkit.messageHandlers.native.postMessage(message);
	}
}
authcomplete();
</script>
