
/**
 * Controlls header animations for the OSU Project Showcase Header
 * 
 * This file assumes that Lodash is available.
 */
const $header = $('#header');
function onScroll() {
    let scrollPosition = Math.round(window.scrollY);
    if(scrollPosition > 0) {
        $header.removeClass('dark');
        $header.addClass('light');
    } else if (scrollPosition == 0) {
        $header.removeClass('light');
        $header.addClass('dark');
    }
}
window.addEventListener('scroll', _.throttle(onScroll, 100));