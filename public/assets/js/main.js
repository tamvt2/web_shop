$(document).ready(function () {
	$('#myForm').on('submit', function (event) {
		event.preventDefault();
		const formData = $(this).serialize();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			data: formData,
			url: '/update',
			success: function (response) {
				if (response) {
					$('#error').remove();
					$('.modal-body').removeClass('danger');
					if (!$('.modal-body').hasClass('success')) {
						$('.modal-body')
							.before(`<div id="success" class="mt-3 ml-3 text-success">
							<span>Lưu thành công!</span>
						</div>`);
						$('.modal-body').addClass('success');
					}
				} else {
					$('#success').remove();
					$('.modal-body').removeClass('success');
					if (!$('.modal-body').hasClass('danger')) {
						$('.modal-body')
							.before(`<div id="error" class="mt-3 ml-3 text-danger">
							<span>Lưu thất bại!</span>
						</div>`);
						$('.modal-body').addClass('danger');
					}
				}
			},
			error: function (xhr, status, error) {
				console.error('Lỗi khi gửi form:', error);
				console.error('Phản hồi từ server:', xhr.responseText);
			},
		});
	});
});

function removeRow(id, url) {
	if (confirm('Xóa mà không thể khôi phục. Bạn có chắc ?')) {
		$.ajax({
			processData: false,
			contentType: false,
			type: 'DELETE',
			dateType: 'json',
			url: url + id,
			success: function (result) {
				alert(result.message);
				if (result.error === false) {
					location.reload();
				}
			},
		});
	}
}

$('#upload').change(function () {
	const form = new FormData();
	form.append('file', $(this)[0].files[0]);
	$.ajax({
		processData: false,
		contentType: false,
		type: 'POST',
		dataType: 'json',
		data: form,
		url: '/uploadImage',
		success: function (results) {
			if (results.error === false) {
				$('#image_show').html(
					'<a href="' +
						results.url +
						'" target="_blank"><img src="' +
						results.url +
						'" width="100px"></a>'
				);
				$('#thumb').val(results.url);
			} else {
				alert('Upload File Lỗi');
			}
		},
		error: function (xhr, status, error) {
			console.error('Lỗi khi gửi form:', error);
			console.error('Phản hồi từ server:', xhr.responseText);
		},
	});
});
