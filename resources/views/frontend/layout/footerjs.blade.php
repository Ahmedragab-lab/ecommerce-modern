 <!-- JavaScript files-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
 <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
 <script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>
 <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
 <script src="{{ asset('frontend/vendor/choices.js/public/assets/scripts/choices.min.js') }}"></script>
 <script src="{{ asset('frontend/js/front.js') }}"></script>
 <script>
   function injectSvgSprite(path) {

       var ajax = new XMLHttpRequest();
       ajax.open("GET", path, true);
       ajax.send();
       ajax.onload = function(e) {
       var div = document.createElement("div");
       div.className = 'd-none';
       div.innerHTML = ajax.responseText;
       document.body.insertBefore(div, document.body.childNodes[0]);
       }
   }
   injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
 </script>
 <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
       integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
       crossorigin="anonymous">
