
         <div class="card-body">
         <form action="{{ url()->current() }}" method="get">
                   <div class="row">
                    <div class="col-2">
                        <div class="from-group">
                         <select class="form-control" name="Sort_By">
                            <option disabled selected value="">Sort By</option>
                            <option value="id">Id</option>
                            <option value="name">Name</option>
                            <option value="created_at">Created_at</option>
                         </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="from-group" >
                         <select class="form-control" name="order_by">
                            <option value="asc" selected disabled>Order by</option>
                            <option value="asc">Acs</option>
                            <option value="desc">Des</option>
                       
                         </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="from-group">
                         <select name="limit" class="form-control">
                            <option disabled selected value="">Limit</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="100">100</option>
                         </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="from-group">
                         <select name="status" class="form-control">
                            <option value="" disabled selected>Status</option>
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                         </select>
                        </div>
                    </div>
                     <div class="col-3">
                        <div class="from-group">
                      <input class="form-control" type="text" placeholder="Search here..." name="search">
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="from-group">
                        <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </div>
                   
                </div>
         </form>
            </div>