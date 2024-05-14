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

	$('#searchButton').click((e) => {
		e.preventDefault();
		const searchText = $('#searchInput').val();
		const name = searchText.trim().toLowerCase();
		if (searchText !== '') {
			$.ajax({
				type: 'GET',
				dataType: 'json',
				data: { name: name },
				url: '/search',
				success: function (response) {
					if (response.error === false) {
						let html = '';
						response.data.forEach((element) => {
							html += `<div class="col-md-6 mb-4">
								<div class="card">
									<img src="${element.image}" class="card-img-top" style="height: 120px" alt="Product Image">
									<div class="card-body">
										<h5 class="card-title">${element.name}</h5>
										<p class="card-text text-truncate">${element.description}</p>
										<p class="card-text">Kho: ${element.stock}</p>
										<p class="card-text ">Giá: <span class="text-danger">${element.price}đ</span></p>
										<div class="text-center d-flex">
											<a href="#" class="btn btn-primary mr-3">Thêm Vào Giỏ</a>
											<a href="#" class="btn btn-primary">Mua Ngay</a>
										</div>
									</div>
								</div>
							</div>`;
						});
						$('#searchResult').html(html);
					} else {
						$('#searchResult').text(
							`Không tìm thấy kết nào cho '${searchText}'`
						);
					}
				},
			});
		} else {
			$('#searchResult').text(
				`Không tìm thấy kết nào cho '${searchText}'`
			);
		}
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

$('#upload').change(() => {
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

function addCart(productId, userId) {
	const data = { product_id: productId, user_id: userId };
	$.ajax({
		type: 'POST',
		dataType: 'json',
		data: data,
		url: '/add-cart',
		success: function (results) {
			if (results.error === false) {
				$('#cartCount').html(results.count);
			}
		},
		error: function (xhr, status, error) {
			console.error('Lỗi khi gửi form:', error);
			console.error('Phản hồi từ server:', xhr.responseText);
		},
	});
}

function minus(element) {
	const quantityElement = $(element).siblings('.quantity');
	let quantity = parseInt(quantityElement.text());

	if (quantity > 1) {
		quantity -= 1;
		quantityElement.text(quantity);
		updateTotalPrice(element, quantity);
	}
}

function plus(element) {
	const quantityElement = $(element).siblings('.quantity');
	let quantity = parseInt(quantityElement.text());

	quantity += 1;
	quantityElement.text(quantity);
	updateTotalPrice(element, quantity);
}

function updateTotalPrice(element, quantity) {
	const priceElement = $(element).closest('tr').find('.text-danger').first();
	const totalPriceElement = $(element).closest('tr').find('.total-price');
	const price = parseInt(priceElement.text().replace(/\D/g, '')); // Extract the number

	const totalPrice = price * quantity;
	totalPriceElement.text(formatCurrency(totalPrice));
}

function formatCurrency(amount) {
	return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' đ';
}

function removeItem(element, url, id) {
	$(element).closest('tr').remove();
	$.ajax({
		type: 'POST',
		dateType: 'json',
		data: { id: id },
		url: url,
		success: function (results) {
			if (results.error === false) {
				$('#cartCount').html(results.count);
			}
		},
	});
}
