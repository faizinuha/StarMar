$(function () {
  "use strict";

  // Feather Icon Init Js
  // feather.replace();

  // $(".preloader").fadeOut();

  // =================================
  // Tooltip
  // =================================
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // =================================
  // Popover
  // =================================
  var popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
  );
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });

  // increment & decrement
  $(".minus,.add").on("click", function () {
    var $qty = $(this).closest("div").find(".qty"),
      currentVal = parseInt($qty.val()),
      isAdd = $(this).hasClass("add");
    !isNaN(currentVal) &&
      $qty.val(
        isAdd ? ++currentVal : currentVal > 0 ? --currentVal : currentVal
      );
  });

  // ==============================================================
  // Collapsable cards
  // ==============================================================
  $('a[data-action="collapse"]').on("click", function (e) {
    e.preventDefault();
    $(this)
      .closest(".card")
      .find('[data-action="collapse"] i')
      .toggleClass("ti-minus ti-plus");
    $(this).closest(".card").children(".card-body").collapse("toggle");
  });
  // Toggle fullscreen
  $('a[data-action="expand"]').on("click", function (e) {
    e.preventDefault();
    $(this)
      .closest(".card")
      .find('[data-action="expand"] i')
      .toggleClass("ti-arrows-maximize ti-arrows-maximize");
    $(this).closest(".card").toggleClass("card-fullscreen");
  });
  // Close Card
  $('a[data-action="close"]').on("click", function () {
    $(this).closest(".card").removeClass().slideUp("fast");
  });

  // fixed header
  $(window).scroll(function () {
    if ($(window).scrollTop() >= 60) {
      $(".app-header").addClass("fixed-header");
    } else {
      $(".app-header").removeClass("fixed-header");
    }
  });

  // Checkout
  $(function () {
    $(".billing-address").click(function () {
      $(".billing-address-content").hide();
    });
    $(".billing-address").click(function () {
      $(".payment-method-list").show();
    });
  });
});

/*change layout boxed/full */
$(".full-width").click(function () {
  $(".container-fluid").addClass("mw-100");
  $(".full-width i").addClass("text-primary");
  $(".boxed-width i").removeClass("text-primary");
});
$(".boxed-width").click(function () {
  $(".container-fluid").removeClass("mw-100");
  $(".full-width i").removeClass("text-primary");
  $(".boxed-width i").addClass("text-primary");
});

/*Dark/Light theme*/
$(".light-logo").hide();
$(".dark-theme").click(function () {
  $("nav.navbar-light").addClass("navbar-dark");
  $(".dark-theme i").addClass("text-primary");
  $(".light-theme i").removeClass("text-primary");
  $(".light-logo").show();
  $(".dark-logo").hide();
});
$(".light-theme").click(function () {
  $("nav.navbar-light").removeClass("navbar-dark");
  $(".dark-theme i").removeClass("text-primary");
  $(".light-theme i").addClass("text-primary");
  $(".light-logo").hide();
  $(".dark-logo").show();
});

/*Card border/shadow*/
$(".cardborder").click(function () {
  $("body").addClass("cardwithborder");
  $(".cardshadow i").addClass("text-dark");
  $(".cardborder i").addClass("text-primary");
});
$(".cardshadow").click(function () {
  $("body").removeClass("cardwithborder");
  $(".cardborder i").removeClass("text-primary");
  $(".cardshadow i").removeClass("text-dark");
});

$(".change-colors li a").click(function () {
  $(".change-colors li a").removeClass("active-theme");
  $(this).addClass("active-theme");
});

/*Theme color change*/
function toggleTheme(value) {
  $(".preloader").show();
  var sheets = document.getElementById("themeColors");
  sheets.href = value;
  $(".preloader").fadeOut();
}
$(".preloader").fadeOut();
