function activaTab(tab){
	$('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

$(document).on('click', '#close-preview', function(){ 
	$('.image-preview').popover('hide');
	// Hover befor close the preview
	$('.image-preview').hover(
		function () {
			$('.image-preview').popover('show');
		}, 
		function () {
			$('.image-preview').popover('hide');
		}
	);    
});

$(function() {
	// Create the close button
	var closebtn = $('<button/>', {
		type:"button",
		text: 'x',
		id: 'close-preview',
		style: 'font-size: initial;',
	});
	closebtn.attr("class","close pull-right");
	// Set the popover default content
	$('.image-preview').popover({
		trigger:'manual',
		html:true,
		title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
		content: "There's no image",
		placement:'bottom'
	});
	// Clear event
	$('.image-preview-clear').click(function(){
		$('.image-preview').attr("data-content","").popover('hide');
		$('.image-preview-filename').val("");
		$('.image-preview-clear').hide();
		$('.image-preview-input input:file').val("");
		$(".image-preview-input-title").text("Browse"); 
	}); 
	// Create the preview image
	$(".image-preview-input input:file").change(function (){     
		var img = $('<img/>', {
			id: 'dynamic',
			width:250,
			height:200
		});      
		var file = this.files[0];
		var reader = new FileReader();
		// Set preview image into the popover data-content
		reader.onload = function (e) {
			$(".image-preview-input-title").text("Change");
			$(".image-preview-clear").show();
			$(".image-preview-filename").val(file.name);            
			img.attr('src', e.target.result);
			$(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
		}        
		reader.readAsDataURL(file);
	});  
});

var ControlledCapInput = React.createClass({
	displayName: "ControlledCapInput",

	getInitialState: function getInitialState() {
		return {
			name: "",
			validname: 0
		};
	},

	validateName: function validateName(name) {
		return(name.length < 140);
	},

	handleChange: function handleChange(e) {
		var vald = this.validateName(e.target.value);
		var nameV = 0;
		if (vald) {
			nameV = 1;
		} else {
			nameV = -1;
		}
		this.setState({
			name: e.target.value,
			validname: nameV
		});
	},

	render: function render() {
		if (this.state.validname === 0 || this.state.name.length === 0) {
			return React.createElement(
				"div",
				{ className: "form-group name-form-group" },
				React.createElement("label", null),
				React.createElement("textarea", { className: "form-control", id: "icap", name: "icap", placeholder: "Optional Caption", onChange: this.handleChange, type: "string" }),
				React.createElement("span", null),
				React.createElement("span", null)
			);
		} else if (this.state.validname === 1) {
			return React.createElement(
				"div",
				{ className: "form-group has-success has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "name" },
					"Nice :)"
				),
				React.createElement("textarea", { type: "string", className: "form-control validate-success", id: "icap", name: "icap", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-ok form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "nameStatus", className: "sr-only" },
					"(success)"
				)
			);
		} else {
			return React.createElement(
				"div",
				{ className: "form-group has-error has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "name" },
					"Caption too long!!!"
				),
				React.createElement("textarea", { type: "string", className: "form-control", id: "icap", name: "icap", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-remove form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "nameStatus", className: "sr-only" },
					"(error)"
				)
			);
		}
	}
});

React.render(React.createElement(ControlledCapInput, null), document.getElementById('icap-box'));

var ControlledEntryInput = React.createClass({
	displayName: "ControlledEntryInput",

	getInitialState: function getInitialState() {
		return {
			name: "",
			validname: 0
		};
	},

	validateName: function validateName(name) {
		return(name.length < 140);
	},

	handleChange: function handleChange(e) {
		var vald = this.validateName(e.target.value);
		var nameV = 0;
		if (vald) {
			nameV = 1;
		} else {
			nameV = -1;
		}
		this.setState({
			name: e.target.value,
			validname: nameV
		});
	},

	render: function render() {
		if (this.state.validname === 0 || this.state.name.length === 0) {
			return React.createElement(
				"div",
				{ className: "form-group name-form-group" },
				React.createElement("label", null),
				React.createElement("textarea", { className: "form-control", id: "entry", name: "entry", placeholder: "Journal Entry", onChange: this.handleChange, type: "string" }),
				React.createElement("span", null),
				React.createElement("span", null)
			);
		} else if (this.state.validname === 1) {
			return React.createElement(
				"div",
				{ className: "form-group has-success has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "name" },
					"Cool Entry :)"
				),
				React.createElement("textarea", { type: "string", className: "form-control validate-success", id: "entry", name: "entry", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-ok form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "nameStatus", className: "sr-only" },
					"(success)"
				)
			);
		} else {
			return React.createElement(
				"div",
				{ className: "form-group has-error has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "name" },
					"Journal Entry too long!!!"
				),
				React.createElement("textarea", { type: "string", className: "form-control", id: "entry", name: "entry", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-remove form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "nameStatus", className: "sr-only" },
					"(error)"
				)
			);
		}
	}
});

React.render(React.createElement(ControlledEntryInput, null), document.getElementById('entry-box'));