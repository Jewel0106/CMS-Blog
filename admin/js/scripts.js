
tinymce.init({selector: 'textarea'});


$(document).ready(function() {
	
	$("#selectAllBoxes").click(function(event) {
		if(this.checked) {
			$('.checkBoxes').each(function() {
				this.checked = true;
			});
		} else {
			$('.checkBoxes').each(function() {
				this.checked = false;
			});
		}
	});

	var loader = "<div id='load-screen'><div id='loading'></div></div>";
	
	$("body").prepend(loader);

	$("#load-screen").delay(700).fadeOut(600, function () {
		$(this).remove();
		console.log("loader");
	})
});

function loadUsersOnline() {
	$.get("functions.php?onlineusers=result", function(data) {
		$(".usersonline").text(data);
	});
}

// Calling our load users function every half second
setInterval(function() {
	loadUsersOnline();
}, 500)
