$(function() {
	$('#btn-sw-success').on('click', function() {
		swal(
			'Good job!',
			'You clicked the button!',
			'success'
		).catch(swal.noop);
	});

	$('#btn-sw-error').on('click', function() {
		swal(
			'Error!',
			'Please check again',
			'error'
		).catch(swal.noop);
	});

	$('#btn-sw-warning').on('click', function() {
		swal(
			'Warning!',
			'Your storage is almost full',
			'warning'
		).catch(swal.noop);
	});

	$('#btn-sw-info').on('click', function() {
		swal(
			'Hello!',
			'Welcome to Klorofil Pro',
			'info'
		).catch(swal.noop);
	});

	$('#btn-sw-question').on('click', function() {
		swal(
			'Any question?',
			'Please contact us at support@themeineed.com',
			'info'
		).catch(swal.noop);
	});

	$('#btn-sw-confirmation').on('click', function() {
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#F9354C',
			cancelButtonColor: '#41B314',
			confirmButtonText: 'Yes, delete it!'
		}).then(function() {
			swal(
				'Deleted!',
				'Your file has been deleted.',
				'success'
			);
		}).catch(swal.noop);
	});

	$('#btn-sw-confirmation2').on('click', function() {
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			allowOutsideClick: false,
			showCancelButton: true,
			confirmButtonColor: '#F9354C',
			cancelButtonColor: '#41B314',
			confirmButtonText: 'Yes, delete it!'
		}).then(function() {
			swal(
				'Deleted!',
				'Your file has been deleted.',
				'success'
			).catch(swal.noop);
		}, function(dismiss) {
			if(dismiss === 'cancel') {
				swal(
					'Cancelled',
					'Your file is safe',
					'info'
				).catch(swal.noop);
			}
		});
	});

	$('#btn-sw-chaining').on('click', function() {
		swal.setDefaults({
			input: 'text',
			confirmButtonText: 'Next &rarr;',
			showCancelButton: true,
			animation: false,
			progressSteps: ['1', '2', '3']
		});

		var steps = [
			{
				title: 'Question 1',
				text: 'What\'s your name?'
			},
			{
				title: 'Question 2',
				text: 'How old are you?'
			},
			{
				title: 'Question 3',
				text: 'Where are you come from?' 
			}
		];
		
		swal.queue(steps).then( function(result) {
			swal.resetDefaults();
			swal({
				title: 'All done!',
				html: 
					'Your answer: <pre>' + 
					JSON.stringify(result) +
					'</pre>',
				confirmButtonText: 'Confirm!',
				showCancelButton: false
			}, function() {
				swal.resetDefaults();
			});
		}).catch(function() {
			swal.resetDefaults();
			swal.noop;
		});
	});

	$('#btn-sw-dynamic').on('click', function() {
		swal.queue([{
			title: 'Your public IP',
			confirmButtonText: 'Show my public IP',
			text: 'Your public IP will be received via AJAX request',
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve) {
					$.get('https://api.ipify.org?format=json')
					.done(function(data) {
						swal.insertQueueStep(data.ip);
						resolve();
					});
				});
			}
		}]).catch(swal.noop);
	});

	$('#btn-sw-ajax').on('click', function() {
		swal({
			title: 'Submit your email',
			text: 'Use taken@example.com to simulate AJAX error',
			input: 'email',
			showCancelButton: true,
			confirmButtonText: 'Submit',
			showLoaderOnConfirm: true,
			preConfirm: function(email) {
				return new Promise(function(resolve, reject) {
					setTimeout(function() {
						if(email === 'taken@example.com') {
							reject('This email is already taken.');
						} else {
							resolve();
						}
					}, 2000);
				});
			},
			allowOutsideClick: false,
		}).then(function(email) {
			swal({
				type: 'success',
				title: 'Ajax request finished!',
				html: 'Submitted email: ' + email
			});
		}).catch(swal.noop);
	});

	$('#btn-sw-text').on('click', function() {
		swal({
			title: 'Input something',
			text: 'Try to input blank input to simulate error',
			input: 'text',
			showCancelButton: true,
			inputValidator: function(value) {
				return new Promise(function(resolve, reject) {
					if(value) {
						resolve();
					} else {
						reject('You need to write something!');
					}
				});
			}
		}).then(function(result) {
			swal({
				type: 'success',
				html: 'You entered: ' + result
			});
		}).catch(swal.noop);
	});

	$('#btn-sw-email').on('click', function() {
		swal({
			title: 'Input email address',
			input: 'email'
		}).then(function(email) {
			swal({
				type: 'success',
				html: 'Entered email: ' + email
			});
		}).catch(swal.noop);
	});

	$('#btn-sw-url').on('click', function() {
		swal({
			title: 'Input URL',
			input: 'url'
		}).then(function (url) {
			swal({
				type: 'success',
				html: 'Entered URL: ' + url
			});
		}).catch(swal.noop);
	});

	$('#btn-sw-password').on('click', function() {
		swal({
			title: 'Enter your password',
			input: 'password',
			inputAttributes: {
				'maxlength': 10,
				'autocapitalize': 'off',
				'autocorrect': 'off'
			}
		}).then(function(password) {
			if (password) {
				swal({
					type: 'success',
					html: 'Entered password: ' + password
				});
			}
		}).catch(swal.noop);
	});

	$('#btn-sw-textarea').on('click', function() {
		swal({
			input: 'textarea',
			showCancelButton: true
		}).then(function (text) {
			if (text) {
				swal(text);
			}
		}).catch(swal.noop);
	});

	$('#btn-sw-select').on('click', function() {
		swal({
			title: 'Select Ukraine',
			input: 'select',
			inputOptions: {
				'SRB': 'Serbia',
				'UKR': 'Ukraine',
				'HRV': 'Croatia'
			},
			inputPlaceholder: 'Select country',
			showCancelButton: true,
			inputValidator: function(value) {
				return new Promise(function(resolve, reject) {
					if(value === 'UKR') {
						resolve();
					} else {
						reject('You need to select Ukraine :)');
					}
				});
			}
		}).then(function(result) {
			swal({
				type: 'success',
				html: 'You selected: ' + result
			});
		}).catch(swal.noop);
	});

	$('#btn-sw-radio').on('click', function() {
		var inputOptions = new Promise(function (resolve) {
			setTimeout(function () {
				resolve({
					'#ff0000': 'Red',
					'#00ff00': 'Green',
					'#0000ff': 'Blue'
				})
			}, 2000);
		});

		swal({
			title: 'Select color',
			input: 'radio',
			inputOptions: inputOptions,
			inputValidator: function(result) {
				return new Promise(function(resolve, reject) {
					if(result) {
						resolve();
					} else {
						reject('You need to select something!');
					}
				});
			}
		}).then(function(result) {
			swal({
				type: 'success',
				html: 'You selected: ' + result
			});
		}).catch(swal.noop);
	});

	$('#btn-sw-checkbox').on('click', function() {
		swal({
			title: 'Terms and conditions',
			input: 'checkbox',
			inputPlaceholder: 'I agree with the terms and conditions',
			confirmButtonText: 'Continue <i class="fa fa-arrow-right"></i>',
			inputValidator: function(result) {
				return new Promise(function(resolve, reject) {
					if(result) {
						resolve();
					} else {
						reject('You need to agree with T&C')
					}
				});
			}
		}).then(function(result) {
			swal({
				type: 'success',
				text: 'You agreed with T&C :)'
			});
		}).catch(swal.noop);
	});

	$('#btn-sw-file').on('click', function() {
		swal({
			title: 'Select image',
			input: 'file',
			inputAttributes: {
				accept: 'image/*'
			}
		}).then(function(file) {
			var reader = new FileReader
			reader.onload = function (e) {
				swal({
					imageUrl: e.target.result
				});
			}
			reader.readAsDataURL(file);
		}).catch(swal.noop);
	});

	$('#btn-sw-range').on('click', function() {
		swal({
			title: 'How old are you?',
			type: 'question',
			input: 'range',
			inputAttributes: {
				min: 8,
				max: 120,
				step: 1
			},
			inputValue: 25
		}).catch(swal.noop);
	});
});