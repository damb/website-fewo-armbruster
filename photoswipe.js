// Photoswipe
var lightbox = new PhotoSwipeLightbox({
  gallery: '#gallery-fewo-armbruster',
  children: 'a',
  // dynamic import is not supported in UMD version
  pswpModule: PhotoSwipe 
});
lightbox.init();

