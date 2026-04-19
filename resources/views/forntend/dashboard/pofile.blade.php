@extends('layout.forntend.app')
@section('title')
 Porfile  
@endsection

@section('body')
    <!-- Profile Start -->
<div class="dashboard container">
  <!-- Sidebar -->
@include('forntend.dashboard.sidebar',['porfile_active'=>'active'])


  <!-- Main Content -->
  <div class="main-content">
      <!-- Profile Section -->
      <section id="profile" class="content-section active">
          <h2>User Profile</h2>
          <div class="user-profile mb-3">
              <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
              <span class="username">{{ auth()->user()->name }}</span>
          </div>
          <br>
    @if (session()->has('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach (session('errors')->all() as $error )
            <li>{{ $error }}</li>
            
            @endforeach
        </ul>
    </div>
    
    @endif
<form action="{{ route('forntend.dashboard.post.store') }}" method="post" enctype="multipart/form-data">
@csrf

          <!-- Add Post Section -->
          <section id="add-post" class="add-post-section mb-5">
              <h2>Add Post</h2>
              <div class="post-form p-3 border rounded">
                  <!-- Post Title -->
                  <input name="title" type="text" id="postTitle" class="form-control mb-2" placeholder="Post Title" />
                  <textarea name="SmallDesc" type="text" id="SmallDesc" class="form-control mb-2" placeholder="Enter Small desc" ></textarea>

                  <!-- Post Content -->
                  <textarea name="desc" id="summernote" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                  <!-- Image Upload -->
                  <input name="images[]" type="file" id="postImage" class="form-control mb-2" accept="image/*" multiple />
                  <div class="tn-slider mb-2">
                      <div id="imagePreview" class="slick-slider"></div>
                  </div>

                  <!-- Category Dropdown -->
                  <select name="category_id" id="postCategory" class="form-select mb-2">
                    <option value="" selected>--Select Category --</option>
                    @foreach ( $categories as $category )
                        
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>

                  <!-- Enable Comments Checkbox -->
                  <label class="form-check-label mb-2">
                      <input name="comment_able" type="checkbox" class="form-check-input" /> Enable Comments
                  </label><br>

                  <!-- Post Button -->
                  <button type="submit" class="btn btn-primary post-btn">Post</button>
              </div>
          </section>
</form>
          <!-- Show Posts  -->
          <section id="posts" class="posts-section">
              <h2>Recent Posts</h2>
              <div class="post-list">
                  <!-- Post Item -->
                  @forelse ($postsuser as $post )
                  <div class="post-item mb-4 p-3 border rounded">
                      <div class="post-header d-flex align-items-center mb-2">
                          <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="rounded-circle" style="width: 50px; height: 50px;" />
                          <div class="ms-3">
                              <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                            
                          </div>
                      </div>
                
                          
                      <h4 class="post-title"><a href="{{ route('forntend.post.show',$post->slug) }}">{{ $post->title }}</a></h4>
                      <p class="post-content">{!! chunk_split($post->desc,78,'<br>') !!}</p>
                 
@if($post->images->count()>0)
                <div id="newsCarousel{{ $post->id }}" class="carousel slide">
    
    <ol class="carousel-indicators">
        @foreach ($post->images as $image)
            <li 
                data-target="#newsCarousel{{ $post->id }}" 
                data-slide-to="{{ $loop->index }}" 
                class="{{ $loop->first ? 'active' : '' }}">
            </li>
        @endforeach
    </ol>
                          <div class="carousel-inner">
                           @foreach ($post->images as $image )
                                  <div class="carousel-item  @if ($loop->index==0) active @endif ">
                                  <img style="width: 678px; height: 508px;" src="{{ asset($image->path)}}" class="d-block w-100" alt="First Slide">
                                  <div class="carousel-caption d-none d-md-block">
                                      <h5 style="color: #fff; text-shadow: 2px 2px 6px rgba(0,0,0,0.8); font-weight: bold;">{{ $post->title }}</h5>
                       
                                      
                            
                                  </div>
                              </div>
                              @endforeach
  
                              <!-- Add more carousel-item blocks for additional slides -->
                          </div>
                          <a class="carousel-control-prev" href="#newsCarousel{{ $post->id }}" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#newsCarousel{{ $post->id }}" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                          </a>
                          
                      </div>
   @endif
                      <div class="post-actions d-flex justify-content-between">
                          <div class="post-stats">
                              <!-- View Count -->
                              <span class="me-3">
                                  <i class="fas fa-eye"></i> {{ $post->numer_of_view }}
                              </span>
                          </div>

                          <div>
                              <a href="{{ route('forntend.dashboard.post.edit',$post->slug) }}" class="btn btn-sm btn-outline-primary">
                                  <i class="fas fa-edit"></i> Edit
                              </a>
                             <a class="btn btn-sm btn-outline-danger" data-effect="effect-scale"
                                                       data-toggle="modal"
                                                       href="#delete{{$post->id}}" title="delete">  <i class="fas fa-trash"></i> Delete</a>
                                                           <button id="getcommit_{{ $post->id }}" class="btncommit" post-id="{{ $post->id }}" class="btn btn-sm btn-outline-secondary">
                                  <i class="fas fa-comment"></i> Comments
                            </button>
                                                           <button id="hide_commit_{{ $post->id }}" style="display: none" class="hide_commit" post-id="{{ $post->id }}" class="btn btn-sm btn-outline-secondary">
                                  <i class="fas fa-comment"></i>    Hide Comments
                            </button>
                          </div>
                      </div>
 <!-- Display Comments -->
                        <div id="displaycomment_{{ $post->id }}" class="comments" style="display: none">
                              
                           
                          <!-- Add more comments here for demonstration -->
                         </div>
                    
                  </div>

                  <!-- Add more posts here dynamically -->
                  @empty
                  <div class="alert alert-info"> NO posts</div>
                     @endforelse
                  
              </div>
          </section>
      </section>
      @foreach ($postsuser as $post)
          
   
      <div class="modal" id="delete{{$post->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete post</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{route('forntend.dashboard.post.delete', $post->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <p>Do you sure wabt delete the post</p><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                            </div>
                            </form>
	
                        </div>
                    </div>
                    @endforeach
  </div>
</div>
<!-- Profile End -->
@endsection
@push('js')
<script>
    
    $(function(){
        
        $('#postImage').fileinput({
             theme: 'fa5',
               showCancel: true,
                allowedFileTypes: ['image'],
                 maxFileCount: 5,
                 enableResumableUpload: false,
                 showUpload: false
        });
         $('#summernote').summernote({
              placeholder: 'Whats on your mind?',
        tabsize: 2,
        height: 100,
       
         });
    })
    //get post comment
    $(document).on('click','.btncommit',function(e){
     e.preventDefault();
    var postId=$(this).attr('post-id')
     let url ="{{ route('forntend.dashboard.post.getallcomment',':id') }}"
     url=url.replace(':id',postId)
    $.ajax({
        url: url,
        type: "get",
     

        success:function(responce){
            $('#displaycomment_'+postId).empty()
   $.each(responce.data,function(index,comment){
       $('#displaycomment_'+postId).append(`  <div class="comment">
        <img src="${comment.user.image}" alt="User Image" class="comment-img" />
        <div class="comment-content">
            <span class="username">${comment.user.name}</span>
            <p class="comment-text">${comment.comment}</p>
            </div>
            </div>`);
            });
             $('#displaycomment_' + postId).show(); 
             $('#getcommit_'+postId).hide();
             $('#hide_commit_'+postId).show();
        },
        error:function(){

        }
    });
    });
    $(document).on('click','.hide_commit',function(e){
        var post_id=$(this).attr('post-id')
        e.preventDefault();
        $('#displaycomment_'+post_id).hide();
        $('#hide_commit_'+post_id).hide();
         $('#getcommit_'+post_id).show();
    })
</script>
    
@endpush