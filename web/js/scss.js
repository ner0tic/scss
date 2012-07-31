$(document).ready(function() {
    // inits
    $('div.table-controls').hide();
    $('#donate-window').hide();
    $('#privacy-window').hide();
    $('#about-window').hide();

    // menu
    $(".menu li.has-sub-menu").hover(
        function () { $("ul",this).slideDown('fast') },
        function () {}
    );
    if(document.all) {
        $(".menu li.has-sub-menu").hoverClass("sfHover");
    }

    //$('.menu li.has-sub-menu').hover(function () {
    //    $(this).find('ul').toggle();
    //    $(this).css('background','red');
    //    $(this).css('display','inline');
        //$(this).css('background','transparent url(/images/toggle_up_dark.png) no-repeat right 5px');
    //},
    //function () {
    //    $(this).find('ul').toggle();
        //$(this).css('background','transparent url(/images/toggle_down_light.png) no-repeat right 5px');
    //});

    // data tables
    $('tr.table-row').hover(function () {
        $(this).find('div.table-controls').show();
    },
    function () {
        $(this).find('div.table-controls').hide();
    });
    
    $('input.change-active-input').bind('focus',function() {
      $('.display-active-troop').css({opacity:0.3});
    });
    $('input.change-active-input').bind('change',function() {
      $('.display-active-troop').hide();
      $('.display-active-troop').text($(this).val());
    });
    $('input.change-active-input').bind('blur',function() {
      $('.display-active-troop').css({opacity:1});
    });
    
    // troop settings
    $('legend').click(function() {
      $(this).siblings().slideToggle('slow');
      
    });
    
    // windows
    $('.donate-tab').click(function () {
        $('.window').hide();
        $('.tab-active').removeClass('tab-active');
        $('#donate-window').show();
        $(this).addClass('tab-active');
    });
    $('#donate-window > span.window-close').click(function () {
        $('#donate-window').hide();
        $('.donate-tab').removeClass('tab-active');
    });
    $('.privacy-tab').click(function () {
        $('.window').hide();
        $('.tab-active').removeClass('tab-active');
        $('#privacy-window').show();
        $(this).addClass('tab-active');
    });
    $('#privacy-window > span.window-close').click(function () {
        $('#privacy-window').hide();
        $('.privacy-tab').removeClass('tab-active');
    });
    $('.about-tab').click(function () {
        $('.window').hide();
        $('.tab-active').removeClass('tab-active');
        $('#about-window').show();
        $(this).addClass('tab-active');
    });
    $('#about-window > span.window-close').click(function () {
        $('#about-window').hide();
        $('.about-tab').removeClass('tab-active');
    });
    $('.tab-active').click(function () {
        $('.window').hide();
        $('.tab-active').removeClass('tab-active');
    });

    // active enrollment --old
    $('.active-troop').click(function(e) {
        e.preventDefault();
        $('fieldset#active-enrollment-menu').toggle();
        $('.active-troop').toggleClass("menu-open");
    });
    $('fieldset#active-enrollment-menu').mouseup(function() {
        return false;
    });
    $(document).mouseup(function(e) {
        if($(e.target).parent('a.active-troop').length==0) {
            $('.active-troop').removeClass("menu-open");
            $('fieldset#active-enrollment-menu').hide();
        }
    });
    
    // active enrollment - change troop
    var dropdownActiveClass = 'dropdown-active', showingDropdown, showingDropdownContent, showingDropdownParent;
    var hideDropdownContent = function () {
      if(showingDropdown) {
        showingDropdown.removeClass(dropdownActiveClass);
        showingDropdownContent.hide();
      }
    };
    $('.dropdown').each(function () {
      var dropdown = $(this);
      var dropdownContent = dropdown.next('div.dropdown-content'), dropdownParent = dropdown.parent();
      var showDropdownContent = function () { 
        hideDropdownContent(); 
        showingDropdown = dropdown.addClass(dropdownActiveClass);
        showingDropdownContent = dropdownContent.show();      
        showingParent = dropdownParent;
      };
      dropdown.bind('click',function (e) {
        if(e) {
          e.stopPropagation();
          e.preventDefault();
        }
        showDropdownContent();
      });
      dropdown.bind('focus', function () {
        showDropdownContent();
      });
    });
    $(document.body).bind('click',function(e) {
      if(showingDropdownParent) {
        var dropdownParentElement = showingDropdownParent[0];
        if(!$.contains(dropdownParentElement,e.target) || !dropdownParentElement == e.target) {
          hideDropdownContent();
        }
      }
    });
});
$.fn.hoverClass = function(c) {
    return this.each(function() {
        $(this).hover(
            function () { $(this).addClass(c); },
            function () { $(this).removeClass(c); });
    });
};
