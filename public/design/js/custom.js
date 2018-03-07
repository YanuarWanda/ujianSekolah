$(document).ready(function(){
	$('#tombolPindah').on('click', function(){
		$('#layar1').fadeOut(1000, function(){
			$('#layar2').fadeIn(1000);	
		});
	});
	$('#tombolKembali').on('click', function(){
		$('#layar2').fadeOut(1000, function(){
			$('#layar1').fadeIn(1000);	
		});
	});
	$('#register').on('click', function(){
		$('#layar1').fadeOut(1000, function(){
			$('#signup_modal').fadeIn(1000);	
		});
	});
	$('#hide').collapse('hide');

	$('#next').on('click', function(){
		$('#daftar').fadeOut(1000, function(){
			$('#muncul').fadeIn(1000);	
		});
	});
	
	$('#back').on('click', function(){
		$('#muncul').fadeOut(1000, function(){
			$('#daftar').fadeIn(1000);	
		});
	});
});