<!-- Start hero slider/ Owl Carousel Slider -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

  .home {
    position: relative;
    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    flex-direction: column;
    background: #2696E9;
  }

  .home:before {
    z-index: 777;
    content: '';
    position: absolute;
    background: rgba(3, 96, 251, 0.3);
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
  }

  .home .content {
    z-index: 888;
    color: #fff;
    width: 70%;
    margin-top: 50px;
    display: none;
  }

  .home .content.active {
    display: block;
  }

  .home .content h1 {
    color: white;
    font-size: 4em;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 2px;
    line-height: 40px;
    margin-bottom: 40px;
  }

  .home .content h1 span {
    font-size: .5em;
    font-weight: 600;
  }

  .home .content p {
    margin-bottom: 65px;
  }

  .custom-width {
    width: 50%;
  }

  .home .content a {
    background: #fff;
    padding: 15px 35px;
    color: #1680AC;
    font-size: 1.1em;
    font-weight: 500;
    text-decoration: none;
    border-radius: 2px;
  }

  .home .media-icons {
    z-index: 888;
    position: absolute;
    right: 30px;
    display: flex;
    flex-direction: column;
    transition: 0.5s ease;
  }

  .home .media-icons a {
    color: #fff;
    font-size: 1.6em;
    transition: 0.3s ease;
  }

  .home .media-icons a:not(:last-child) {
    margin-bottom: 20px;
  }

  .home .media-icons a:hover {
    transform: scale(1.3);
  }

  .home video {
    z-index: 000;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .slider-navigation {
    z-index: 888;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    transform: translateY(80px);
    margin-bottom: 12px;
  }

  .slider-navigation .nav-btn {
    width: 12px;
    height: 12px;
    background: #fff;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 0 2px rgba(255, 255, 255, 0.5);
    transition: 0.3s ease;
  }

  .slider-navigation .nav-btn.active {
    background: #2696E9;
  }

  .slider-navigation .nav-btn:not(:last-child) {
    margin-right: 20px;
  }

  .slider-navigation .nav-btn:hover {
    transform: scale(1.2);
  }

  .video-slide {
    position: absolute;
    width: 100%;
    clip-path: circle(0% at 0 50%);
  }

  .video-slide.active {
    clip-path: circle(150% at 0 50%);
    transition: 2s ease;
    transition-property: clip-path;
  }

  .content {
    padding-left: 80px;
  }

  @media (max-width: 1040px) {
    header {
      padding: 12px 20px;
    }

    section {
      padding: 100px 20px;
    }

    .home .media-icons {
      right: 15px;
    }

    header .navigation {
      display: none;
    }

    header .navigation.active {
      position: fixed;
      width: 100%;
      height: 100vh;
      top: 0;
      left: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgba(1, 1, 1, 0.5);
    }

    header .navigation .navigation-items a {
      color: #222;
      font-size: 1.2em;
      margin: 20px;
    }

    header .navigation .navigation-items a:before {
      background: #222;
      height: 5px;
    }

    header .navigation.active .navigation-items {
      background: #fff;
      width: 600px;
      max-width: 600px;
      margin: 20px;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
      border-radius: 5px;
      box-shadow: 0 5px 25px rgb(1 1 1 / 20%);
    }

    .menu-btn {
      background: url(menu.png)no-repeat;
      background-size: 30px;
      background-position: center;
      width: 40px;
      height: 40px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .menu-btn.active {
      z-index: 999;
      background: url(close.png)no-repeat;
      background-size: 25px;
      background-position: center;
      transition: 0.3s ease;
    }
  }

  @media (max-width: 560px) {
    .home .content h1 {
      font-size: 3em;
      line-height: 60px;
    }
  }
</style>

<section class="home">

  <video class="video-slide active" src="{{ asset('slider-videos/video-01.mp4') }}" autoplay muted loop></video>
  <video class="video-slide" src="{{ asset('slider-videos/video-02.mp4') }}" autoplay muted loop></video>
  <video class="video-slide" src="{{ asset('slider-videos/video-03.mp4') }}" autoplay muted loop></video>

  <div class="d-flex justify-content-center">
    <div class="content slide-01 active">
      <h1>Nouveaux postes.<br><span>de télétravail, autonome</span></h1>
      <p class="custom-width">sans payer de franchise (sans investir), crée pour jeunes, anciens jeunes, handicapés,
        retraités, des personnes en convalescence, policiers, curés, députés.</p>
    </div>
    <div class="content slide-02">
      <h1>Un site avec 101<br><span>raisons</span></h1>
      <p class="custom-width">pour toutes situations, permettant à tous les intéressés de faire de l’argent, en aidant
        aux
        activités.</p>
    </div>
    <div class="content slide-03">
      <h1>Vous avez 14 ans.<br><span> ou même, vous dépassez 94 ans</span></h1>
      <p class="custom-width">nous avons un poste pour vous. Environ 75% c’est du télétravail, et 25% des
        ventes.</p>
    </div>
  </div>

  <div class="media-icons">
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-twitter"></i></a>
  </div>

  <div class="slider-navigation">
    <div class="nav-btn active"></div>
    <div class="nav-btn"></div>
    <div class="nav-btn"></div>
  </div>
</section>

<script type="text/javascript">
  //Javacript for video slider navigation
    // const btns = document.querySelectorAll(".nav-btn");
    // const slides = document.querySelectorAll(".video-slide");
    // const contents = document.querySelectorAll(".content");

    // var sliderNav = function(manual){
    //   btns.forEach((btn) => {
    //     btn.classList.remove("active");
    //   });

    //   slides.forEach((slide) => {
    //     slide.classList.remove("active");
    //   });

    //   contents.forEach((content) => {
    //     content.classList.remove("active");
    //   });

    //   btns[manual].classList.add("active");
    //   slides[manual].classList.add("active");
    //   contents[manual].classList.add("active");
    // }

    // btns.forEach((btn, i) => {
    //   btn.addEventListener("click", () => {
    //     sliderNav(i);
    //   });
    // });

    //     // Javascript for image slider autoplay navigation
    //   var repeat = function(activeClass){
    //   let active = document.getElementsByClassName('active');
    //   let i = 1;

    //   var repeater = () => {
    //     setTimeout(function(){
    //       [...active].forEach((activeSlide) => {
    //         activeSlide.classList.remove('active');
    //       });

    //     slides[i].classList.add('active');
    //     btns[i].classList.add('active');
    //     i++;

    //     if(slides.length == i){
    //       i = 0;
    //     }
    //     if(i >= slides.length){
    //       return;
    //     }
    //     repeater();
    //   }, 10000);
    //   }
    //   repeater();
    // }
    // repeat();
</script>