const Toast = Swal.mixin({
	toast: true,
	position: 'top',
	showConfirmButton: false,
	timer: 3000,
	background: 'white',
});
$('.btn-form').on("click", function () {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		background: 'white',
	});
	let id = $(this).attr('data-id');
	$.get(`Alternative/getform/${id}`, {}, function (e, status) {
		if (status) {
			let data = JSON.parse(e);
			if (data.status) {
				$('#modal-xl-title').html(data.modal_title);
				$('#modal-xl-body').html(data.page);
				$('#modal-xl').modal('show');
			} else {
				myAlert(data.message, false)
			}
		} else {
			Toast.fire({
				type: 'error',
				title: 'Something wrong when fetching form!'
			});
		}
	});
});

$('.btn-remove').click(function () {
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.value) {
			let id = $(this).attr('data-id');
			window.location.replace(`Alternative/delete/${id}`);
		}
	})
})