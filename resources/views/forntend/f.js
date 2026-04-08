  $(document).on('submit','#commentform',function(e){
     e.preventDefault();
      var formdata= new FormData ($(this)[0]);
          $('#commentid').val('');
     $.ajax({
      url:"{{ route('forntend.post.comment.store') }}",
      type: 'Post',
      data: formdata,
      processData:false,
      contentType:false,
      success:function(data){
                $('#errormessage').hide();
  $('.comments').prepend(`   <div class="comment">
                    <img src="${data.data.user.image}}" alt="User Image" class="comment-img" />
                    <div class="comment-content">
                      <span class="username">${data.data.user.name}</span>
                      <p class="comment-text">${data.data.comment}</p>
                    </div>
                </div>`);

      },
      error:function(data){
         var response=$.parseJSON(data.responseText);
         $('#errormessage').text(response.errors.comment).show();
      },
     });
    });
   </script>