<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
if($header_skin)
	include_once('./header.php');

if($config['cf_social_login_use']) { //소셜 로그인 사용시 

	$social_pop_once = false;

	$self_url = G5_BBS_URL."/login.php";

	//새창을 사용한다면
	if( G5_SOCIAL_USE_POPUP ) {
		$self_url = G5_SOCIAL_LOGIN_URL.'/popup.php';
	}
?>
<style>
@import url(//fonts.googleapis.com/earlyaccess/notosanskr.css);
	.quiz { display:none;font-family: "Noto Sans KR", sans-serif !important;}

</style>
	<div class="sns-wrap-over" id="sns_register">
		<div class="panel panel-primary">
			<div class="panel-heading"><strong><i class="fa fa-sign-in fa-lg"></i> SNS 계정으로 가입</strong></div>
			<div class="panel-body">
			   <div class="sns-wrap">
					<?php if( social_service_check('naver') ) {     //네이버 로그인을 사용한다면 ?>
					<a href="<?php echo $self_url;?>?provider=naver&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-naver" title="네이버">
						<span class="ico"></span>
						<span class="txt">네이버으로 회원가입하기</span>
					</a>
					<?php }     //end if ?>
					<?php if( social_service_check('kakao') ) {     //카카오 로그인을 사용한다면 ?>
					<a href="<?php echo $self_url;?>?provider=kakao&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-kakao" title="카카오">
						<span class="ico"></span>
						<span class="txt">카카오로 회원가입하기</span>
					</a>
					<?php }     //end if ?>
					<?php if( social_service_check('facebook') ) {     //페이스북 로그인을 사용한다면 ?>
					<a href="<?php echo $self_url;?>?provider=facebook&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-facebook" title="페이스북">
						<span class="ico"></span>
						<span class="txt">페이스북로 회원가입하기</span>
					</a>
					<?php }     //end if ?>
					<?php if( social_service_check('google') ) {     //구글 로그인을 사용한다면 ?>
					<a href="<?php echo $self_url;?>?provider=google&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-google" title="구글">
						<span class="ico"></span>
						<span class="txt">구글+로 회원가입하기</span>
					</a>
					<?php }     //end if ?>
					<?php if( social_service_check('twitter') ) {     //트위터 로그인을 사용한다면 ?>
					<a href="<?php echo $self_url;?>?provider=twitter&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-twitter" title="트위터">
						<span class="ico"></span>
						<span class="txt">트위터로 회원가입하기</span>
					</a>
					<?php }     //end if ?>
					<?php if( social_service_check('payco') ) {     //페이코 로그인을 사용한다면 ?>
					<a href="<?php echo $self_url;?>?provider=payco&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-payco" title="페이코">
						<span class="ico"></span>
						<span class="txt">페이코로 회원가입하기</span>
					</a>
					<?php }     //end if ?>

					<?php if( G5_SOCIAL_USE_POPUP && !$social_pop_once ){
					$social_pop_once = true;
					?>
					<script>
						jQuery(function($){
							$(".sns-wrap").on("click", "a.social_link", function(e){
								e.preventDefault();

								var pop_url = $(this).attr("href");
								var newWin = window.open(
									pop_url, 
									"social_sing_on", 
									"location=0,status=0,scrollbars=1,width=600,height=500"
								);

								if(!newWin || newWin.closed || typeof newWin.closed=='undefined')
									 alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

								return false;
							});
						});
					</script>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
<?php } ?>

<form  name="fregister" id="fregister" action="<?php echo $action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off" class="form" role="form">
<input type="hidden" name="pim" value="<?php echo $pim;?>">
	<div class="alert alert-info" role="alert">
		<strong> 서비스 이용을 위해 간단한 테스트를 진행하겠습니다.</strong>
		<div class="t-a p-t-3">
			<input class="chk" type="hidden" name="agree" value="1" id="agree11"><label class="checkbox-inline">문제를 풀면 체크박스가 생겨요! 문제는 랜덤으로 나와요!</label>
			<input type="hidden" name="agree2" value="1" id="agree21"></label>
		</div>
		<div id="quiz-form" class="quiz-form">
			<a class="q-go" onclick="quiz();"> 👆 Go~ 클릭할때마다 문제는 변경되요~</a>
			<div id="quiz" class="quiz" style="display:none;">
				<span class="q-t"></span>
				<span id="q-q" class="q-q"></span>
			</div>
				<span class="q-b"></span>
		</div>
		<div class="text-center p-t-3">
			<button type="submit" class="btn btn-color">회원가입</button>
		</div>
	</div>
</form>

<script>
	function quiz() {
		let ranNum = Math.floor(1 + Math.random() * 10);
		let quiz = $(".quiz");
		let qGo = $(".q-go");
		let qT = $(".q-t");
		let qQ = $(".q-q");
		let qB = $(".q-b");
		let qN = "<h2>"+ranNum+" 번째 문제! </h2>";
		let qL = "";
		let right = "<br> <input id='right1' class='right' tpye='text'>";

		quiz.css({"padding-top":"10%","display":"flex"});

		qT.css("width","20%");
		qT.html(qN);

		qQ.css({"font-size":"1.5rem","width":"60%","line-height":"3"});
			switch (ranNum)
			{
				case 1: qL += "태조 이성계의 아들은 총 몇명일까요? " + right;
				break;
				case 2: qL += "태조 이성계의 아들은 총 6명입니다.<br> 그중 다섯째아들의 이름은 무엇인가요? " + right;
				break;
				case 3: qL += "세종의 둘째 아들로 태어나 문종이 사망하자 어린 단종을 제거하고 무력으로 왕위를 찬탈한 인물 " + right;
				break;
				case 4: qL += "후고구려를 건국한 왕으로 횡포가 심하였다. 신숭겸 등이 왕건을 추대하자 도망가다 피살되었다. " + right;
				break;
				case 5: qL += "조선 시대 세종과 인조 대에 법화로 주조, 유통한 금속화폐. 세종대에는 해서체, 인조 대에는 팔분서체로 주조되었다. " + right;
				break;
				case 6: qL += "조선 중기 명종 때 황해도 함경도 등지에서 활동하던 도둑으로 천민인 백정 출신이며 곡식을 백성들에게 나누어줘 의적이라고 불렀던 인물. " + right;
				break;
				case 7: qL += "조선 후기 『경세유표』, 『목민심서』, 『여유당전서』 등을 저술한 중농주의 실학자. 호는 다산(茶山)·사암(俟菴)·여유당(與猶堂)·채산(菜山). 근기(近畿) 남인 가문 출신이다. " + right;
				break;
				case 8: qL += "조선 시대 허준이 중국과 조선의 의서를 집대성하여 1610년에 저술한 의서. 1613년 내의원에서 개주갑인자 목활자로 처음 간행된 조선 최고의 의학서적이다. " + right;
				break;
				case 9: qL += "조선 제6대 왕(재위 1452∼1455). 문종의 아들로 어린 나이에 즉위하여 숙부인 수양대군에게 왕위를 빼앗기고 상왕이 되었다. " + right;
				break;
				case 10: qL += "조선 시대에 각 관청에서 일을 시키기 위해 지방에서 중앙으로 뽑아 올린 공노비로 지방 거주 공노비를 서울에 입역시켜 중앙 각 관청의 잡역에 종사하도록 한 노비. " + right;
				break;
				default:
					qL += " 다시 클릭! ";
			}
		qQ.html(qL);

		qB.html('<input type="button" style="margin-top:3%;" onclick="right('+ranNum+');" value="과연!?">');
	}

	function right(v) {
		let rightVal = $(".right").val();
		let rightValText = rightVal + " 맞습니다! ";
		let chk = $('.chk');
		let quiz = $("#quiz");
		let qB = $(".q-b");

//			switch(rightVal){
//				case (rightVal == "6" && v == 1):
//					alert(rightValText);
//					break;
//				case (rightVal == "이방원" && v == 2):
//				case (rightVal == "수양대군" && v == 3):
//				case (rightVal == "궁예" && v == 4):
//				case (rightVal == "조선통보" && v == 5):
//				case (rightVal == "임꺽정" && v == 6):
//				case (rightVal == "정약용" && v == 7):
//				case (rightVal == "동의보감" && v == 8):
//				case (rightVal == "단종" && v == 9):
//				case (rightVal == "선상노비" && v == 10):
//					quiz.css("display","none");
//					qB.css("display","none");
//					chk.prop("type","checkbox");
//					alert(rightValText);
//				break;
//				default:
//					alert("다시 푸세요!",);
//					console.log(v);
//					console.log(rightVal);
//					return false;
//				break;
//			}
		if(rightVal) {
			if(rightVal == "6" && v == 1) {
			} else if(rightVal == "이방원" && v == 2){
			} else if(rightVal == "수양대군" && v == 3){
			} else if(rightVal == "궁예" && v == 4){
			} else if(rightVal == "조선통보" && v == 5){
			} else if(rightVal == "임꺽정" && v == 6){
			} else if(rightVal == "정약용" && v == 7){
			} else if(rightVal == "동의보감" && v == 8){
			} else if(rightVal == "단종" && v == 9){
			} else if(rightVal == "선상노비" && v == 10){
			} else {
				alert("다시 푸세요!",);
				rightVal = v;
				return false;
			}
			alert(rightValText);
			quiz.css("display","none");
			qB.css("display","none");
			chk.prop("type","checkbox");
			return true;
		}
		qB.html('<input type="button" style="margin-top:3%;" onclick="right(\''+rightVal+'\');" value="과연!?">');
	}
    function fregister_submit(f) {
        if (!f.agree.checked) {
            alert("문제를 풀지 않으면 넘어 갈 수 없소!.");
            f.agree.focus();
            return false;
        }
        
        return true;
    }
</script>
