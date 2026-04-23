 <div class="modal" id="Edit{{$Category->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Edit Category </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.categories.update', $Category->id) }}" method="post">
                            @csrf
                                         @method('PUT')

                            <div class="modal-body">
                                         <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="name" value="{{ $Category->name }}" class="form-control" placeholder="Enter category name" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="SmallDesc" value="{{ $Category->SmallDesc }}" class="form-control" placeholder="Enter description">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option disabled selected >-- Select Status --</option>
                            <option value="1" {{ $Category->status==1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{ $Category->status==0 ? 'selected' : ''}}>deactivate</option>
                        </select>
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