import './bootstrap';
if(role=="user"){
    window.Echo.private('users.'+id)
.notification((event)=>{
    let link=showpost.replace(':slug',event.post_slug)+'?notify='+event.id;
    $('#push-notifaction').prepend(`
         <div class="dropdown-item d-flex justify-content-between align-items-center gap-2">

            
            <span class="small text-dark">
                new comment on post:
                <span class="text-primary">
                   ${ event.post_title.substring(0,9)}...
                </span>
            </span>

            <a href="${link}"
               class="text-decoration-none text-primary">
                <i class="fa fa-eye"></i>
            </a>
            <a href="${event.delete_link.replace('__id__',event.id)}"
               class="text-decoration-none text-primary">
                <i class="fa fa-trash"></i>
            </a>

        </div>
        `);
         var count=Number($('#count-notifaction').text());
         count++
         $('#count-notifaction').text(count);

});
}

///////// lesting admin ////////////////
if(role=="admin"){
    window.Echo.private(`admins.${window.adminId}`)
.notification((event)=>{
  $('#notify_push').prepend(`
        
                 <a class="dropdown-item d-flex align-items-center" href="${event.link}?notifyadmin=${event.id}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">${event.created_at}</div>
                                        <span class="font-weight-bold">${event.title}</span>
                                    </div>
                                </a>
        `)

        var count=Number($('#count-push').text());
        count++
        $('#count-push').text(count);
});
}