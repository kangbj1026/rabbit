<!-- 검색 자동완성 // 게시판 전체 -->
<style>
	.text-highlight{ color:#DD6007; }
</style>
<script>
	var availableTags = new Array;
	function getWord(){
		availableTags.length=0;
		var url = "../skin/board/basic/data.php";
		$.ajax({
			type:"POST",
			url:url,
			dataType : "html",
			success: function(html){
				var word = html.split('|');
				for(var i=0; i<word.length; i++){
					availableTags[i] = word[i];
				}
			},
			error: function(xhr, status, error) {
				alert(error);
			}  
		});

	}
	$(window).ready(function(){
		getWord();
	});
	$( function() {
			
		$.widget( "app.autocomplete", $.ui.autocomplete, {
			options: {
				highlightClass: "ui-state-highlight"
			},
			
			_renderItem: function( ul, item ) {
				var re = new RegExp( "(" + this.term + ")", "gi" ),
					cls = this.options.highlightClass,
					template = "<span class='" + cls + "'>$1</span>",
					label = item.label.replace( re, template ),
					$li = $( "<li/>" ).appendTo( ul );
				$( "<a/>" ).attr( "href", "#" )
						   .html( label )
						   .appendTo( $li );
				
				return $li;
			}
		});
			
		$( "#stx" ).autocomplete({
		  highlightClass:"text-highlight",
		  maxResults: 10,
		  source: availableTags
		});
	});
</script>
<!-- 검색 자동완성 // 게시판 목록중에서 -->