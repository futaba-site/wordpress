jQuery(document).ready(function($) {

    hljs.initHighlightingOnLoad();

    $("pre code").each(function() {
        $(this).html("<ul><li>" + $(this).html().replace(/\n/g, "\n</li><li>") + "\n</li></ul>");
    });
    $("#single-entry a").each(function(){
        $(this).html('<svg class="icon svg-icon" aria-hidden="true"><use xlink:href="#icon-tag"></use></svg>' + $(this).html());
    });

    $("#qqId").blur(function(){
        qqInfo($(this).val());
    });

    var qqInfo = function(id) {
        $.ajax({
            type: 'GET',
            url: 'https://api.sometimesnaive.com.cn/qqInfo.php',
            data: {id: id},
            dataType: 'json',
            success: function(data) {
                if(!data['name_error']) {
                    $('#qqName').val(data['name']);
                    $('#qqEmail').val(id+'@qq.com');
                }
                if(!data['url_error']) {
                    $('#comments-input-avatar img').attr('src', data['url']);
                }
            },
            error: function(re,status) {
                console.log(status);
            }
        })
    }

    $("#comments-submit").click(function(){
        $("#comments-form").submit();
    });

    $('.comment-reply-bottom').click(function(){
        var parent = $(this).parents('.comment');
        parent.after($('#comments-form'));
        $('#comments-form .comment-reply-cancel').css({
            'opacity': '1',
            'visibility': 'visible'
        });
        $('#comments-form #comment_parent').val(parent.attr('data-id'));
    });
    $('.comment-reply-cancel').click(function(){
        $(this).css({
            'opacity': '0',
            'visibility': 'hidden'
        });
        $('#comments-list').after($('#comments-form'));
        $('#comments-form #comment_parent').val(0);
    });
});