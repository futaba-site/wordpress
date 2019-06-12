$youziku.load("body", "22fbd505f4c5406c901fe6e2a7aef4a4", "youziku");
$youziku.draw();
jQuery(document).ready(function($){

    /**
     * 获取页面数值
     */
    let w_width = $(window).width();
    let w_height = $(window).height();
    let d_height = $(document).height();
    $(window).resize(function(){
        w_width = $(window).width();
        w_height = $(window).height();
    });

    /**
     * 滚动条上端距离监听
     */
    let scroll_top = 0;

    $(window).scroll(function(){
        scroll_top = $(window).scrollTop();

        // 顶端横向滚动条
        let top_width = w_width*(scroll_top/(d_height-w_height));
        $('#header-scrollbar').width(top_width);

        /**
         * 顶部菜单栏透明度变化
         */
        if(scroll_top < 3) {
            $('header').css({
                'background-color': 'transparent',
            });
            $('#header-nav').css({
                'margin-top': '20px',
                'opacity': '0',
                'visibility': 'hidden'
            });
            $('#right-scrollbar').css('top', '-900px');
        }
        else {
            $('header').css({
                'background-color': 'rgba(255,255,255,.95)',
            });
            $('#header-nav').css({
                'margin-top': '0',
                'opacity': '1',
                'visibility': 'visible'
            });
            $('#right-scrollbar').css('top', '0');
        }
    });

    /**
     * header被hover手动触发动画
     */
    $('header').mouseover(function(){
        if(scroll_top < 3) {
            $(this).css({
                'background-color': 'rgba(255,255,255,.95)',
            });
            $('#header-nav').css({
                'margin-top': '0',
                'opacity': '1',
                'visibility': 'visible'
            });
        }
    }).mouseout(function(){
        if(scroll_top < 3) {
            $(this).css({
                'background-color': 'transparent',
            });
            $('#header-nav').css({
                'margin-top': '20px',
                'opacity': '0',
                'visibility': 'hidden'
            });
        }
    })

    // 右侧置顶条动作
    $('#right-scrollbar').click(function(){
        $('html,body').finish().animate({'scrollTop': "0"},500);
    });

    // 底部时间计数
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth()+1;
    var day = date.getDate();
    function timeIn(y, m, d) {
        var days = 0;
        var month_days = new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
        for(var i = 2017;i < y;i++)
            if(i%4==0 && i%100!=0 || i%400==0)
                days += 366;
            else
                days += 365;
        if(y%4==0 && y%100!=0 || y%400==0)
            month_days[2] =29;
        for(var i=0;i < m;i++)
            days += month_days[i];
        days += d;
        return days;
    }
    $('#bottom-time').text(timeIn(year, month, day));

    // $('img.lazy').lazyload({
    //     event: 'scrollstop'
    // });
});