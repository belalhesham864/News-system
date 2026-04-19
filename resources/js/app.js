import './bootstrap';
window.Echo.private('users.'+id)
.notification((event)=>{
    $('#push-notifaction').prepend(`
         <div class="dropdown-item d-flex justify-content-between align-items-center gap-2">

            
            <span class="small text-dark">
                new comment on post:
                <span class="text-primary">
                   ${ event.post_title.substring(0,9)}...
                </span>
            </span>

            <a href="${event.link}?notify=${event.id}"
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