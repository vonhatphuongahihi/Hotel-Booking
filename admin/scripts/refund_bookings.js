function get_bookings(search='') {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/refund_bookings.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('table-data').innerHTML = this.responseText;
    };

    xhr.send('get_bookings&search=' + search);
}


function cancel_booking(id) {
    if (confirm('Bạn có chắc chắn muốn hủy đơn đặt phòng này?')) {
        let data = new FormData();
        data.append('booking_id', id);
        data.append('cancel_booking', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/new_bookings.php", true);

        xhr.onload = function() {
            if (this.responseText == 1) {
                alert('success', 'Hủy đơn đặt phòng thành công');
                get_bookings();
            } else {
                alert('error', 'Hủy đơn đặt phòng thất bại!');
            }
        };
        xhr.send(data);
    }
}

window.onload = function() {
    get_bookings();
};