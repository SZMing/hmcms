/**
 * Created by hi on 2017/6/23.
 */

$('.Submenu li').click(function(){
    $(this).addClass('addLib').siblings('li').removeClass('addLib')
    $(this).find('a').addClass('addA').parents('li').siblings('li').find('a').removeClass('addA')
})

