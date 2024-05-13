<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
				<div class="modal-body">
					<!-- Form bắt đầu ở đây -->
					<form id="myForm">
						<div class="mb-3">
							<label for="username" class="form-label">Username:</label>
							<input type="text" class="form-control" id="username" name="username" required disabled value="<?php echo $_SESSION['username'] ?>">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email:</label>
							<input type="email" class="form-control" id="email" name="email" required disabled value="<?php echo $_SESSION['email'] ?>">
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Name:</label>
							<input type="text" class="form-control" id="name" name="name" value="<?php if (isset($_SESSION['name'])) {
								echo $_SESSION['name'];
							} ?>">
						</div>
						<div class="mb-3">
							<label for="phone" class="form-label">Phone:</label>
							<input type="number" class="form-control" id="phone" name="phone" value="<?php if (isset($_SESSION['phone'])) {
								echo $_SESSION['phone'];
							} ?>">
						</div>
						<div class="mb-3">
							<label for="address" class="form-label">Address:</label>
							<input type="text" class="form-control" id="address" name="address" value="<?php if (isset($_SESSION['address'])) {
								echo $_SESSION['address'];
							} ?>">
						</div>
						<!-- Thêm các trường form khác nếu cần -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary">Lưu</button>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>