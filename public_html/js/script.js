$(function(){
	
	/* ---------- isbots ---------- */
	function bot(num,isbot){
		$.ajax({
			url: "script_bots.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#bots").html(result);
			}
		});
	}
	/* ---------- Browser ---------- */
	function browser(num,isbot){
		$.ajax({
			url: "script_browser.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#browser").html(result);
			}
		});
	}
	/* ---------- Continent ---------- */
	function continent(num,isbot){
		$.ajax({
			url: "script_continent.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#continent").html(result);
			}
		});
	}
	/* ---------- Now ---------- */
	function now(num,isbot){
		$.ajax({
			url: "script_now.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#now").html(result);
			}
		});
	}
	/* ---------- Os ---------- */
	function os(num,isbot){
		$.ajax({
			url: "script_os.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#os").html(result);
			}
		});
	}
	/* ---------- Time ---------- */
	function time(num,isbot){
		$.ajax({
			url: "script_time.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#time").html(result);
			}
		});
	}
	/* ---------- Total ---------- */
	function total(num,isbot){
		$.ajax({
			url: "script_total.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#total").html(result);
			}
		});
	}
	/* ---------- Unique ---------- */
	function unique(num,isbot){
		$.ajax({
			url: "script_unique.php", 
			type: "post",
			data: {"value": num, "isbot": isbot},
			success: function(result){
				$("#unique").html(result);
			}
		});
	}
	
	function all(value,isbot){		
		bot(value,isbot);
		browser(value,isbot);
		continent(value,isbot);
		now(value,isbot);
		os(value,isbot);
		time(value,isbot);
		total(value,isbot);
		unique(value,isbot);
	}
	
	
	
	/* Run on Open */
	$(document).ready(function(){
		
		$("#bot").prop("checked", true);
		
		value = $("#choice").val();
		isbot = $("#bot").is(":checked");
		
		all(value,isbot);
		
	});
	
	/* Run on click */
	$("#choice").change(function(){
		value = $("#choice").val();
		isbot = $("#bot").is(":checked");

		all(value,isbot);
	});
	$("#bot").change(function(){
		value = $("#choice").val();
		isbot = $("#bot").is(":checked");

		all(value,isbot);
	});
	
});