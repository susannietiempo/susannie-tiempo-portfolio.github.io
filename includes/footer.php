<!-- ======= Footer ======= -->

<footer style="background-color: black;">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="copyright-box">
          <p class="copyright">Follow Me and Get Updated </p>
        </div>
      </div>

      <div class="socials">
        <ul>
          <li><a href="https://github.com/susannietiempo" target='_blank'><span class="ico-circle"><i class="fa fa-github" aria-hidden="true" style="color:#E0A814"></i></span></a></li>
          <li><a href="https://www.linkedin.com/in/susannievhiltiempo/" target='_blank'><span class="ico-circle"><i class="fa fa-linkedin-square" aria-hidden="true"  style="color:#E0A814"></i></span></a></li>
        </ul>
      </div>

    </div>
  </div>
</footer><!-- End  Footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="./assets/vendor/jquery/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="./assets/vendor/php-email-form/validate.js"></script>
<script src="./assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="./assets/vendor/counterup/jquery.counterup.min.js"></script>
<script src="./assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="./assets/vendor/typed.js/typed.min.js"></script>
<script src="./assets/vendor/venobox/venobox.min.js"></script>

<!-- Template Main JS File -->
<script src="./assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script type="text/javascript">
  particlesJS("particles-js", {
    "particles": {
      "number": {
        "value": 144,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#ffffff"
      },
      "shape": {
        "type": "star",
        "stroke": {
          "width": 0,
          "color": "#000000"
        },
        "polygon": {
          "nb_sides": 5
        },
        "image": {
          "src": "img/github.svg",
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.5,
        "random": false,
        "anim": {
          "enable": false,
          "speed": 1,
          "opacity_min": 0.1,
          "sync": false
        }
      },
      "size": {
        "value": 2,
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.1,
          "sync": false
        }
      },
      "line_linked": {
        "enable": false,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.1763753266952075,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 1.2,
        "direction": "none",
        "random": true,
        "straight": false,
        "out_mode": "out",
        "bounce": false,
        "attract": {
          "enable": false,
          "rotateX": 600,
          "rotateY": 1200
        }
      }
    },
    "interactivity": {
      "detect_on": "window",
      "events": {
        "onhover": {
          "enable": true,
          "mode": "repulse"
        },
        "onclick": {
          "enable": true,
          "mode": "push"
        },
        "resize": true
      },
      "modes": {
        "grab": {
          "distance": 400,
          "line_linked": {
            "opacity": 1
          }
        },
        "bubble": {
          "distance": 400,
          "size": 40,
          "duration": 2,
          "opacity": 8,
          "speed": 3
        },
        "repulse": {
          "distance": 200,
          "duration": 0.4
        },
        "push": {
          "particles_nb": 4
        },
        "remove": {
          "particles_nb": 2
        }
      }
    },
    "retina_detect": true
  });
  var count_particles, stats, update;
  stats = new Stats;
  stats.setMode(0);
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.left = '0px';
  stats.domElement.style.top = '0px';
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    stats.begin();
    stats.end();
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);;
</script>

</body>

</html>