// Astro (header navigation)

import Astro from 'Astro';

export default function astroJS() {
  Astro.init({
    toggleActiveClass: 'is-active',
    navActiveClass: 'is-active',
  });
}
