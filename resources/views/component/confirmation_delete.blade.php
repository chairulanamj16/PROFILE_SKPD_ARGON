{{-- <!-- Confirmation Delete -->
<div class="modal fade" id="confirmationDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-xs text-secondary" id="confirmationModalLabel">Are you sure?</h5>

            </div>
            <div class="modal-body ">
                <p class="text-sm text-secondary">You won't be able to revert this!</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm" id="confirmDeleteBtn">Yes, delete it!</button>
            </div>
        </div>
    </div>
</div>

<script>
function showDeleteModal(url) {
    $('#confirmationDeleteModal').modal('show');

    // Unbind previous click event and bind new click event
    $('#confirmDeleteBtn').off('click').on('click', function() {
        triggerDeleteModal(url);
        $('#confirmationDeleteModal').modal('hide'); // Hide the modal after triggering delete
    });
}

function triggerDeleteModal(url) {
    console.log(url);
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _method: 'DELETE',
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log(response);
            showToast("success", response.message, response.status);
        },
        error: function(xhr, status, error) {
            Object.keys(xhr.responseJSON.errors).forEach(function(key) {
                var messages = xhr.responseJSON.errors[key];
                messages.forEach(function(message) {
                    showToast('Error!', message, 'error');
                });
            });
        }
    });
}
</script> --}}
