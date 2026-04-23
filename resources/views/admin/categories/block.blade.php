 <div class="modal" id="Block{{$Category->id}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Active </h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.category.changestatus', $Category->id) }}" method="post">
                            @csrf

                            <div class="modal-body">
                                @if ($Category->status == 1)
                                    <p>Do You want deactivate the Category </p>
                                @else
                                    <p>Do You want Actived the Category </p>

                                @endif
                                <input disabled name="Category" value="{{ $Category->name }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                 @if ($Category->status == 1)
                                <button type="submit" class="btn btn-secondary">Block</button> 
                                @else
                                <button type="submit" class="btn btn-success">Active</button> 
@endif
                            </div>
                    </div>
                    </form>

                </div>
            </div>