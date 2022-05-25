<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo APMS_SVER; ?>"></script>
<?php } ?>

<form class="form-horizontal register-form" role="form" id="fregisterform" name="fregisterform" action="<?php echo $action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="pim" value="<?php echo $pim;?>"> 
	<input type="hidden" name="agree" value="<?php echo $agree ?>">
	<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
	<input type="hidden" name="cert_no" value="">
	<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
	<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
		<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
		<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
	<?php }  ?>

	<div class="panel panel-default">
		<div class="panel-heading"><strong> 사이트 이용정보 입력</strong></div>
		<div class="panel-body">

			<div class="form-group has-feedback text-gap">
				<label class="col-sm-2 control-label" for="reg_mb_id"><b>아이디</b><strong class="sound_only">필수</strong></label>
				<div class="col-sm-3">
					<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="form-control input-sm" minlength="3" maxlength="20">
					<span class="fa fa-check form-control-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-8 text-muted">
					<div id="msg_mb_id"></div>
					영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.
				</div>
			</div>

			<div class="form-group has-feedback">
				<label class="col-sm-2 control-label" for="reg_mb_password"><b>비밀번호</b><strong class="sound_only">필수</strong></label>
				<div class="col-sm-3">
					<input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="form-control input-sm" minlength="3" maxlength="20">
					<span class="fa fa-lock form-control-feedback"></span>
					<div class="h15 hidden-lg hidden-md hidden-sm"></div>
				</div>
				<label class="col-sm-2 control-label" for="reg_mb_password_re"><b>비밀번호 확인</b><strong class="sound_only">필수</strong></label>
				<div class="col-sm-3">
					<input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="form-control input-sm" minlength="3" maxlength="20">
					<span class="fa fa-check form-control-feedback"></span>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading"><strong><i class="fa fa-user fa-lg"></i> 개인정보 입력</strong></div>
		<div class="panel-body">

			<div class="form-group has-feedback<?php echo ($config['cf_cert_use']) ? ' text-gap' : '';?>">
				<label class="col-sm-2 control-label" for="reg_mb_name"><b>이름</b><strong class="sound_only">필수</strong></label>
				<div class="col-sm-3">
					<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="form-control input-sm" size="10">
					<span class="fa fa-check form-control-feedback"></span>
				</div>
				<?php if($config['cf_cert_use']) { ?>
					<div class="col-sm-7">
						<div class="cert-btn">
							<?php 
								if($config['cf_cert_ipin'])
									echo '<button type="button" id="win_ipin_cert" class="btn btn-black btn-sm">아이핀 본인확인</button>'.PHP_EOL;
								if($config['cf_cert_hp'])
									echo '<button type="button" id="win_hp_cert" class="btn btn-black btn-sm">휴대폰 본인확인</button>'.PHP_EOL;
							?>
						</div>
					</div>
				<?php } ?>
			</div>

			<?php if($config['cf_cert_use']) { ?>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8 text-muted">
						<?php
						if ($config['cf_cert_use'] && $member['mb_certify']) {
							if($member['mb_certify'] == 'ipin')
								$mb_cert = '아이핀';
							else
								$mb_cert = '휴대폰';
						?>
							<span class="black" id="msg_certify">
								[<strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료]
							</span>
						<?php } ?>
						아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.
						<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>
					</div>
				</div>
			<?php } ?>

			<?php if ($req_nick) {  ?>
				<div class="form-group has-feedback text-gap">
					<label class="col-sm-2 control-label" for="reg_mb_nick"><b>닉네임</b><strong class="sound_only">필수</strong></label>
					<div class="col-sm-3">
						<input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick']) ? get_text($member['mb_nick']) : ''; ?>">
						<input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick']) ? get_text($member['mb_nick']) : ''; ?>" id="reg_mb_nick" required class="form-control input-sm nospace" size="10" maxlength="20">
						<span class="fa fa-user form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8 text-muted">
						<div id="msg_mb_nick"></div>
						공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상) 닉네임을 바꾸시면 앞으로 <?php echo (int)$config['cf_nick_modify'] ?>일 이내에는 변경 할 수 없습니다.
					</div>
				</div>
			<?php }  ?>

			<div class="form-group has-feedback<?php echo ($config['cf_use_email_certify']) ? ' text-gap' : '';?>">
				<label class="col-sm-2 control-label" for="reg_mb_email"><b>E-mail</b><strong class="sound_only">필수</strong></label>
				<div class="col-sm-5">
					<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
					<input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="form-control input-sm email" size="70" maxlength="100">
					<span class="fa fa-envelope form-control-feedback"></span>
				</div>
			</div>
			<?php if ($config['cf_use_email_certify']) {  ?>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8 text-muted">
						<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
						<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
					</div>
				</div>
			<?php }  ?>

			<?php if ($config['cf_use_homepage']) {  ?>
				<div class="form-group has-feedback">
					<label class="col-sm-2 control-label" for="reg_mb_homepage"><b>홈페이지</b><?php if ($config['cf_req_homepage']){ ?><strong class="sound_only">필수</strong><?php } ?></label>
					<div class="col-sm-5">
						<input type="text" name="mb_homepage" value="<?php echo get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" <?php echo $config['cf_req_homepage']?"required":""; ?> class="form-control input-sm" size="70" maxlength="255">
						<span class="fa fa-home form-control-feedback"></span>
					</div>
				</div>
			<?php }  ?>

			<?php if ($config['cf_use_tel']) {  ?>
				<div class="form-group has-feedback">
					<label class="col-sm-2 control-label" for="reg_mb_tel"><b>전화번호</b><?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
					<div class="col-sm-3">
						<input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="form-control input-sm" maxlength="20">
						<span class="fa fa-phone form-control-feedback"></span>
					</div>
				</div>
			<?php }  ?>

			<?php if ($config['cf_use_hp'] || $config['cf_cert_hp']) {  ?>
				<div class="form-group has-feedback">
					<label class="col-sm-2 control-label" for="reg_mb_hp"><b>휴대폰번호</b><?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
					<div class="col-sm-3">
						<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="form-control input-sm" maxlength="20">
						<span class="fa fa-mobile form-control-feedback"></span>
						<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
							<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
						<?php } ?>
					</div>
				</div>
			<?php }  ?>

			<?php if ($config['cf_use_addr']) { ?>
				<div class="form-group has-feedback">
					<label class="col-sm-2 control-label"><b>주소</b><?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?></label>
					<div class="col-sm-8">
						<label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
						<label>
						<input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2'] ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="form-control input-sm" size="6" maxlength="6">
						</label>
						<label>
			                <button type="button" class="btn btn-black btn-sm win_zip_find" style="margin-top:0px;" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button>
						</label>

						<div class="addr-line">
							<label class="sound_only" for="reg_mb_addr1">기본주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
							<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="form-control input-sm" size="50" placeholder="기본주소">
						</div>

						<div class="addr-line">
							<label class="sound_only" for="reg_mb_addr2">상세주소</label>
							<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="form-control input-sm" size="50" placeholder="상세주소">
						</div>

						<label class="sound_only" for="reg_mb_addr3">참고항목</label>
						<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="form-control input-sm" size="50" readonly="readonly" placeholder="참고항목">
						<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
					</div>
				</div>
			<?php }  ?>

		</div>
	</div>

	<div class="text-center" style="margin:30px 0px;">
		<button type="submit" id="btn_submit" class="btn btn-color" accesskey="s"><?php echo $w==''?'회원가입':'정보수정'; ?></button>
		<?php if(!$pim) { ?>
			<a href="<?php echo G5_URL ?>" class="btn btn-black" role="button">취소</a>
		<?php } ?>
	</div>

</form>

<script>

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == "") {
		if (f.mb_password.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=="") {
		if (f.mb_name.value.length < 1) {
			alert("이름을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}

		/*
		var pattern = /([^가-힣\x20])/i;
		if (pattern.test(f.mb_name.value)) {
			alert("이름은 한글로 입력하십시오.");
			f.mb_name.select();
			return false;
		}
		*/
	}

	<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
	// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}
	<?php } ?>

	// 닉네임 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}

	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}

	<?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
	// 휴대폰번호 체크
	var msg = reg_mb_hp_check();
	if (msg) {
		alert(msg);
		f.reg_mb_hp.select();
		return false;
	}
	<?php } ?>

	if (typeof f.mb_icon != "undefined") {
		if (f.mb_icon.value) {
			if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
				alert("회원아이콘이 이미지 파일이 아닙니다.");
				f.mb_icon.focus();
				return false;
			}
		}
	}

	if (typeof f.mb_img != "undefined") {
		if (f.mb_img.value) {
			if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
				alert("회원이미지가 이미지 파일이 아닙니다.");
				f.mb_img.focus();
				return false;
			}
		}
	}

	if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
		if (f.mb_id.value == f.mb_recommend.value) {
			alert("본인을 추천할 수 없습니다.");
			f.mb_recommend.focus();
			return false;
		}

		var msg = reg_mb_recommend_check();
		if (msg) {
			alert(msg);
			f.mb_recommend.select();
			return false;
		}
	}

	<?php echo chk_captcha_js();  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>
