          <div class="modal fade" id="Realted_site" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form action="{{ route('admin.related_site.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">Add Realted_site</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Realted_site Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Realted_site name" required>
                    </div>

                    <div class="form-group">
                        <label>URl</label>
                        <input type="text" name="url" class="form-control" placeholder="Enter Realted_site Url">
                    </div>

             

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Realted_site</button>
                </div>

            </form>

        </div>
    </div>
</div>