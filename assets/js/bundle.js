import lazySizes from 'lazysizes';
import 'lazysizes/plugins/parent-fit/ls.parent-fit';
// import 'lazysizes/plugins/optimumx/ls.optimumx';
import ScrollDirection from './vendor/scroll-direction/scroll-direction';

new ScrollDirection();

document.documentElement.addEventListener('lazybeforeunveil', (event) => {
  let element = event.target;
  let isTargetImage = element instanceof HTMLImageElement;
  let isPictureTag = (element.tagName.toUpperCase() === "PICTURE");

  element.addEventListener('load', () => {
    let targetElement = event.target;
   
    // update src-attribute of image
    if (isPictureTag && isTargetImage) {
      let oldSrc = targetElement.getAttribute('src');
      let newSrc = targetElement.currentSrc;

      // check of newSrc necessary because of IE
      if (newSrc && oldSrc !== newSrc) {
        targetElement.setAttribute('src', newSrc);
      }
    }
  });
});
