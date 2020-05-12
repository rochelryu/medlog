$(document).ready(function(){
    $('.tabgroup > div').hide();
    $('.tabgroup > div:first-of-type').show();
    $('.tabs a').click(function(e){
        e.preventDefault();
        var $this = $(this),
            tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),
            others = $this.closest('li').siblings().children('a'),
            target = $this.attr('href');
        others.removeClass('active');
        $this.addClass('active');
        $(tabgroup).children('div').hide();
        $(target).show();
    
    })

    var waypoint = new Waypoint({
        element: document.getElementById('navbar'),
        handler: function(direction) {
            
            if(direction === 'up'){
                $('#navbar').removeClass('fixed');
                
            }
            else{
                $('#navbar').addClass('fixed');
            }
        },
    });
});