$(function () {
	$("#picload").change(function () {
		$('#text').text("Changing Picture");
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
		}
	});
});

function imageIsLoaded(e) {
	$.ajax({
		url: 'https://api.imgur.com/3/image',
		type: 'post',
		headers: {
			Authorization: 'Client-ID e7ee663d787d327'
		},
           
		data: {
			image:  e.target.result.split(',')[1]
		},
		dataType: 'json',
		success: function(json) {
			console.log(json);
			$('#myImg').attr('src', json.data.link);
			$('#picture').attr('value', json.data.link);
			$('#text').text("Picture Changed");
		},
		error: function(json) {
			console.log(json);
		}
	});
     
};



