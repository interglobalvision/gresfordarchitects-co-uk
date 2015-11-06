var bodySingle = jQuery('body.single-post');
var bodyCat = jQuery('body.category');

var galleryItems = jQuery('.gallery-item');
var galleryImages = jQuery('.gallery-img');
var galleryLength = galleryItems.length;

// enquire for js events on css media query events
// *** this needs to be made lighter if possible ***
enquire.register('screen and (min-width:1225px)', {
  match: function() {
    galleryImages.each(function() {
      var t = jQuery(this);

      t.imagesLoaded(function() {
        var h = t.find('img').height();

        t.height(h);
      });
    });
  },
}).register('screen and (max-width:920px)', {
  match: function() {
    galleryImages.each(function() {
      var t = jQuery(this);

      t.imagesLoaded(function() {
        var h = t.find('img').height();

        t.height(h);
      });
    });
  },
}).listen();

// general cache
var menuLinks = jQuery('ul#links');
var mobileToggle = jQuery('#mobile-toggle');
var posts = jQuery('#posts');
var homePosts = jQuery('#home-posts');
var post = jQuery('#post');
var wh = jQuery(window).height();

jQuery(document).ready(function() {

  mobileToggle.on({
    click: function() {
      $('#menu').toggleClass('mobile-active');
      $(window).scrollTop(0);
    },
  });

  // if posts index page set up masonry and fade in when ready
  if (posts.length) {
    posts.imagesLoaded(function() {
      posts.masonry({
        itemSelector: 'article',
        gutter: 10,
      }).delay(200).css('opacity', 1);
    });
  }

  if (homePosts.length) {
    homePosts.imagesLoaded(function() {
      homePosts.css('opacity', 1);
    });
  }

  if (bodyCat.length) {
    var t = menuLinks.data('cat');

    console.log(t);
    $('li.' + t).addClass('current');
  }

  if (bodySingle.length) {

    // fix last gallery item to window height minus extra
    galleryItems.last().css('min-height', wh - 110);

    // highlight single post category in menu
    var singleCat = post.data('cat');

    if (singleCat) {
      $('li.cat-item-' + singleCat).addClass('current-cat');
    }

  }

  if (bodySingle.length || $('body.page').length) {

    // fade in when images all loaded
    post.imagesLoaded(function() {
      post.css('opacity', 1);
    });

    // toggle to display project text
    var toggleProjectText = $('#toggle-project-text');
    var viewProjectText = $('#view-project-text');
    var closeProjectText = $('#close-project-text');
    var projectText = $('div#project-text');

    toggleProjectText.on({
      click: function() {
        if (projectText.data('state') === false) {
          if (emailShare.data('state') === true) {
            emailShare.slideUp(1000, function() {
              emailShare.data('state', false);
            }).css('opacity', 0);
          }

          projectText.slideDown(1000, function() {
            viewProjectText.hide();
            closeProjectText.show();
            projectText.data('state', true).ScrollTo();
          });
        } else {
          projectText.slideUp(1000, function() {
            closeProjectText.hide();
            viewProjectText.show();
            projectText.data('state', false);
            $('.gallery-item-holder').first().ScrollTo();
          });
        }
      },
    });

    // toggle to display email drawer

    var emailShare = $('#mail');

    $('li#mail-toggle').on({
      click: function() {
        if (emailShare.data('state') === false) {
          if (projectText.data('state') === true) {
            projectText.slideUp(1000, function() {
              closeProjectText.hide();
              viewProjectText.show();
              projectText.data('state', false);
            });
          }

          emailShare.slideDown(1000, function() {
            emailShare.data('state', true);
          }).css('opacity', 1).ScrollTo();

        } else {
          emailShare.slideUp(1000, function() {
            emailShare.data('state', false);
          }).css('opacity', 0).ScrollTo();
        }
      },
    });

    $('nav#close').on({
      click: function() {
        emailShare.css('opacity', 0);
        setTimeout(function() {
          emailShare.css('z-index', '-1');
        }, 1000);
      },
    });

    // add indicators to header
    var galleryIndicators = $('#gallery-indicators');

    if (galleryIndicators.length) {
      var indicators = '';

      for (i = 0; i < galleryLength; i++) {
        indicators = indicators + '<li><a>&bull;</a></li>';
      }

      galleryIndicators.append(indicators);
      galleryIndicators.children('li').on({
        click: function() {
          var i = $(this).index();

          galleryItems.eq(i).ScrollTo();
        },
      });
    }
    // init scrollorama
    var scrollorama = $.scrollorama({
      enablePin: false,
      blocks: '.gallery-item',
    });

    // gallery caption toggle
    $('.gallery-caption-toggle').on({
      mouseenter: function() {
        $(this).siblings('.gallery-caption').css('opacity', 1);
      },

      mouseleave: function() {
        $(this).siblings('.gallery-caption').css('opacity', 0);
      },
    });

    // scroller to next on gallery item click, and back to start on bottom click
    galleryItems.on({
      click: function() {
        var index = $(this).index();

        if (index === galleryLength - 1) {
          galleryItems.first().ScrollTo();
        } else {
          galleryItems.eq(index + 1).ScrollTo();
        }
      },
    });

    // scroll up on topbar click
    $('nav#scroll-up').on({
      click: function() {
        galleryItems.eq(scrollorama.blockIndex).ScrollTo();
      },
    });

  }
});