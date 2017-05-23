var amountScrolled = 300;

$(window).load(function() {
	if ( $(window).scrollTop() > amountScrolled ) {
		$('.go-to-top').fadeIn('slow');
	} else {
		$('.go-to-top').fadeOut('slow');
	}
});

$(window).load(function() {
	if ( $(window).scrollTop() > amountScrolled ) {
		$('.go-to-top').fadeIn('slow');
	} else {
		$('.go-to-top').fadeOut('slow');
	}
});

$(window).scroll(function() {
	if ( $(window).scrollTop() > amountScrolled ) {
		$('.go-to-top').fadeIn('slow');
	} else {
		$('.go-to-top').fadeOut('slow');
	}
});

$(window).scroll(function() {
	if ( $(window).scrollTop() < amountScrolled ) {
		$('.go-to-bottom').fadeIn('slow');
	} else {
		$('.go-to-bottom').fadeOut('slow');
	}
});


$('.go-to-top').click(function() {
	$('html, body').animate({
		scrollTop: 0
	}, 700);
	return false;
});

$('.go-to-bottom').click(function() {
	$('html, body').animate({
		scrollTop: $(document).height()
	}, 700);
	return false;
});