$(function () {
    var $banner = $(".sn_banner");
    var width = $banner.width();
    var $imageBox = $(".sn_banner ul:first-child");
    var $pointBox = $(".sn_banner ul:last-child");
    var $points = $pointBox.find('li');
    // console.log(width);
    function animateFuc(){
        $imageBox.animate({transform: "translateX(" + (-index * width)+ "px)"}, 200, function () {
            if (index >= 9) {
                index=1;
                $imageBox.css({transform:'translateX('+(-index*width)+'px)'});
                // $imageBox.css('transform', 'translateX('+(-index*width)+'px)')
            }else if (index <= 0) {
                index = 8;
                $imageBox.css({transform:'translateX('+(-index*width)+'px)'});
                // $imageBox.css('transform', 'translateX('+(-index*width)+'px)')
            }
            $points.removeClass('now').eq(index-1).addClass('now')
        });
    }
    var index =1;
    var timer = setInterval(function () {
        index++;
        // console.log(index);
        animateFuc();
    },3000);
    $banner.on('swipeLeft',function () {
        index ++;
        animateFuc();
    });
    $banner.on('swipeRight',function () {
        index --;
        animateFuc();
    });


});