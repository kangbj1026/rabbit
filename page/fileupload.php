<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
	#att_zone {width:100%;height:300px;padding:10px;border:1px solid;}
	#att_zone:empty:before {content: attr(data-placeholder);color:#999;font-size:1.5rem;}

	#file_div {display:flex;}
</style>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
			<ul>
				<?php page_list("fileupload"); ?>
			</ul>
		</section>
		<section class="page-right">
		<input type="button" id="fadd" value="추가">
			<form method="post" action="<?php echo $action_url;?>" id="file_form" enctype="multipart/form-data" autocomplete="off" role="form">
				<div> 파일은 최대 12개까지만 가능합니다.</div>
				<div id='file_div'>
					<input type="file" name="file[]" id="file" multiple="multiple">
				</div>
				<input type="submit" class="" value="확인">
			</form>
		<style>
		#variableFiles { width:100%; margin-top:10px; border:0; }
		#variableFiles td { padding:0px 0px 7px; border:0; }
		#variableFiles input[type=file] { box-shadow : none; border: 1px solid #ccc !important; outline:none; }
		#variableFiles .form-group { margin-left:0; margin-right:0; margin-bottom:7px; }
		#variableFiles .checkbox-inline { padding-top:0px; font-weight:normal; }
		</style>
		<form method="post" action="<?php echo $action_url;?>" id="file_form" enctype="multipart/form-data" autocomplete="off" role="form">
		<div class="form-group" style="margin-bottom:0;">
			<div class="col-sm-10">
				<button class="btn btn-sm btn-color" type="button" onclick="add_file();"><i class="fa fa-plus-circle"></i></button>
				<button class="btn btn-sm btn-black" type="button" onclick="del_file();"><i class="fa fa-times-circle"></i>
				</button>
				<label class="f-ex">첨부파일의 파일용량 3MB, 너비는 720픽셀 이하 GIF, JPG, PNG로 업로드 해주세요</label>
				<table id="variableFiles">
				</table>
			</div>
		</div>
		<script>
		var flen = 0;
		function add_file(delete_code) {
			console.log(delete_code);
			var upload_count = <?php echo (int)$board['bo_upload_count']; ?>;
			if (upload_count && flen >= upload_count) {
				alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
				return;
			}

			var objTbl;
			var objNum;
			var objRow;
			var objCell;
			var objContent;
			if (document.getElementById)
				objTbl = document.getElementById("variableFiles");
			else
				objTbl = document.all["variableFiles"];

			objNum = objTbl.rows.length;
			objRow = objTbl.insertRow(objNum);
			objCell = objRow.insertCell(0);
			console.log(objNum);
			console.log(objRow);
			console.log(objCell);
			console.log(objTbl);
			objContent = "<div class='row'>";
			objContent += "<div class='col-sm-7'><div class='form-group'><div class='input-group input-group-sm'><span class='input-group-addon'>파일 "+objNum+"</span><input type='file' class='form-control input-sm' name='bf_file[]' title='파일 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능'></div></div></div>";
			if (delete_code) {
				objContent += delete_code;
		    } else {
				<?php if ($is_file_content) { ?>
				objContent += "<div class='col-sm-5'><div class='form-group'><input type='text'name='bf_content[]' class='form-control input-sm' placeholder='이미지에 대한 내용을 입력하세요.'></div></div>";
				<?php } ?>
				;
			}
			objContent += "</div>";

			objCell.innerHTML = objContent;

			flen++;
		}

		<?php echo $file_script; //수정시에 필요한 스크립트?>

		function del_file() {
			// file_length 이하로는 필드가 삭제되지 않아야 합니다.
			var file_length = <?php echo (int)$file_length; ?>;
			var objTbl = document.getElementById("variableFiles");
			if (objTbl.rows.length - 1 > file_length) {
				objTbl.deleteRow(objTbl.rows.length - 1);
				flen--;
			}
		}
		</script>
		<input type="submit" class="" value="확인">
		<form method="post" action="<?php echo $action_url;?>" id="file_form" enctype="multipart/form-data" autocomplete="off" role="form">
		</section>
	</div>
</div>
<script>
	let i = 1;
	$(function(){
		$("#fadd").click(function(){
			if($('input[type="file"]').length === 12){
				alert("파일은 최대 12개까지만 가능합니다");
			} else {
				$("#file_form").append("<div id='file_div'><input type='file' name='file"+i+"' id='file"+i+"'><button type='button' class='_add' onclick='addDel(this);'>삭제</button></div>");
				i++;
			}
		});
	});
	
	function addDel(a) {
		$(a).closest('div').remove();
		i--;
	}
</script>