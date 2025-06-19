<!-- Modal -->
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="menuForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuModalLabel">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="menuId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="subdomain" class="form-label">Subdomain</label>
                        <input type="text" class="form-control" id="subdomain" name="subdomain">
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon">
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Menu</label>
                        <input type="hidden" id="parent_id_hidden">
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">None</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-xs btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


