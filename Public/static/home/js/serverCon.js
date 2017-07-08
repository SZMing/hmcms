/**
 * Created by hi on 2017/6/27.
 */
$('.standard .tab1').click(function(){
    $(this).addClass('addBi').find('.duihao').show();
    $('.advanced .tab1').removeClass('addBi').find('.duihao').hide();
})

$('.advanced .tab1').click(function(){
    $(this).addClass('addBi').find('.duihao').show();
    $('.standard .tab1').removeClass('addBi').find('.duihao').hide();
})