// Show back-to-top link

export default function backToTop() {
  window.onscroll = function() {
    const toTop = document.getElementById('js-back-to-top');
    if (window.pageYOffset > 200) {
      toTop.classList.add('back-to-top--is-visible');
    } else {
      toTop.classList.remove('back-to-top--is-visible');
    }
  };
}
