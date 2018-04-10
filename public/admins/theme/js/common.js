/**
 * Elektron - An Admin Toolkit
 * @version 0.3.1
 * @license MIT
 * @link https://github.com/onokumus/elektron#readme
 */
'use strict';

/* eslint-disable no-undef */
$(function () {
	if ($(window).width() < 992) {
		$('#app-side').onoffcanvas('hide');
	} else {
		$('#app-side').onoffcanvas('show');
	}

	$('.side-nav .unifyMenu').unifyMenu({ toggle: true });

	$('#app-side-hoverable-toggler').on('click', function () {
		$('.app-side').toggleClass('is-hoverable');
		$(undefined).children('i.fa').toggleClass('fa-angle-right fa-angle-left');
	});

	$('#app-side-mini-toggler').on('click', function () {
		$('.app-side').toggleClass('is-mini');
		$("#app-side-mini-toggler i").toggleClass('icon-menu5 icon-sort');
	});

	$('#onoffcanvas-nav').on('click', function () {
		$('.app-side').toggleClass('left-toggle');
		$('.app-main').toggleClass('left-toggle');
		$("#onoffcanvas-nav i").toggleClass('icon-menu5 icon-sort');
	});	

	$('.onoffcanvas-toggler').on('click', function () {
		$(".onoffcanvas-toggler i").toggleClass('icon-chevron-thin-left icon-chevron-thin-right');
	});
});


// $(function() {
// 	$('#unifyMenu')
// 	.unifyMenu()
// 	.on('shown.unifyMenu', function(event) {
// 			$('body, html').animate({
// 					scrollTop: $(event.target).parent('li').position().top
// 			}, 600);
// 	});
// });

// Bootstrap Tooltip
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})


// Bootstrap Popover
$(function () {
  $('[data-toggle="popover"]').popover()
})
$('.popover-dismiss').popover({
  trigger: 'focus'
})


// Todays Date
$(function() {
	var interval = setInterval(function() {
		var momentNow = moment();
		$('#today-date').html(momentNow.format('MMMM . DD') + ' '
		+ momentNow.format('. dddd').substring(0,5).toUpperCase());
	}, 100);
});


// Task list
$('.task-list').on('click', 'li.list', function() {
	$(this).toggleClass('completed');
});


/*date range*/
$('.input-daterange input').each(function() {
    $(this).datepicker('clearDates');
});

$('.stream-search-head').on('click', ()=>{
	$(".stream-search-open").toggleClass("hide");
	$(".search-div-right").addClass("hide");
	
});
	// click outside to remove this div
$('body').on('click', function (event) {
	if ((!$(event.target).closest("#stream-search-open").length) &  !($(event.target).closest(".stream-search-head").length)) {
		$(".stream-search-open").addClass("hide");
	$(".search-div-right").removeClass("hide");
	}
   });
   
//    select this dropdown value
$(".search-open-left ul li").on('click', function(){
	var valtext = $(this).children('.open-left-icon').text().trim();
	$(".search-open-left ul li").removeClass('active');
	$(this).addClass("active");
	$(".pbl-search-inner input").val(valtext);
})

$('.search-div .search-angle-down').on('click', function(){
	$(this).find('ul').toggleClass('hide');
});
$('.pbl-btm-search .search-angle-down').on('click', function(){
	$(this).find('ul').toggleClass('hide');
});
$('.pbl-open').on('click', function(){
	$(this).parent().find('.pbl-search-open').toggleClass('hide');
});
$('.shrink-attach').on('click', ()=>{
	$(".upload-file").toggleClass("hide");
	$(".schedule").addClass("hide");
});

$('.shrink-form .input-group').on('click', ()=>{
	$(".shrink-btn").removeClass("hide");
});

$('.shrink-form .input-group').on('focusout', ()=>{
	$(".shrink-btn").removeClass("hide");
	$(".shrink-btn").toggleClass("hide");
});



$('.add-stream-btn .btn-drop').on('click', ()=>{
	$(".add-stream-btn .btn-drop ul").toggleClass("hide");
});

$('.file-close').on('click', ()=>{
	$(".upload-file").addClass("hide");
	
});
$('.shrink-calc').on('click', ()=>{
	$(".schedule").toggleClass("hide");
	$(".upload-file").addClass("hide");
});
$('#tw-tab').on('click', function(){
	$('#fb').removeClass('active');
	$('#fb-tab').addClass('active');
});
$('#fb-tab').on('click', function(){
	$('#fb').addClass('active');
});
$('.sh-right-drop').on('click', function(){
	$(this).find('.sh-drop-opt').toggleClass('hide');
});

$('.sch-drop').on('click', function(){
	$(this).find('.str-sch-droplist').toggleClass('hide');
});

$('.option-drop').on('click', function(){
	$(this).find('.str-option-droplist').toggleClass('hide');
});

$('.cmmt-drop').on('click', function(){
	$(this).find('.cmmt-droplist').toggleClass('hide');
});
$('.cmt-option').on('click', function(){
	$(this).find('.cmt-dropdown').toggleClass('hide');
});
$('.sh-filter').on('click', function(){
	$(this).parent().parent().next().find('.sh-open-search').toggleClass('hide');
});
$('.sh-open-search .input-group-addon .fa-close').on('click', ()=>{
	$(".sh-open-search").addClass("hide");
	
});
/*$('#modal-out-tab').on('click', 'a[data-toggle="tab"]', function(e) {
      e.preventDefault();

      var $link = $(this);

      if (!$link.parent().hasClass('active')) {

        //remove active class from other tab-panes
        $('.tab-content:not(.' + $link.attr('href').replace('#','') + ') .tab-pane').removeClass('active');

        // click first submenu tab for active section
        $('a[href="' + $link.attr('href') + '_all"][data-toggle="tab"]').click();

        // activate tab-pane for active section
        $('.tab-content.' + $link.attr('href').replace('#','') + ' .tab-pane:first').addClass('active');
      }

    });*/

/*var button='<button class="close" type="button" title="Remove this page">×</button>';
var tabID = 1;
function resetTab(){
	var tabs=$(".stream-tab li:not(:first)");
	var len=1
	$(tabs).each(function(k,v){
		len++;
		$(this).find('a').html('Tab ' + len + button);
	})
	tabID--;
}

$(document).ready(function() {
    $('.tab-add').click(function() {
        tabID++;
        $('.stream-tab').append($('<li><a href="#tab' + tabID + '" role="tab" data-toggle="tab">Tab ' + tabID + '<button class="close" type="button" title="Remove this page">×</button></a></li>'));
        $('.tab-content').append($('<div class="tab-pane fade" id="tab' + tabID + '">Tab ' + tabID + ' content</div>'));
    });
    $('.stream-tab').on('click', '.close', function() {
        var tabID = $(this).parents('a').attr('href');
        $(this).parents('li').remove();
        $(tabID).remove();

        //display first tab
        var tabFirst = $('.stream-tab a:first');
        resetTab();
        tabFirst.tab('show');
    });

    var list = document.getElementById("tab-list");
});*/



 $('.network-div .network-list').on('click', function() {
        $('body').addClass('side-ntw-active');

    });
    $('.side-ntw-title span').on('click', function() {
        $('body').removeClass('side-ntw-active');
    });

    $('.ntw-nxt ').on('click', function() {
        $('.ntw-nxt-content').removeClass('hide');
        $('.ntw-content').hide();
    });
    $('.ntw-bk ').on('click', function() {
        $('.ntw-nxt-content').addClass('hide');
        $('.ntw-content ').show();
    });
    $('.ntw-dash').on('click', function() {
        $('.ntw-nxt-content').addClass('hide');
        $('.ntw-dash-content').removeClass('hide');
    });

// Loading
$(function() {
	$(".loading-wrapper").fadeOut(2000);
});