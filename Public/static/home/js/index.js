/**
 * Created by hi on 2017/6/22.
 */

/*轮播图*/
var mySwiper = new Swiper ('.swiper-container', {
    direction: 'vertical',
    loop: true,
    autoplay: 3000,
    direction : 'horizontal',
    pagination: '.swiper-pagination',
    noSwipingClass : 'stop-swiping',
    paginationClickable :true,
    autoplayDisableOnInteraction : false

})
/*轮播图下面的字*/
 var textSwiper = new Swiper('.line-container', {
    direction : 'vertical',
    loop : true,
    autoplay : 2000,
    noSwipingClass : 'stop-swiping'
})

/*解决方案*/
$('.slove li').hover(function(){
    $(this).animate({'width':'420px'},0).siblings('li').animate({'width':'90px'},0)
})

/*新闻切换*/
$('.news_nav div').click(function(){
    $(this).find('span').addClass('addSpan').parents('div').siblings().find('span').removeClass('addSpan')
})