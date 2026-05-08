<div>
      <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">LATEST POSTS</h6>
                                </div>
  <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>title</th>
                <th>Category</th>
                <th>Comment Count</th>
                <th>Status</th>
                @can('posts')
                    
                <th>show</th>
                @endcan
            </tr>
        </thead>
        <tbody>
        @forelse ($latest_posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category?->name }}</td>
                <td>{{ $post->comment->count() }}</td>
                <td>
                    <span class="badge bg-info">Active</span>
                </td>
                <td>
                    @can('posts')
                        
                    <a class="btn btn-sm btn-info"
                    href="{{ route('admin.posts.show', $post->id) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
                @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No posts found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
                            </div>

                            <!-- Color System -->
                       
                        </div>
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Last Comment</h6>
                                </div>
       <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Post</th>
                <th>Comment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($latest_comment as $comment)
            <tr>
                <td>{{ $comment->user->name }}</td>
<td>
  @can('posts')
        <a href="{{ route('admin.posts.show', $comment->post->id) }}">
        {{ $comment->post?->title }}
    </a>
  @endcan
  @cannot('posts')
       {{ $comment->post?->title }}
  @endcannot
</td>                <td>{{ substr($comment->comment, 0, 30) }}...</td>

                <td>
                    @if($comment->status == 1)
                        <span class="badge bg-info">Active</span>
                    @else
                        <span class="badge bg-danger">Non Active</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    No Comment found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
                            </div>

                            <!-- Color System -->
                       
                        </div>

                    
                    </div>
   
                            </div>