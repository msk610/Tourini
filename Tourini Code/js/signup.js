var ControlledUserInput = React.createClass({
	displayName: "ControlledUserInput",

	getInitialState: function getInitialState() {
		return {
			username: "",
			validName: 0
		};
	},

	validateUsername: function validateUsername(username) {
		var users = ["mdkabir12", "quanhaoLi", "saiframen"];
		return(username.length > 5 && users.indexOf(username) == -1 && username.length < 25);
	},

	handleChange: function handleChange(e) {
		var vald = this.validateUsername(e.target.value);
		var name = 0;
		if (vald) {
			name = 1;
		} else {
			name = -1;
		}
		this.setState({
			username: e.target.username,
			validName: name
		});
	},

	render: function render() {
		if (this.state.validName === 0) {
			return React.createElement(
				"div",
				{ className: "form-group user-form-group" },
				React.createElement("label", null),
				React.createElement("input", { className: "form-control", id: "username", name: "username", placeholder: "Username", onChange: this.handleChange, type: "text" }),
				React.createElement("span", null),
				React.createElement("span", null)
				);
		} else if (this.state.validName === 1) {
			return React.createElement(
				"div",
				{ className: "form-group has-success has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "username" },
					"Valid Username"
					),
				React.createElement("input", { type: "text", className: "form-control validate-success", id: "username", name: "username", value: this.state.username, onChange: this.handleChange, "aria-describedby": "userStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-ok form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "userStatus", className: "sr-only" },
					"(success)"
					)
				);
		} else {
			return React.createElement(
				"div",
				{ className: "form-group has-error has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "username" },
					"Invalid Username: minimum 6 character, maximum 24 characters, and unique"
					),
				React.createElement("input", { type: "text", className: "form-control", id: "username", name: "username", value: this.state.username, onChange: this.handleChange, "aria-describedby": "userStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-remove form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "userStatus", className: "sr-only" },
					"(error)"
					)
				);
		}
	}
});

React.render(React.createElement(ControlledUserInput, null), document.getElementById('user-box'));
var ControlledPassWordInput = React.createClass({
	displayName: "ControlledPasswordInput",

	getInitialState: function getInitialState() {
		return {
			password: "",
			validpassword: 0
		};
	},

	validatePassword: function validatePassword(pass) {
		return (pass.length > 4);
	},

	handleChange: function handleChange(e) {
		var vald = this.validatePassword(e.target.value);
		var passV = 0;
		if (vald) {
			passV = 1;
		} else {
			passV = -1;
		}
		this.setState({
			password: e.target.value,
			validpassword: passV
		});
	},

	render: function render() {
		if (this.state.validpassword == 0) {
			return React.createElement(
				"div",
				{ className: "form-group password-form-group" },
				React.createElement("label", null),
				React.createElement("input", { className: "form-control", id: "password", name: "password", placeholder: "Password", onChange: this.handleChange, type: "password" }),
				React.createElement("span", null),
				React.createElement("span", null)
				);
		} else if (this.state.validpassword == 1) {
			return React.createElement(
				"div",
				{ className: "form-group has-success has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "password" },
					"Valid Password"
					),
				React.createElement("input", { type: "password", className: "form-control validate-success", id: "password", name: "password", value: this.state.password, onChange: this.handleChange, "aria-describedby": "passwordStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-ok form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "passwordStatus", className: "sr-only" },
					"(success)"
					)
				);
		} else {
			return React.createElement(
				"div",
				{ className: "form-group has-error has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "password" },
					"Invalid Password: Must be 5 characters long"
					),
				React.createElement("input", { type: "password", className: "form-control", id: "password", name: "password", value: this.state.password, onChange: this.handleChange, "aria-describedby": "passwordStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-remove form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "passwordStatus", className: "sr-only" },
					"(error)"
					)
				);
		}
	}
});

React.render(React.createElement(ControlledPassWordInput, null), document.getElementById('password-box'));

var ControlledPassWordInput = React.createClass({
	displayName: "ControlledPasswordInput",

	getInitialState: function getInitialState() {
		return {
			passwordRe: "",
			validpasswordRe: 0
		};
	},

	validatePassword: function validatePassword(pass) {
		return $('#password').val() ===  pass;
	},

	handleChange: function handleChange(e) {
		var vald = this.validatePassword(e.target.value);
		var passV = 0;
		if (vald) {
			passV = 1;
		} else {
			passV = -1;
		}
		this.setState({
			passwordRe: e.target.value,
			validpasswordRe: passV
		});
	},

	render: function render() {
		if (this.state.validpasswordRe == 0) {
			return React.createElement(
				"div",
				{ className: "form-group passwordRe-form-group" },
				React.createElement("label", null),
				React.createElement("input", { className: "form-control", id: "passwordRe", name: "passwordRe", placeholder: "Retype Password", onChange: this.handleChange, type: "password" }),
				React.createElement("span", null),
				React.createElement("span", null)
				);
		} else if (this.state.validpasswordRe == 1) {
			return React.createElement(
				"div",
				{ className: "form-group has-success has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "passwordRe" },
					"Password Matches"
					),
				React.createElement("input", { type: "password", className: "form-control validate-success", id: "passwordRe", name: "passwordRe", value: this.state.password, onChange: this.handleChange, "aria-describedby": "passwordReStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-ok form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "passwordReStatus", className: "sr-only" },
					"(success)"
					)
				);
		} else {
			return React.createElement(
				"div",
				{ className: "form-group has-error has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "passwordRe" },
					"Password does not match"
					),
				React.createElement("input", { type: "password", className: "form-control", id: "passwordRe", name: "passwordRe", value: this.state.password, onChange: this.handleChange, "aria-describedby": "passwordReStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-remove form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "passwordReStatus", className: "sr-only" },
					"(error)"
					)
				);
		}
	}
});

React.render(React.createElement(ControlledPassWordInput, null), document.getElementById('password-retype-box'));


var ControlledFnameInput = React.createClass({
	displayName: "ControlledFnameInput",

	getInitialState: function getInitialState() {
		return {
			name: "",
			validname: 0
		};
	},

	validateName: function validateName(name) {
		return(name.length < 30);
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
		if (this.state.validname === 0) {
			return React.createElement(
				"div",
				{ className: "form-group name-form-group" },
				React.createElement("label", null),
				React.createElement("input", { className: "form-control", id: "fname", name: "fname", placeholder: "First Name", onChange: this.handleChange, type: "string" }),
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
					"Hello :)"
				),
				React.createElement("input", { type: "string", className: "form-control validate-success", id: "fname", name: "fname", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
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
					"First name too long!!!"
					),
				React.createElement("input", { type: "name", className: "form-control", id: "fname", name: "fname", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
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

React.render(React.createElement(ControlledFnameInput, null), document.getElementById('fname-box'));

var ControlledLnameInput = React.createClass({
	displayName: "ControlledLnameInput",

	getInitialState: function getInitialState() {
		return {
			name: "",
			validname: 0
		};
	},

	validateName: function validateName(name) {
		return(name.length < 30);
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
		if (this.state.validname === 0) {
			return React.createElement(
				"div",
				{ className: "form-group name-form-group" },
				React.createElement("label", null),
				React.createElement("input", { className: "form-control", id: "lname", name: "lname", placeholder: "Last Name", onChange: this.handleChange, type: "string" }),
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
					"Hello :)"
				),
				React.createElement("input", { type: "string", className: "form-control validate-success", id: "lname", name: "lname", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
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
					"Last name too long!!!"
					),
				React.createElement("input", { type: "name", className: "form-control", id: "lname", name: "lname", value: this.state.name, onChange: this.handleChange, "aria-describedby": "nameStatus" }),
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

React.render(React.createElement(ControlledLnameInput, null), document.getElementById('lname-box'));

var ControlledDOBInput = React.createClass({
	displayName: "ControlledDOBInput",

	getInitialState: function getInitialState() {
		return {
			name: "",
			validname: 0
		};
	},

	validateName: function validateName(name) {
		return(name.length < 30);
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
		if (this.state.validname === 0) {
			return React.createElement(
				"div",
				{ className: "form-dob dob-form-group" },
				React.createElement("label", null),
				React.createElement("input", { className: "form-control", id: "dob", name: "dob", placeholder: "yyyy-mm-dd", onChange: this.handleChange, type: "string" }),
				React.createElement("span", null),
				React.createElement("span", null)
				);
		} else if (this.state.validname === 1) {
			return React.createElement(
				"div",
				{ className: "form-dob has-success has-feedback" },
				React.createElement(
					"label",
					{ className: "control-label", "for": "dob" },
					"Hello :)"
				),
				React.createElement("input", { type: "string", className: "form-control validate-success", id: "dob", name: "dob", value: this.state.name, onChange: this.handleChange, "aria-describedby": "dobStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-ok form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "dobStatus", className: "sr-only" },
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
					"dob change this here"
					),
				React.createElement("input", { type: "name", className: "form-control", id: "dob", name: "dob", value: this.state.name, onChange: this.handleChange, "aria-describedby": "dobStatus" }),
				React.createElement("span", { className: "glyphicon glyphicon-remove form-control-feedback", "aria-hidden": "true" }),
				React.createElement(
					"span",
					{ id: "dobStatus", className: "sr-only" },
					"(error)"
					)
				);
		}
	}
});

React.render(React.createElement(ControlledDOBInput, null), document.getElementById('dob-box'));

