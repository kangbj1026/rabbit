<style>
	#moving_pace {width:650px;height:500px;position: absolute;}
	#moving_pace .result { text-align:left;font-size:2rem;line-height:4;}
	#square { width:600px;height:500px;position: absolute;top:0;left:0;}
	#result {width: 40px;float:right;display: flex;flex-direction: column;flex-wrap: wrap;}
	#result > ul > li {width:120px;border:1px solid;list-style:none;line-height: 3;text-align:end;}
	#run { border:1px solid #228B22;border-radius:30px;background-color:#50F419;width:70px;height:9vh;position: absolute;top:0;left:0;background-image: url("<?php echo G5_IMG_URL ?>/emoticon/onion-001.gif");background-repeat: no-repeat;background-size: cover;}
	#run > span { font-size:3rem;text-align:center;color:#FA060A;line-height:1.2;}

	.rename > form > input#wr_name { width: 50%;height: 30px;}
	.rename > form > input#sbtn { width: 10%;line-height: initial;}
	.rbtn { border: 1px solid #F9060A;line-height: 3;padding: 10px;background-color: #FAF603;}
	.uN { float: left;margin-left: 10px;}
	.gS {margin: 5%;}

@media screen and (max-width: 768px) {
	#moving_pace {width:100%;position:relative;display: flex;flex-direction: column;justify-content: flex-end;}
	#square {width:100%;}
	#run { width:40px;height:12vh; }

	.rename > form > input#sbtn { width: 40%;}
}
</style>

<script>
	let cS = 0;
	let timer = 0;
	let timerStop = 0;

	function clickRun() {
		cS++;
		let info = $("#info");
		let hid_sec = $("#hid_sec");
		let movingPage = $("#moving_pace");
		let sec = $("#sec");
		let result = "";
		let output = "";
		let run = $("#run");
		let square = $("#square");
		let square_x = square.offset().left;
		let square_y = square.offset().top;
		let rand_x = Math.floor(Math.random() * square_x);
		let rand_y = Math.floor(Math.random() * square_y);
		output += "클릭한 횟수 = " + cS +"<br>";
		run.css({
			left: rand_x + 10,
			top: rand_y
		});
		info.html(output);
		run.html("<span>"+cS+"</span>");

		if(timer == 0 || timer == "0") {
			timer = setInterval(function () {
				hid_sec.val(Number(parseInt(hid_sec.val())) + 1);
				sec.html(hid_sec.val()); 
			}, 100);
		}

		timerStop = setInterval(function () {
			if(sec.html() >= 100) {
				stopTimer(timer);
				timer = 0;
				info.html("<br>");
			}
		},10);

		if(hid_sec.val() == 100){
			result += " <div class='result'> 클릭 한 횟수 : <span>" + cS + "</span><br>";
				if(cS < 10) {
					result += " <span> 도대체 뭘 한거야? 으이그~~ </span>";
				} else if (cS < 20) {
					result += " <span> 올 ~ 쬐끔 했네? </span>";
				} else if (cS < 30) {
					result += " <span> 역시! 넌 잘해! </span>";
				} else {
					result += " <span> 아주 타고 났구만!! 대단해요~ </span>";
				}

			result += " <div class='rename'>";
			result += " <form name='fwrite' id='fwrite' action='<?php echo G5_BBS_URL?>/ga1.php' method='POST'>";
			result += " <input type='text' value='<?php echo $is_name; ?>' name='wr_name' id='wr_name' placeholder='이름' required maxlength='4'>";
			result += " <input type='hidden' value='"+cS+"' name='clicknum' id='clicknum' placeholder='clicknum' required>";
			result += " <input type='hidden' value='<?php echo $_GET['bo_table']?>' name='bo_table' id='bo_table' required>";
			result += " <input type='hidden' value='<?php echo $_GET['wr_id']?>' name='wr_id' id='wr_id' required>";
			result += " <input type='hidden' value='w' name='w' id='w' required>";
			result += " <input type='button' id='sbtn' value='등록!'>";
			result += " </form>";
			result += " </div>";
			result += " </div>";
			square.html(result);
		}
	}

	function stopTimer(t){
		clearInterval(t);
	}

	function resetTimer(){
		$("#moving_pace #square").load(" #moving_pace #square #run");
		$("#run").css({
			left: 0,
			top: 0
		});
		$("#hid_sec").val(0);
		$("#sec").html(0);
		$("#info").html("<br>");
		cS = 0;
	}
</script>
	<div id="info"><br></div>
	<div>
		<span id="sec">0</span> 
			<input type="hidden" id="hid_sec" value="0"/>
				<a class="rbtn" href="javascript:;" onclick="resetTimer();">리셋</a>
		</div>
		<div id="moving_pace">

		<div id="square">
			<div id="run" onclick="clickRun(this);"></div>
		</div>

		<div id="result">
			<div> 순위 </div>
				<br>
				<ul>
				<?php 
				while ($row = sql_fetch_array($result)) {
					if($i <= 6) {
					?>
					<li>
						<span class="uN"><?php echo $row['u_name'] ?></span>
						<span class="gS"><?php echo $row['g_score'] ?></span>
					</li>
				<?php 
					}$i++;
				} ?>
				</ul>
		</div>
	</div>