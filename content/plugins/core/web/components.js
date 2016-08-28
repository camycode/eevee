
$.components = {
    file: {},
    post: {},
    selector: {},
    user: {}
};

// 垂直导航栏
$('#eevee-sidebar .menu').navgoco({
    openClass: 'active',
    accordion: true,
    slide: {
        duration: 200,
        easing: 'swing'
    },
    onClickAfter: function (e, submenu) {
        $('#eevee-sidebar .menu .item').removeClass('active');
        $(e.target).parents('.item').addClass('active');
    }
});


// 配置头部导航菜单
$('.ui.selection.dropdown').dropdown();


$('.ui.menu .ui.dropdown').dropdown({
    on: 'click'
});