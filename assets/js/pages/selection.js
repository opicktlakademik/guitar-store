$('.btn-remove').click(function () {
    Swal.fire({
        title: 'Kosongkan nilai kecocokan?',
        text: "Ini akan mengosongkan nilai kecocokan. Jika anda ingin menghapus semua silahkan hapus alternative dari menu alternative",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            let id = $(this).attr('data-alt-pencocokan');
            window.location.replace(`Selection/delete/${id}`);
        }
    });
});
$('.btn-edit').on("click", function () {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		background: 'white',
	});
	let id_alt = $(this).attr('data-id-alt');
	$.get(`Alternative/getform/${id_alt}/Selection/pencocokan`, {}, function (e, status) {
		if (status) {
			let data = JSON.parse(e);
			if (data.status) {
				$('#modal-xl-title').html(data.modal_title);
				$('#modal-xl-body').html(data.page);
				$('#modal-xl').modal('show');
			} else {
				Toast.fire({
					type: 'error',
					title: status
				});
			}
		} else {
			Toast.fire({
				type: 'error',
				title: 'Something wrong when fetching form!'
			});
		}
	});
});

$('#btn-hitung').click(function () {
    let null_value = parseInt($(this).attr('data-nv'));
    if (null_value === 0) {
        window.location.replace("Hitungwp");
    } else {
        myAlert("Teradapat nilai NULL di  beberapa nilai kecocokan alternative. Proses tidak bisa dilanjutkan!", false);
    }
});

$('.btn-show').click(function () { 
	$('#body-perhitungan').attr('hidden', 'hidden');
	$('#card-hasil-terakhir').append(`
		<div id='spinner' class="d-flex justify-content-center">
        	<div class="spinner-border text-info ml-auto mr-auto" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
	`);
	let id = $(this).attr('data-id');
	$.get(`Selection/get_data/${id}`, {}, function (e, success) { 
		if (success) {
			let data = JSON.parse(e);
			if (data.status) {
				$('#body-perhitungan').empty();
				$('#terakhir').html(`<b>${data.data[0].tanggal}</b>`);
				data.data.map((val, i) => {
					$('#body-perhitungan').append(
						`<tr>
							<td>${i + 1}</td>
							<td>${val.nama_alt}</td>
							<td>${val.hasil}</td>
						</tr>`
					);
				});
			} else {
				myAlert(data.message, FALSE);
			}
		} else {
			myAlert("Connection error: " + success, FALSE);
		}
	});
	setTimeout(function () {
		$('#spinner').remove();
		$('#body-perhitungan').attr('hidden', false);
	}, 500);
 })
