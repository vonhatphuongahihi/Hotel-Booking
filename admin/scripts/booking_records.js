function get_bookings(search='',page=1) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/booking_record.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        document.getElementById('table-data').innerHTML = data.table_data;
    };

    xhr.send('get_bookings&search=' + search+'&page='+page);
}

window.onload = function() {
    get_bookings();
};
