/**
 * Created by hi on 2017/7/3.
 */

var list1 = $('.list1')
var list2 = $('.list2')
$('.tabs span').click(function(){
    if( $(this).index() == 0 ){
        list1.show();
        list2.hide();
        $(this).find('a').addClass('addLi').parents('span').siblings('span').find('a').removeClass('addLi')
    }else {
        list1.hide();
        list2.show();
        $(this).find('a').addClass('addLi').parents('span').siblings('span').find('a').removeClass('addLi')
    }
})