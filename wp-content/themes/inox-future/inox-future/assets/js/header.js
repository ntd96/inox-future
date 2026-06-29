/* ============================================
   INOX FUTURE — HEADER JS
   ============================================ */

(function ($) {
  'use strict';

  var $header     = $('#site-header');
  var $toggle     = $('#nav-toggle');
  var $mobileMenu = $('#mobile-menu');
  var SCROLL_THRESHOLD = 50;

  /* --- Scroll: transparent → white --- */
  function onScroll() {
    if ($(window).scrollTop() >= SCROLL_THRESHOLD) {
      $header.addClass('is-scrolled');
    } else {
      $header.removeClass('is-scrolled');
    }
  }

  $(window).on('scroll.header', onScroll);
  onScroll();

  /* --- Mobile menu toggle --- */
  $toggle.on('click', function () {
    var isOpen = $mobileMenu.hasClass('is-open');
    $mobileMenu.toggleClass('is-open');
    $toggle.attr('aria-expanded', !isOpen);
    $mobileMenu.attr('aria-hidden', isOpen);
    $toggle.find('i')
      .toggleClass('ri-menu-line', isOpen)
      .toggleClass('ri-close-line', !isOpen);
  });

  /* --- Close mobile menu on link click --- */
  $mobileMenu.on('click', 'a', function () {
    $mobileMenu.removeClass('is-open');
    $toggle.attr('aria-expanded', false).find('i')
      .removeClass('ri-close-line')
      .addClass('ri-menu-line');
  });

  /* --- Close on outside click --- */
  $(document).on('click.header', function (e) {
    if (!$(e.target).closest('#site-header').length) {
      $mobileMenu.removeClass('is-open');
      $toggle.attr('aria-expanded', false).find('i')
        .removeClass('ri-close-line')
        .addClass('ri-menu-line');
    }
  });

  /* --- Desktop submenu hover --- */
  $('.site-header__menu > li.menu-item-has-children').each(function () {
    var $li = $(this);
    var $submenu = $li.children('.sub-menu');
    var timer;
    $li.on('mouseenter', function () {
      clearTimeout(timer);
      $submenu.addClass('is-open');
    });
    $li.on('mouseleave', function () {
      timer = setTimeout(function () { $submenu.removeClass('is-open'); }, 150);
    });
  });

  /* --- Mobile submenu accordion --- */
  $('.site-header__mobile-nav li.menu-item-has-children > a').each(function () {
    $(this).after(
      '<button class="mobile-submenu-toggle" aria-expanded="false">' +
        '<i class="ri-arrow-down-s-line"></i>' +
      '</button>'
    );
  });

  $mobileMenu.on('click', '.mobile-submenu-toggle', function (e) {
    e.stopPropagation();
    var $btn     = $(this);
    var $submenu = $btn.siblings('.sub-menu');
    var isOpen   = $submenu.hasClass('is-open');
    $submenu.toggleClass('is-open', !isOpen);
    $btn.attr('aria-expanded', !isOpen);
    $btn.find('i')
      .toggleClass('ri-arrow-down-s-line', isOpen)
      .toggleClass('ri-arrow-up-s-line', !isOpen);
  });

  /* --- Reset bfcache --- */
  window.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      $mobileMenu.removeClass('is-open');
      $toggle.attr('aria-expanded', false).find('i')
        .removeClass('ri-close-line').addClass('ri-menu-line');
    }
  });

}(jQuery));