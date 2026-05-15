 <div class="modal" id="Edit{{$R->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Edit Realted_site </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        
                        <form action="{{ route('admin.related_site.update', $R->id) }}" method="post">
                            @csrf
                                         @method('PUT')

                            <div class="modal-body">
                                         <div class="form-group">
                        <label>Realted_site Name</label>
                        <input type="text" name="name" value="{{ $R->name }}" class="form-control" placeholder="Enter Realted_site name" required>
                    </div>

                    <div class="form-group">
                        <label>Url</label>
                        <input type="text" name="url" value="{{ $R->url }}" class="form-control" placeholder="Enter Url">
                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>