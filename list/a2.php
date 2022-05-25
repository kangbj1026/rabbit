<style>
	.is-pc .at-body {min-height:700px;}
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
	canvas {width: 100%;}
	.view-wrap {height:1050px;}
	.is-pc .at-body {min-height:1100px;}
	#moving_pace {width:100%;position:relative;display: flex;flex-direction: column;justify-content: flex-end;height:67rem;}
	#square {width:100%;}
	#run { width:40px;height:12vh; }
	#result { height: 0; }
	#keyPushs {width: 60%;display: flex;font-size:6rem;position: absolute;left: 20%;bottom: 3%;flex-direction: column;flex-wrap: wrap;align-content: space-around;}

	.rename > form > input#sbtn { width: 40%;}
	#kup {}
	#klt {}
	#krt {}
	#kdw {}
}
</style>
	<div>
		<span id="sec">0</span> 
			<input type="hidden" id="hid_sec" value="0"/>
				<a class="rbtn" href="javascript:;" onclick="resetTimer();">리셋</a>
		</div>
		<div id="moving_pace">

		<div id="square">
			<canvas id="maze"></canvas><br>
				<input type="hidden" id="sizeInput" onkeyup="enterkey();"/>
			<label id="text"></label>
		</div>

		<div id="keyPushs">
			<div>
				<div><span id="kup" onclick="keyClick('ArrowUp');">▲</span></div>
				<div><span id="klt" onclick="keyClick('ArrowLeft');">◀</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="krt" onclick="keyClick('ArrowRight');">▶</span></div>
				<div><span id="kdw" onclick="keyClick('ArrowDown');">▼</span></div>
			</div>
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
<script type="text/javascript">
	// clickRun(this);
	let cS = 0;
	let timer = 0;
	let timerStop = 0;

	let run = $("#run");
	let square = $("#square");
	let info = $("#info");
	let hid_sec = $("#hid_sec");
	let movingPage = $("#moving_pace");
	let sec = $("#sec");
	let result = "";

	let tc=21; // tile count (must be odd number)
	let gs=20; // grid size
	let field; // map position array which value is 0 for wall, 1~2 for way
	let px=py=1; // 0 <= px,py < tc
	let xv=yv=0;
	let tracker;
	let stack;
	let stucked;
	let cx, cy; 

	window.onload=function(){
		canv = document.getElementById("maze");	
		ctx = canv.getContext("2d");	
		document.addEventListener("keydown",keyPush);
		initialize();
	}

	function keyClick(n) {
		keyPush(n);
	}

	function clickRun() {
		cS++;
		if(timer == 0 || timer == "0") {
			timer = setInterval(function () {
				hid_sec.val(Number(parseInt(hid_sec.val())) + 1);
				sec.html(hid_sec.val()); 
			}, 100);
		}
	}

	function stopTimer(t){
		clearInterval(t);
	}

	function resetTimer(){
		initialize();
		stopTimer(timer);
		$("#hid_sec").val(0);
		$("#sec").html(0);
		cS = 0;
	}

	function enterkey() {
		if (window.event.keyCode == 13) { // 이벤트 핸들러 받아서 13인지 확인 후에 이후 처리
			let sizeInput = document.getElementById("sizeInput").value;
			if(sizeInput%2==0){
				alert("Please enter an odd number ( 홀수를 입력하십시오. )");
			} else {
				tc = sizeInput;
				initialize();
			}
		}
	}

	function resultForm(){
		result += " <div class='rename'>";
		result += " <form name='fwrite' id='fwrite' action='<?php echo G5_BBS_URL?>/ga1.php' method='POST'>";
		result += " <input type='text' value='<?php echo $is_name; ?>' name='wr_name' id='wr_name' placeholder='이름' required maxlength='4'>";
		result += " <input type='hidden' value='"+hid_sec.val()+"' name='clicknum' id='clicknum' placeholder='clicknum' required>";
		result += " <input type='hidden' value='<?php echo $_GET['bo_table']?>' name='bo_table' id='bo_table' required>";
		result += " <input type='hidden' value='<?php echo $_GET['wr_id']?>' name='wr_id' id='wr_id' required>";
		result += " <input type='hidden' value='w' name='w' id='w' required>";
		result += " <input type='submit' id='sbtn' value='등록!'>";
		result += " </form>";
		result += " </div>";
		result += " </div>";
		square.html(result);
	}

	function initialize(){
		document.getElementById("sizeInput").value = tc;
		make2DArray();
		
		ctx.fillStyle="black";
		canv.width=canv.height=tc*gs;
		ctx.fillRect(0,0,canv.width, canv.height);
		
		makeWay(0,1);
		makeWay(tc-1,tc-2);
		
		px=py=1;
		// tracker initial position
		tracker = {x:px, y:py};
		stack = [];
		stack.push(tracker);
		stucked = false;
		randomMazeGenerator();
		
		cx=0; cy=1;
		// character initial position
		ctx.fillStyle="red";
		ctx.fillRect(cx*gs,cy*gs,gs, gs);
		
	}

	function makeWay(xx,yy){
		//console.log("makeWay: " + xx + " " + yy);
		field[yy][xx]++;
		ctx.fillStyle="white";
		ctx.fillRect(xx*gs,yy*gs,gs, gs);
	}

	function keyPush(evt){
		switch(evt.keyCode || evt){
		case 37:
			xv=-1;yv=0;
			clickRun();
			break;
		case 38:
			xv=0;yv=-1;
			clickRun();
			break;
		case 39:
			xv=1;yv=0;
			clickRun();
			break;
		case 40:
			xv=0;yv=1;
			clickRun();
			break;
		}
		cx+=xv;
		cy+=yv;
		if(cx<0 || cx>tc-1 || cy<0 || cy>tc-1 || field[cy][cx]==0){
			cx-=xv;
			cy-=yv;
			return;
		} else {
			ctx.fillStyle="red";
			ctx.fillRect(cx*gs,cy*gs,gs, gs);
			ctx.fillStyle="white";
			ctx.fillRect((cx-xv)*gs,(cy-yv)*gs,gs, gs);
			document.getElementById("text").innerHTML = "cx: " + cx + " cy: " + cy;
			if(cx==tc-1 && cy==tc-2){
				alert("도착!");
				stopTimer(timer);
				timer = 0;
				resultForm();
			}
		}
	}

	function make2DArray(){
		console.log("tc: " + tc);
		field = new Array(parseInt(tc));
		for(let i=0; i<field.length; i++){
			field[i] = new Array(parseInt(tc));
		}
		console.log("field length: " + field.length);
		for(let i=0; i<field.length; i++){
			for(let j=0; j<field[i].length; j++){
				field[i][j]=0; // value of 0 is for not visited, 1 for visited, 2 for backtracked.
			}
		}
		console.log("field: " + field);
	}

	function randomMazeGenerator(){
		let cnt=0;
		while(stack.length>0){

			if(stucked)
				backtracking();
			else	
				tracking();
			//console.log("cnt: " + cnt++);
		}			
	}

	function tracking(){
		
		/* Random Move */
		key = Math.floor(Math.random()*4);
		switch(key){
		case 0: // left move
			xv=-2;yv=0;
			break;
		case 1: // up move
			xv=0;yv=-2;
			break;
		case 2: // right move
			xv=2;yv=0;
			break;
		case 3: // down move
			xv=0;yv=2;
			break;
		}
		
		px+=xv;
		py+=yv;
		if(px<0 || px>tc-1 || py<0 || py>tc-1){
			px-=xv;
			py-=yv;
			return;
		} 
		if(field[py][px]<1){
			makeWay(px-xv/2,py-yv/2);
			makeWay(px,py);
			tracker = {x:px, y:py};
			stack.push(tracker);
			blockCheck();	
		} else {
			px-=xv;
			py-=yv;
			return;
		}

	}

	function blockCheck(){
		let blockCount = 0;
		if(py+2>tc-1 || field[py+2][px]!=0)
			blockCount++;
		if(py-2<0 || field[py-2][px]!=0)
			blockCount++;
		if(px+2>tc-1 || field[py][px+2]!=0)
			blockCount++;
		if(px-2<0 || field[py][px-2]!=0)
			blockCount++;
		if(blockCount>=4)
			stucked = true;
		else
			stucked = false;
	}

	function backtracking(){
		let backtracker = stack.pop();
		px = backtracker.x;
		py = backtracker.y;
		//field[py][px]++;
		//ctx.fillStyle="blue";
		//ctx.fillRect(px*gs,py*gs,gs, gs);
		blockCheck();	
	}
</script>