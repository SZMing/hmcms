/**
 * Created by hi on 2017/6/29.
 */
var mySwiper = new Swiper('.swiper-container', {
    direction : 'horizontal',
    loop : true
});
/*轮播图的字动*/
var textSwiper = new Swiper('.swiper-text', {
    direction : 'vertical',
    loop : true,
    autoplay : 2000,
    noSwipingClass : 'stop-swiping'
})

$('.tabs span').click(function(){
    $(this).addClass('active').parents('.aui-tab-item').siblings().find('span').removeClass('active')
     if($(this).parents('.aui-tab-item').index() == 0){
        $('.wangou').show();
         $('.meiti').hide();
     }else {
         $('.wangou').hide();
         $('.meiti').show();
     }
})
