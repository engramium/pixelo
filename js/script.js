jQuery( document ).ready(function() {
    const mobileNav = jQuery('#toggleMyMenu');
    const navToggle = jQuery('.mobile-menu');
    const openBurger = jQuery('.open__burger');
    const closeBurger = jQuery('.close__burger');
    let isOpen = 0;
    let isOpenSearch = 0;

    // Menu Positioning depending on logo/header height
    let currentHeight = jQuery('header').innerHeight();
    // console.log(currentHeight);  
    jQuery(mobileNav).css({ top: currentHeight + 47 });


    jQuery(navToggle).click(function(){
        if(isOpen == 0) {
            TweenLite.to(mobileNav, 0.5, { display:'block', opacity: 1, ease: " power2. inOut", y: -46 });
            jQuery(openBurger).hide();
            jQuery(closeBurger).show();
            jQuery(closeBurger).css('display', 'block');
            // console.log("isOpen");
            isOpen++;
        } 
    });

    jQuery('#search__button').click(function(){
      if(isOpenSearch == 0) {
        jQuery("#search_underlayer").show();
        TweenLite.to('#search__popup', 0.5, { display:'block', opacity: 1, ease: " power2. inOut", y: -46 });
        isOpenSearch++;
      }
    });

    jQuery('#search_underlayer').click(function(){
        jQuery("#search_underlayer").hide();
        isOpenSearch--;
    });

    // Menu.
    var $menu = jQuery('.custom-menu-class'),
    $menu_openers = $menu.children('ul').find('.menu-item-has-children > a');

    // Openers.
    $menu_openers.each(function() {
        var $this = jQuery(this);

        $this.on('click', function(event) {
            // Prevent default.
            event.preventDefault();
            var isMultiLevel = jQuery(this).parent().parent().hasClass('sub-menu');

            // Toggle.
            if ( !isMultiLevel ) {
                $menu_openers.not($this).parent("li").removeClass('is-submenu-open');
            }
            // $menu_openers.not($this).removeClass('is-submenu-open');
            $this.parent("li").toggleClass('is-submenu-open');
        });
    });

    // Hide dropdown menu after clicking outside element
    jQuery(document).on("click", function(event){
        var $tergetEle = jQuery(event.target).parent().hasClass('menu-item-has-children');
        var $trigger = jQuery(".menu-item-has-children");
        if( $trigger !== event.target && !$trigger.has(event.target).length && !$tergetEle ){
            if ( !$tergetEle ) {
                $trigger.removeClass("is-submenu-open");
            }
        }            
    });

    // IE/Edge fallback for responsive images while 'object-fit' property is not supported
    function ObjectFitIt() {
      jQuery('img.objFit').each(function(){
        var imgSrc = jQuery(this).attr('src');
        var fitType = 'cover';

        if(jQuery(this).data('fit-type')) {
          fitType = jQuery(this).data('fit-type');
        }

        jQuery(this).parent().css({ 'background' : 'transparent url("'+imgSrc+'") no-repeat center center/'+fitType, });
        jQuery('img.objFit').css('display','none'); });
    }

    if('objectFit' in document.documentElement.style === false) {
        ObjectFitIt();
    }

});


