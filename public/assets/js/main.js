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
				success: function (results) {
					if (results.error === false) {
						let html = '';
						results.data.forEach((element) => {
							html += `<div class="col-md-6 mb-4">
								<div class="card">
									<img src="${
										element.image
									}" class="card-img-top" style="height: 120px" alt="Product Image">
									<div class="card-body">
										<h5 class="card-title">${element.name}</h5>
										<p class="card-text text-truncate">${element.description}</p>
										<p class="card-text">Kho: ${element.stock}</p>
										<p class="card-text ">Giá: <span class="text-danger">
											${formatCurrency(element.price)}
										</span></p>
										<div class="text-center d-flex">
											<a class="btn btn-primary mr-3" onclick="addCart(${element.product_id}, ${
								results.user_id
							})">
												Thêm Vào Giỏ
											</a>
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
	total();
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

function addCart(productId, userId) {
	const data = { product_id: productId, user_id: userId };
	$.ajax({
		type: 'POST',
		dataType: 'json',
		data: data,
		url: '/add-cart',
		success: function (results) {
			if (results.error === false) {
				if (results.message) {
					alert(results.message);
				}

				if (results.count) {
					$('#cartCount').html(results.count);
				}

				if (results.data) {
					let html = '';
					results.data.forEach((val) => {
						html += `<tr>
							<td>${val.name}</td>
							<td>
								<img src="${val.image}" class="menu-img w-75" alt="" style="height: 60px">
							</td>
							<td class="text-danger">${formatCurrency(val.price)}</td>
							<td class="d-flex align-items-baseline">
								<a type="button" onclick="minus(this, \'/update-cart/${val.cart_item_id}\')">
									<i class="fas fa-minus-circle"></i>
								</a>
								<p class="quantity mx-3 data" data-id="${val.product_id}" data-price="${
							val.price
						}">
									${val.quantity}
								</p>
								<a type="button" onclick="plus(this, \'/update-cart/${val.cart_item_id}\', ${
							val.stock
						})">
									<i class="fas fa-plus-circle"></i>
								</a>
							</td>
							<td class="text-danger price sum-price">
								${formatCurrency(val.price * val.quantity)}
							</td>
							<td class="text-center">
								<a type="button" onclick="removeItem(this, \'/destroy-cart/${
									val.cart_item_id
								}\', ${results.suser_id})">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>`;
					});
					$('.cart-item').html(html);
				}
			}
			total();
		},
		error: function (xhr, status, error) {
			console.error('Lỗi khi gửi form:', error);
			console.error('Phản hồi từ server:', xhr.responseText);
		},
	});
}

function buyCart(productId, userId) {
	const data = { product_id: productId, user_id: userId };
	$.ajax({
		type: 'POST',
		dataType: 'json',
		data: data,
		url: '/buy-cart',
		success: function (results) {
			if (results.error === false) {
				if (results.data) {
					let html = '';
					const val = results.data;
					html += `<tr>
						<td>${val.name}</td>
						<td>
							<img src="${val.image}" class="menu-img w-75" alt="" style="height: 60px">
						</td>
						<td class="text-danger">${formatCurrency(val.price)}</td>
						<td class="d-flex align-items-baseline">
							<a type="button" onclick="minus(this, '/update-cart/${val.cart_item_id}')">
								<i class="fas fa-minus-circle"></i>
							</a>
							<p class="quantity mx-3" id="quantity" data-id="${val.product_id}"data-price="${
						val.price
					}">
								${val.quantity}
							</p>
							<a type="button" onclick="plus(this, '/update-cart/${val.cart_item_id}', ${
						val.stock
					})">
								<i class="fas fa-plus-circle"></i>
							</a>
						</td>
						<td class="text-danger total-price sum-price">
							${formatCurrency(val.price * val.quantity)}
						</td>
						<td class="text-center">
							<a type="button" onclick="removeItem(this, '/destroy-cart/${
								val.cart_item_id
							}', ${results.suser_id})">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>`;
					$('#buy-cart').html(html);
					$('.total-buy').html(
						formatCurrency(val.price * val.quantity)
					);
				}
				if (results.count) {
					$('#cartCount').html(results.count);
				}

				if (results.data2) {
					let html = '';
					results.data2.forEach((val) => {
						html += `<tr>
							<td>${val.name}</td>
							<td>
								<img src="${val.image}" class="menu-img w-75" alt="" style="height: 60px">
							</td>
							<td class="text-danger">${formatCurrency(val.price)}</td>
							<td class="d-flex align-items-baseline">
								<a type="button" onclick="minus(this, \'/update-cart/${val.cart_item_id}\')">
									<i class="fas fa-minus-circle"></i>
								</a>
								<p class="quantity mx-3 data" data-id="${val.product_id}" data-price="${
							val.price
						}">
									${val.quantity}
								</p>
								<a type="button" onclick="plus(this, \'/update-cart/${val.cart_item_id}\', ${
							val.stock
						})">
									<i class="fas fa-plus-circle"></i>
								</a>
							</td>
							<td class="text-danger price sum-price">
								${formatCurrency(val.price * val.quantity)}
							</td>
							<td class="text-center">
								<a type="button" onclick="removeItem(this, \'/destroy-cart/${
									val.cart_item_id
								}\', ${results.suser_id})">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>`;
					});
					$('.cart-item').html(html);
				}
			}
			total();
		},
		error: function (xhr, status, error) {
			console.error('Lỗi khi gửi form:', error);
			console.error('Phản hồi từ server:', xhr.responseText);
		},
	});
}

function minus(element, url) {
	const quantityElement = $(element).siblings('.quantity');
	let quantity = parseInt(quantityElement.text());

	if (quantity > 1) {
		quantity -= 1;
		quantityElement.text(quantity);
		updateTotalPrice(element, quantity);
		updateCart(url, quantity);
	}
}

function plus(element, url, stock) {
	const quantityElement = $(element).siblings('.quantity');
	let quantity = parseInt(quantityElement.text());

	if (quantity < stock) {
		quantity += 1;
		quantityElement.text(quantity);
		updateTotalPrice(element, quantity);
		updateCart(url, quantity);
	}
}

function updateTotalPrice(element, quantity) {
	const priceElement = $(element).closest('tr').find('.text-danger').first();
	const totalPriceElement = $(element).closest('tr').find('.sum-price');
	const price = parseInt(priceElement.text().replace(/\D/g, '')); // Extract the number

	const totalPrice = price * quantity;
	totalPriceElement.text(formatCurrency(totalPrice));
	total();
	$('.total-buy').html(formatCurrency(totalPrice));
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
			total();
		},
	});
}

function updateCart(url, quantity) {
	$.ajax({
		type: 'POST',
		dataType: 'json',
		data: { quantity: quantity },
		url: url,
		success: function (results) {},
	});
}

function total() {
	const priceRows = $('td.price');
	let total = 0;

	priceRows.each(function () {
		let priceText = $(this).text().trim();
		priceText = priceText.replace(/[^\d]/g, '');
		const price = parseInt(priceText, 10);
		total += price;
	});

	$('.total-cart').html(formatCurrency(total));
}

function payCart(user_id) {
	let total = $('.total-buy').text().trim();
	total = total.replace(/[^\d]/g, '');
	const id = $('#quantity').data('id');
	const quantity = $('#quantity').text().trim();
	const price = $('#quantity').data('price');

	$.ajax({
		type: 'POST',
		dateType: 'json',
		data: {
			id: user_id,
			total: total,
			product_id: id,
			quantity: quantity,
			price: price,
		},
		url: '/add-order',
		success: function (results) {
			if (results.error === false) {
				location.reload();
			} else {
				alert(results.message);
			}
		},
		error: function (xhr, status, error) {
			console.error('Lỗi khi gửi form:', error);
			console.error('Phản hồi từ server:', xhr.responseText);
		},
	});
}

function payCarts(user_id) {
	let total = $('.total-cart').text().trim();
	total = total.replace(/[^\d]/g, '');
	const cartItems = [];
	$('.data').each(function () {
		const item = {
			product_id: $(this).data('id'),
			quantity: $(this).text().trim(),
			price: $(this).data('price'),
		};
		cartItems.push(item);
	});

	$.ajax({
		type: 'POST',
		dateType: 'json',
		data: { id: user_id, total: total, cartItems: cartItems },
		url: '/add-orders',
		success: function (results) {
			if (results.error === false) {
				location.reload();
			} else {
				alert(results.message);
			}
		},
	});
}
