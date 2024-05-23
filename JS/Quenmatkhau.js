document.getElementById('emailForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Giả sử kiểm tra email thành công
    document.getElementById('emailForm').style.display = 'none';
    document.getElementById('resetPasswordForm').style.display = 'block';
});

document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var newPassword = document.getElementById('newPassword').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        alert('Mật khẩu xác nhận không khớp. Vui lòng thử lại.');
    } else {
        // Xử lý logic đặt lại mật khẩu
        alert('Mật khẩu của bạn đã được đặt lại thành công!');
        window.location.href = 'Dangnhap.html';
    }
});