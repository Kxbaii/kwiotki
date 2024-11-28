document.addEventListener("DOMContentLoaded", () => {
    const scrollWrapper = document.querySelector(".scroll-wrapper");
    const scrollIndicator = document.querySelector(".scroll-indicator");

    
    scrollWrapper.style.overflowY = "scroll";
    scrollWrapper.style.height = "100vh";

   
    function updateScrollIndicator() {
        const scrollTop = scrollWrapper.scrollTop;
        const scrollHeight = scrollWrapper.scrollHeight - scrollWrapper.clientHeight;
        const scrollPercentage = (scrollTop / scrollHeight) * 91;
        scrollIndicator.style.top = `calc(${scrollPercentage}%)`; 
    }

    scrollWrapper.addEventListener("scroll", updateScrollIndicator);


    new SmoothScroll(scrollWrapper, 120, 20);
});

// +++++++++++++++++++++++++++
function init() {
    new SmoothScroll(document, 120, 20);
  }
  
  function SmoothScroll(target, speed, smooth) {
    if (target === document)
      target = (document.scrollingElement
        || document.documentElement
        || document.body.parentNode
        || document.body);
  
    var moving = false;
    var pos = target.scrollTop;
    var frame = target === document.body
      && document.documentElement
      ? document.documentElement
      : target;
  
    target.addEventListener('mousewheel', scrolled, { passive: false });
    target.addEventListener('DOMMouseScroll', scrolled, { passive: false });
  
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault(); 
  
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
  
        if (targetElement) {
          const viewportHeight = window.innerHeight;
          pos = targetElement.offsetTop - (viewportHeight / 2) + (targetElement.offsetHeight / 2);
          if (!moving) update();
        }
      });
    });
  
    function scrolled(e) {
      e.preventDefault();
  
      var delta = normalizeWheelDelta(e);
  
      pos += -delta * speed;
      pos = Math.max(0, Math.min(pos, target.scrollHeight - frame.clientHeight));
  
      if (!moving) update();
    }
  
    function normalizeWheelDelta(e) {
      if (e.detail) {
        if (e.wheelDelta)
          return e.wheelDelta / e.detail / 10 * (e.detail > 0 ? 1 : -1);
        else
          return -e.detail / 3;
      } else
        return e.wheelDelta / 120;
    }
  
    function update() {
      moving = true;
  
      var delta = (pos - target.scrollTop) / smooth;
  
      target.scrollTop += delta;
  
      if (Math.abs(delta) > 0.1)
        requestFrame(update);
      else
        moving = false;
    }
  
    var requestFrame = function () { 
      return (
        window.requestAnimationFrame ||
        function (func) {
          window.setTimeout(func, 1000 / 1);
        }
      );
    }();
  }
  
  window.addEventListener('DOMContentLoaded', () => {
    init();
  });
// +++++++++++++++++++++++++++


const radioButtons = document.querySelectorAll('.controls input[type="radio"]');
          const carousel = document.getElementById('carousel');
        
          
          radioButtons.forEach((radio, index) => {
            radio.addEventListener('change', () => {
              
              carousel.style.setProperty('--position', index + 1);
            });
        });