<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" >
        <div class="toast-header">
            <strong class="mr-auto toast-title"></strong>
        </div>
        <div class="toast-body toast-content text-white">
            Toast Content
        </div>
    </div>
</div>

<div id="toast-container" aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

<script>
function showToast(title, body, type) {
    // Buat elemen toast baru
    var toastElement = $('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"></div>');
    var toastHeader = $('<div class="toast-header"></div>');
    var toastTitle = $('<strong class="mr-auto toast-title"></strong>').text(title);
    var toastBody = $('<div class="toast-body toast-content text-white"></div>').text(body);

    // Atur warna latar belakang berdasarkan tipe
    if (type === 'success') {
        toastElement.addClass('bg-success');
    } else if (type === 'error') {
        toastElement.addClass('bg-danger');
    } else if (type === 'info') {
        toastElement.addClass('bg-info');
    } else if (type === 'warning') {
        toastElement.addClass('bg-warning');
    }

    // Gabungkan elemen-elemen toast
    toastHeader.append(toastTitle);
    toastElement.append(toastHeader);
    toastElement.append(toastBody);

    // Tambahkan elemen toast ke dalam container
    $('#toast-container').append(toastElement);

    // Panggil toast
    toastElement.toast('show');

    // Hilangkan elemen toast setelah ditampilkan
    toastElement.on('hidden.bs.toast', function () {
        $(this).remove();
    });
}
</script>
