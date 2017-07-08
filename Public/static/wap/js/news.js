/**
 * Created by hi on 2017/6/29.
 */
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