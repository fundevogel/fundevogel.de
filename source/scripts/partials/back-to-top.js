var smoothScroll = require('smooth-scroll');
smoothScroll.init({
  activeClass: 'is-active',
});

window.onscroll = function() {
  var toTop = document.getElementById('js-back-to-top');
  if (window.pageYOffset > 200) {
    toTop.classList.add('back-to-top--is-visible');
  } else {
    toTop.classList.remove('back-to-top--is-visible');
  }
};
