<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
	#ajax > article {font-size:20px;}
	#ajax > article > input {width:50%}
	#ajax > article > input.in-btn {border:1px solid #ee09e455;margin:5px 0 5px 0;border-radius:30px;background-color: #f8f30a;height: 50px;}
	#ajax > article > input.in-btn:hover {background-color:#ee09e455;}
	#ajax > article > input.in-btn:focus {background-color:#0fff2f;}
	#ajax > article > input:nth-child(2):hover {background-color:#0700ff;}
	#ajax > article > input:nth-child(2):focus {background-color:#00ffff55;}
	#ajax > article > div#list {border:1px solid;width:500px;}

	#ajax1 {padding-top:2%;}
	#ajax1 > table {text-align:center;font-size:20px;}
	#ajax1 > table > thead > tr > th {text-align:center;}
	#ajax1 > table > thead > tr > th:nth-child(1) {background-color:#00ff04;}
	#ajax1 > table > thead > tr > th:nth-child(2) {background-color:#ff4e00;}

</style>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("ajax"); ?>
				</ul>
		</section>
		<section class="page-right">
			<div id="ajax">
				<h2> Ajax </h2>
				<p><strong>Ajax</strong>와 <strong>jQuery</strong>의 주요 차이점은 <strong>jQuery</strong>는 <strong>JavaScript</strong>를 사용하여 빌드 된 </p>
				<p><strong>Frame Work</strong>와 비슷하고 <strong>Ajax</strong>는 웹 페이지를 다시로드하지 않고
				</p>
				<p>서버와 통신하기 위해 <strong>JavaScript</strong>를 사용하는 기술 또는 방법이라는 것입니다.</p>
				<article id="ar">
						<input type="text" id="item" value="" placeholder="추가할 내용 입력해주세요.">
						<input class="in-btn" type="button" onclick="add('a')" value="1num next after">
						<input class="in-btn" type="button" onclick="add('b')" value="2num next before">
						<input class="in-btn" type="button" onclick="add('c')" value="3num next prepend">
						<input class="in-btn" type="button" onclick="add('d')" value="4num next append">
						<input class="in-btn" type="button" onclick="add('e')" value="Allnum next Allafter">
						<br>
						<input class="in-btn" type="button" onclick="remove()" value="Div 영역 내 새로고침">
						<br>
					<div id="list"> Div 영역 내
						<ul>
							<li>1. before : 선택한 요소의 앞에 내용 삽입 </li>
							<li>2. after : 선택한 요소의 뒤에 내용 삽입 </li>
							<li>3. prepend : 선택한요소의 자식요소 앞에 내용삽입 </li>
							<li>4. append : 선택한요소의 자식요소 뒤에 내용삽입 </li>
						</ul>
					</div>
				</article>
			</div>
			<div id="ajax1">
				<table border="1">
					<thead>
						<tr>
							<th width="1%">번호</th>
							<th width="3%">이름</th>
							<th width="2%">나이</th>
							<th width="5%">이메일 주소</th>
						</tr>
					</thead>
					<tbody id="input_data">
					</tbody>
				</table>
				<div>
					<button id="aj1">ajax 데이터 가져오기</button>
					<button id="aj2">ajax jsoin 이용해서 데이터 가져오기</button>
					<button id="aj3">리셋</button>
				</div>
			</div>
		</section>
	</div>
</div>
<script>

	function add(e) {
		let item = document.getElementById("item").value;
		let listUl = $("#list > ul > li");
		let listUl1 = $("#list > ul > li:nth-child(1)");
		let listUl2 = $("#list > ul > li:nth-child(2)");
		let listUl3 = $("#list > ul > li:nth-child(3)");
		let listUl4 = $("#list > ul > li:nth-child(4)");
			switch (e)
			{
			case "a":
				listUl1.after(item);
				break;
			case "b":
				listUl2.before(item);
				break;
			case "c":
				listUl3.prepend(item);
				break;
			case "d":
				listUl4.append(item);
				break;
			case "e":
				listUl.after(item);
				break;
			default:
				alert("없다");
			}
	}

	function remove(){
		let listUl = $("#list ul");
		listUl.load(" #list ul li");
	}

	$(function(){
	let g5_bbs_url = "<?php echo G5_BBS_URL ?>";
	$("#aj1").click(function(){
		$.ajax({
			url: g5_bbs_url+"/source_server_test.php",
			type: "post",
			data: $("form").serialize()
		}).done(function(data){
			$("#input_data").html(data);
		console.log(data);
		});
	});

	$("#aj2").click(function(e){
		$.ajax({
			url: g5_bbs_url+"/source_server_test1.php",
			type: "post",
			data: $("form").serialize(),
			dataType: "json",
		}).done(function(data){
			let html = "";
			for(let i = 0; i < data.seq.length; i++) {
				html += "<tr>";
				html += "<td> Json - " + data.seq[i] + "</td>";
				html += "<td>" + data.name[i] + "</td>";
				html += "<td>" + data.age[i] + "</td>";
				html += "<td>" + data.email[i] + "</td>";
				html += "</tr>";
			}
			$("#input_data").html(html);
		console.log(data);
		});
	});

	$("#aj3").click(function(){
		$("#input_data").empty();
	});
	
	});
</script>