gsap.registerPlugin(SplitText);
gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(CustomEase);

CustomEase.create("hop", ".87, 0, .13, 1");
reinitializePage();

const message_area = document.querySelector(".notification");

function showNotification(html) {
  message_area.innerHTML = html;

  setTimeout(() => {
    message_area.innerHTML = "";

  }, 8000);

}
function setUpLoader() {

  function init() {
    setUpAnimation();
  }

  window.addEventListener("load", init);

  window.addEventListener("pageshow", (e) => {
    if (e.persisted) {
      init();
    }
  });
}


function setUpHome() {
  const showLoader = !sessionStorage.getItem("kaiveraVisited");
  const lenis = new Lenis({
    duration: 1.3,
    smooth: true,
    direction: "vertical",
    gestureDirection: "vertical",
    smoothTouch: true,
    touchMultiplier: 2,
    infinite: false,
  });

  // Scroll update loop
  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }

  document.fonts.ready.then(() => {
    if (showLoader) {


      // Disabling scrolling in all platform
      document.body.style.overflow = "hidden";
      document.documentElement.style.overflow = "hidden";
      document.body.addEventListener("touchmove", preventScroll, {
        passive: false,
      });
      document.addEventListener("wheel", preventScroll, { passive: false });
      lenis.stop();

      function preventScroll(e) {
        e.preventDefault();
      }
      sessionStorage.setItem("kaiveraVisited", "true");


      // Loader animation

      let counterElement = document.querySelector(".loader .counter p");
      let currentValue = 0;

      function updateCounter() {
        if (currentValue < 100) {
          let increment = Math.floor(Math.random() * 10) + 1;
          currentValue = Math.min(currentValue + increment, 100);
          counterElement.textContent = currentValue;

          let delay = Math.floor(Math.random() * 150) + 25;
          setTimeout(updateCounter, delay);
        }
      }

      const loader_bg = document.querySelectorAll(".loader .loader_bg");
      const loading_text = document.querySelectorAll(".loader .text_content h1");

      const arr_text = [];

      loading_text.forEach((el) => {
        const split = new SplitText(el, {
          tupe: "chars"
        });
        arr_text.push(split);
      });

      arr_text.forEach((split) => {
        gsap.from(split.chars, {
          y: -100,
          duration: 1.2,
          stagger: 0.03,
          ease: "power4.out",
          delay: .4
        });

        gsap.to(split.chars, {
          y: 50,
          duration: 1,
          stagger: 0.02,
          ease: "power4.in",
          delay: 2.5
        })
      });

      gsap.from(counterElement, {
        opacity: 0,
        y: -20,
        duration: 1.2,
        ease: "power4.out",
        delay: .4,
      });
      gsap.to(counterElement, {
        opacity: 0,
        y: 30,
        duration: 1,
        ease: "power4.in",
        delay: 2.5
      })

      gsap.set(".loader .loader_bg_top, .loader .loader_bg_bottom", {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)"
      });
      gsap.to(loader_bg, {
        scale: 0.5,
        duration: 1.5,
        ease: "power4.inOut",
        delay: 2.5,
      });
      gsap.to(".loader .loader_bg_top", {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)",
        duration: 1.3,
        ease: "power4.inOut",
        delay: 3

      });


      gsap.to(".loader .loader_bg_bottom", {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)",
        duration: 1.3,
        ease: "power4.inOut",
        delay: 3.4,

        onComplete: () => {
          document.querySelector('.loader').style.display = "none";
          document.body.style.overflow = "";
          document.documentElement.style.overflow = "";
          document.body.removeEventListener("touchmove", preventScroll);
          document.removeEventListener("wheel", preventScroll);
          lenis.start();
          requestAnimationFrame(raf);

        },
      });


      gsap.to(".loader", {
        delay: 6,
        onComplete: () => {
          document.querySelector('.loader').style.display = "none";
        },
      });


      updateCounter();
      startMainAnimation(3);


    } else {
      document.querySelector(".hero-img").style.display = "none"
      document.querySelector(".loader").style.display = "none";
      lenis.start();
      requestAnimationFrame(raf);
      startMainAnimation(0);
    }

    function startMainAnimation(delay = 0) {

      requestAnimationFrame(raf);


      //Landing page animation

      const heroTexts = document.querySelectorAll(".landing-page h1");
      const heroSplit = [];

      const heroPara = document.querySelectorAll(".heroPara");
      const heroParaSplit = [];

      const video = document.querySelector(".hero-video .video");


      heroPara.forEach((el) => {
        const split = new SplitText(el, {
          type: "lines",
          linesClass: "line-wrapper",
          autoSplit: true,
        });

        heroParaSplit.push(split);
      });

      heroParaSplit.forEach((split) => {
        gsap.from(split.lines, {
          y: 100,
          duration: 2,
          ease: "power4.out",
          stagger: 0.05,
          delay: delay + 1,
        });
      });

      heroTexts.forEach((el) => {
        const split = new SplitText(el, {
          type: "chars",
          autoSplit: true,
        });

        heroSplit.push(split);
      });
      heroSplit.forEach((split) => {
        gsap.from(split.chars, {
          y: 200,
          duration: 2,
          ease: "power4.out",
          stagger: 0.1,
          delay: delay + 0.5,
          onComplete: () => {
            document.body.style.overflowX = "hidden";
          },
        });
      });
      gsap.set(".hero-img", {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
        scale: 1.3,
      });
      gsap.to(".hero-img", {
        scale: 1,
        duration: 2,
        ease: "power4.inOut",
        delay: delay
      })
      gsap.to(".hero-img", {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%)",
        duration: 2,
        ease: "power4.inOut",
        delay: delay + .2,
        onComplete: () => {
          document.querySelector(".hero-img").style.display = "none"
        }
      })

      gsap.from(video, {
        duration: 1.5,
        ease: "power4.inOut",
        delay: delay + 2,
        clipPath: "polygon(0% 100%, 100% 100%, 100% 100%, 0% 100%)"
      })


    }
  });


  // Scroll Trigger
  gsap.set(".horizontalText p", {
    x: -100,
  });
  gsap.to(".horizontalText p", {
    x: 500,
    ease: "none",
    scrollTrigger: {
      trigger: ".horizontalText",
      start: "top bottom",
      end: "bottom top",
      scrub: 1,
    },
  });

  //Testimonial Cards

  testimonialCards();

}
function testimonialCards() {
  const cards = document.querySelectorAll(".testimonial-card");
  if (cards.length > 0) {
    const track = document.getElementById("testimonial-track");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");
    const dots = document.querySelectorAll(".indicator-dot");
    const carousel = document.getElementById("carousel");

    let currentIndex = 0;
    let autoSlideInterval;

    function getCardWidth() {
      return cards[0].offsetWidth;
    }

    function getVisibleCards() {
      return window.innerWidth >= 1024 ? 3 : window.innerWidth >= 768 ? 2 : 1;
    }

    function updateCarousel() {
      const offset = -currentIndex * getCardWidth();
      track.style.transform = `translateX(${offset}px)`;

      dots.forEach((dot, index) => {
        dot.classList.toggle("active-dot", index === currentIndex);
      });

      cards.forEach((card) => {
        card.classList.remove("animate-fade");
        void card.offsetWidth;
        card.classList.add("animate-fade");
      });
    }

    function nextSlide() {
      const visibleCards = getVisibleCards();
      const maxIndex = totalCards - visibleCards;
      currentIndex = (currentIndex + 1) % (maxIndex + 1);
      updateCarousel();
    }

    function prevSlide() {
      const visibleCards = getVisibleCards();
      const maxIndex = totalCards - visibleCards;
      currentIndex = (currentIndex - 1 + (maxIndex + 1)) % (maxIndex + 1);
      updateCarousel();
    }

    function startAutoSlide() {
      autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoSlide() {
      clearInterval(autoSlideInterval);
      startAutoSlide();
    }

    nextBtn.addEventListener("click", () => {
      nextSlide();
      resetAutoSlide();
    });

    prevBtn.addEventListener("click", () => {
      prevSlide();
      resetAutoSlide();
    });

    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        currentIndex = index;
        updateCarousel();
        resetAutoSlide();
      });
    });

    carousel.addEventListener("mouseenter", () => {
      clearInterval(autoSlideInterval);
    });

    carousel.addEventListener("mouseleave", startAutoSlide);

    window.addEventListener("resize", () => {
      currentIndex = 0;
      updateCarousel();
    });

    const totalCards = cards.length;

    // Initialize
    updateCarousel();
    startAutoSlide();
  }
}
function aboutAnimation() {
  let linesScrollAnimationSplit = [];
  const linesScrollAnimation = document.querySelectorAll(".scrollLine");

  linesScrollAnimationSplit.forEach((split) => split.revert());
  linesScrollAnimationSplit = [];




  linesScrollAnimation.forEach((el) => {
    el.innerHTML = el.textContent;

    const split = new SplitText(el, {
      type: "lines",
      linesClass: "line-wrapper",
    });

    split.lines.forEach((line) => {
      const inner = document.createElement("span");
      inner.classList.add("line");
      inner.innerHTML = line.innerHTML;
      line.innerHTML = "";
      line.appendChild(inner);
    });

    linesScrollAnimationSplit.push(split);
  });



  linesScrollAnimationSplit.forEach((split) => {
    split.lines.forEach((lineWrapper) => {
      const line = lineWrapper.querySelector(".line");

      gsap.set(line, {
        clipPath: "polygon(0 100%, 100% 100%, 100% 100%, 0% 100%)",
        y: 100,
      });

      gsap.to(line, {
        scrollTrigger: {
          trigger: lineWrapper,
          start: "-100px 90%",
          end: "bottom 20%",
          scrub: true,
        },
        clipPath: "polygon(0 0%, 100% 0%, 100% 100%, 0% 100%)",
        y: 0,
        duration: 3,
        ease: "power4.out",
      });
    });
  });

  const scrollText = document.querySelectorAll(".scrollText");

  document.fonts.ready.then(() => {
    const scrollTextSplit = new SplitText(scrollText, {
      type: "lines",
      linesClass: "lineChildren",
    });

    const scrollTextChars = new SplitText(scrollText, {
      type: "chars",
      charsClass: "charChildren",
    });

    gsap.from(scrollTextSplit.lines, {
      x: -200,
      stagger: 0.3,
      scrollTrigger: {
        trigger: scrollText,
        start: "-200px 80%",
        end: "bottom 60%",
        scrub: true,

      },
    });
    gsap.from(scrollTextChars.chars, {
      opacity: 0.1,
      stagger: 0.05,
      scrollTrigger: {
        trigger: scrollText,
        start: "top 80%",
        end: "bottom 20%",
        scrub: true,
      },
    });
  });

}
function setUpAbout() {

  aboutAnimation();

  const about_video = document.querySelector(".about-video video");
  gsap.set(about_video, {
    borderRadius: "50px",
  });
  gsap.from(about_video, {
    y: -450,
    duration: 2,
    scale: 0.2,
    ease: "easeInOut",
    scrollTrigger: {
      trigger: about_video,
      scrub: true,
      start: "top 70%",
      end: "bottom 20%",
    },
    borderRadius: "500px",
    onComplete() {
      gsap.to(about_video, {
        borderRadius: "50px",
      });
    },
  });



  const animateImage = document.querySelector(".animateImage1");
  gsap.from(animateImage, {
    x: -300,
    rotate: -8,
    opacity: 0.5,
    ease: "easeInOut",
    scrollTrigger: {
      trigger: animateImage,
      scrub: true,
      start: "top bottom",
      end: "bottom 20%",
    },
  });

  const animateImage2 = document.querySelector(".animateImage2");
  gsap.from(animateImage2, {
    x: 300,
    rotate: 8,
    opacity: 0.5,
    ease: "easeInOut",
    scrollTrigger: {
      trigger: animateImage2,
      scrub: true,
      start: "top bottom",
      end: "50% 20%",
    },
  });
}

function setUpAnimation() {
  // Text Animation by Chars
  document.fonts.ready.then(() => {
    const charsAnimation = document.querySelectorAll(".charsAnimation");
    const charsSplit = [];

    charsAnimation.forEach((el) => {
      const split = new SplitText(el, { type: "chars" });
      charsSplit.push(split);
    });

    charsSplit.forEach((split) => {
      gsap.set(split.chars, {
        y: 100,
      });

      gsap.to(split.chars, {
        scrollTrigger: {
          trigger: split.chars,
          start: "top 80%",
          end: "bottom 20%",
          once: true,
        },
        y: 0,
        duration: 0.8,
        ease: "power4.Out",
        stagger: 0.02,
      });
    });
  });

  // Text Animation by Lines

  document.fonts.ready.then(() => {
    const linesAnimation = document.querySelectorAll(".linesAnimation");
    const linesSplit = [];

    linesAnimation.forEach((el) => {
      const split = new SplitText(el, {
        type: "lines",
        linesClass: "line-wrapper",
        autoSplit: true,
      });

      split.lines.forEach((line) => {
        const inner = document.createElement("span");
        inner.classList.add("line");
        inner.innerHTML = line.innerHTML;
        line.innerHTML = "";
        line.appendChild(inner);
      });

      linesSplit.push(split);
    });

    linesSplit.forEach((split) => {
      split.lines.forEach((lineWrapper) => {
        const line = lineWrapper.querySelector(".line");
        gsap.set(line, {
          clipPath: "polygon(0 100%, 100% 100%, 100% 100%, 0% 100%)",
          y: 100,
        });

        gsap.to(line, {
          scrollTrigger: {
            trigger: lineWrapper,
            start: "top 80%",
            end: "bottom 20%",
            once: true,
          },
          clipPath: "polygon(0 0%, 100% 0%, 100% 100%, 0% 100%)",
          y: 0,
          duration: 2,
          ease: "power4.out",
        });
      });
    });
  });

  // Intro Text Animation by Lines
  document.fonts.ready.then(() => {
    const introlinesAnimation = document.querySelectorAll(
      ".introLineAnimation"
    );
    const introlinesSplit = [];

    introlinesAnimation.forEach((el) => {
      const split = new SplitText(el, {
        type: "lines",
        linesClass: "line-wrapper",
        autoSplit: true,
      });

      split.lines.forEach((line) => {
        const inner = document.createElement("span");
        inner.classList.add("line");
        inner.innerHTML = line.innerHTML;
        line.innerHTML = "";
        line.appendChild(inner);
      });

      introlinesSplit.push(split);
    });

    introlinesSplit.forEach((split) => {
      split.lines.forEach((lineWrapper) => {
        const line = lineWrapper.querySelector(".line");
        gsap.set(line, {
          clipPath: "polygon(0 100%, 100% 100%, 100% 100%, 0% 100%)",
          y: 100,
        });
        gsap.to(line, {
          clipPath: "polygon(0 0%, 100% 0%, 100% 100%, 0% 100%)",
          y: 0,
          duration: 1.5,
          delay: .5,
          ease: "power4.out",
        });
      });
    });
  });

  //Fade in elements

  const fadeElements = document.querySelectorAll(".fade-in");

  fadeElements.forEach((e) => {
    gsap.set(fadeElements, {
      opacity: 0,
      y: 50,
    });

    gsap.to(fadeElements, {
      scrollTrigger: {
        trigger: fadeElements,
        start: "top 80%",
        end: "bottom 20%",
        once: true,
      },
      opacity: 1,
      y: 0,
      duration: 1,
      ease: "power4.Out",
      stagger: 0.1,
    });
  });
}

function setUpContact() {
  const contact_row = document.querySelectorAll(".contact-row");

  gsap.from(contact_row, {
    opacity: 0,
    x: 300,
    duration: 2,
    ease: "power4.InOut",
    stagger: 0.3,
  });

  ScrollTrigger.create({
    trigger: ".contact-form",
    start: "top 60%",
    end: "bottom 40%",
  });

  ScrollTrigger.matchMedia({
    "(min-width: 901px)": function () {
      ScrollTrigger.create({
        trigger: ".contact-container",
        start: "top top",
        end: "bottom bottom",
        pin: ".left-section",
        scrub: true,
        pinSpacing: false,
      });
    },
  });


  document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("ratingForm");

    form.addEventListener("submit", function (e) {

      e.preventDefault();

      const formData = new FormData(form);

      fetch("../controllers/reviews.php", {
        method: "POST",
        body: formData
      }).then(res => res.text()).then(data => {
        showNotification(data);
        form.reset();
      }).catch(err => {
        showNotification(err);
      })


    });

  });
  const message_btn = document.getElementById("message_btn");

  message_btn.addEventListener("click", function (e) {
    e.preventDefault();
    const message_form = document.getElementById("message_form");

    const formData = new FormData(message_form);

    fetch("controllers/message.php", {
      method: "POST",
      body: formData,
    }).then(res => res.text())
      .then(data => {
        showNotification(data);
      }).catch(err => {
        showNotification(err);
      })

  });


}
function setUpLenis() {
  const lenis = new Lenis({
    duration: 1.3,
    smooth: true,
    direction: "vertical",
    gestureDirection: "vertical",
    smoothTouch: true,
    touchMultiplier: 2,
    infinite: false,
  });

  // Scroll update loop
  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }

  lenis.start();
  requestAnimationFrame(raf);
}

function setUpHelpBubble() {

  // Help Bubble

  const helpBubble = document.querySelector(".help-bubble");
  let active = false;

  document.addEventListener("mousemove", (e) => {
    if (active) {
      helpBubble.style.left = `${e.clientX}px`;
      helpBubble.style.top = `${e.clientY}px`;
    }
  });

  document.querySelectorAll(".help-target").forEach((div) => {
    div.addEventListener("mouseenter", (e) => {
      const helpText = div.dataset.help;
      helpBubble.textContent = helpText;
      helpBubble.style.transform = "scale(1)";
      active = true;

    });

    div.addEventListener("mouseleave", () => {
      helpBubble.style.transform = "scale(0)";


      active = false;
    });
  });


  document.addEventListener("DOMContentLoaded", () => {
    const helpBubbleImg = document.createElement("div");
    helpBubbleImg.className = "help-bubble-img";
    document.body.appendChild(helpBubbleImg);

    let isVisible = false;

    document.querySelectorAll(".help-target-img").forEach(el => {
      const imgSrc = el.dataset.helpImg;
      if (!imgSrc) return;

      el.addEventListener("mouseenter", () => {
        helpBubbleImg.innerHTML = `<img src="${imgSrc}">`;
        helpBubbleImg.style.transform = "scale(1)";
        isVisible = true;
      });

      el.addEventListener("mouseleave", () => {
        helpBubbleImg.style.transform = "scale(0)";
        isVisible = false;
      });

      el.addEventListener("mousemove", (e) => {
        if (isVisible) {
          helpBubbleImg.style.top = `${e.pageY + 20}px`;
          helpBubbleImg.style.left = `${e.pageX - 60}px`;
        }
      });
    });
  });

}
function reloadWishlist(user_id) {
  const wishlistContainer = document.getElementById("wishlistContainer");
  const formData = new FormData();
  formData.append("user_id", user_id);

  fetch("controllers/wishlist_items.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.text())
    .then(html => {
      wishlistContainer.innerHTML = html;
    })
    .catch(err => {
      console.error("Error loading wishlist items:", err);
    });
}


function setUpNavigation() {

  const navigation = document.querySelector(".navigation");
  const navBtn = document.querySelector(".nav-btn");
  const navigation_link = document.querySelectorAll('.navigation_links');


  let isOpen = false;

  gsap.set(navigation, {
    clipPath: "polygon(0 0, 100% 0, 100% 0%, 0 0%)"
  })

  gsap.set(navigation_link, {
    y: 100
  })

  navBtn.addEventListener("click", () => {
    if (!isOpen) {

      gsap.to(navigation, {
        opacity: 1,
        y: "0%",
        duration: 1,
        ease: "hop",
        clipPath: "polygon(0 0, 100% 0, 100% 100%, 0% 100%)"
      })
      gsap.to("main", {
        y: "50svh",
        duration: 1,
        ease: "hop"
      })
      gsap.to(".fade-overlay", {
        opacity: 1,
        duration: 1,
        ease: "hop"
      })
      gsap.to(navigation_link, {
        y: 0,
        duration: 1.5,
        ease: "hop",
        stagger: 0.075,
        delay: -0.35,
      })


    } else {
      gsap.to(navigation, {
        y: "-100%",
        duration: 1,
        ease: "hop",
        clipPath: "polygon(0 0, 100% 0, 100% 0%, 0 0%)"

      })
      gsap.to("main", {

        y: "0svh",
        duration: 1,
        ease: "hop"
      })
      gsap.to(".fade-overlay", {
        opacity: 0,
        duration: 1,
        ease: "hop"
      })
      gsap.to(navigation_link, {
        y: 100,
        duration: .8,
        ease: "hop",
        stagger: {
          each: 0.05,
          from: "end"
        },
        delay: -0.3,

      })

      navigation.classList.remove("visible");
    }


    isOpen = !isOpen;
  });


  // Navigation Count

  const navData = {
    HOME: "01",
    PRODUCTS: "02",
    CART: "03",
    CONTACT: "04",
    ABOUT: "05",
    SIGNUP: "06",
    LOGOUT: "06"
  };
  const navLinks = document.querySelectorAll(".nav-link");
  const numberDisplay = document.querySelector(".navigation .right .bot h1");

  navLinks.forEach((link) => {
    link.addEventListener("mouseenter", () => {
      const text = link.textContent.trim().toUpperCase();
      numberDisplay.textContent = navData[text] || "00";
    });
    link.addEventListener("mouseleave", () => {
      numberDisplay.textContent = "01";
    });
  });


  const btns = document.querySelectorAll(".wishlist_link");
  const close_btn = document.getElementById("wishlistclose_btn");
  const wishlist = document.getElementById("wishlist");

  let open = false;

  if (btns.length > 0 && wishlist) {

    gsap.set(wishlist, {
      clipPath: "polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)"
    })
    btns.forEach(button => {
      button.addEventListener("click", function (e) {
        e.preventDefault();
        if (!open) {

          // Open logic 
          gsap.to(wishlist, {
            x: "0px",
            duration: 1.5,
            ease: "power4.out",
            clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)",
          })
          open = true;

        } else {

          // Close logic 
          gsap.to(wishlist, {
            x: "400px",
            duration: .9,
            ease: "power4.in",
            clipPath: "polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)"

          })

          open = false;
        }
      });
    });


    if (close_btn && wishlist) {
      close_btn.addEventListener("click", function () {
        gsap.to(wishlist, {
          x: "400px",
          duration: .9,
          ease: "power4.in",
          clipPath: "polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)"

        })
        open = false;
      });
    }

  }
  rebindWishlist();
  modeToggle();


}

function modeToggle() {
  document.addEventListener("DOMContentLoaded", function () {
    const light_mode = document.getElementById("light_mode");
    const dark_mode = document.getElementById("dark_mode");
    const logo = document.getElementById("logo");
    const savedMode = localStorage.getItem("mode");


    if (savedMode === "dark") {
      document.body.classList.remove("light");
      document.querySelector(".navigation-btn").style.background = "transparent";
      logo.src = "../assets/images/kaivera logo.png";
      dark_mode.classList.add("hidden");
      light_mode.classList.remove("hidden");
    } else {

      document.body.classList.add("light");
      document.querySelector(".navigation-btn").style.background = "#ffffff7b";
      logo.src = "../assets/images/kaivera logo dark.webp";
      light_mode.classList.add("hidden");
      dark_mode.classList.remove("hidden");


      if (!savedMode) {
        localStorage.setItem("mode", "light");
      }
    }

    light_mode.addEventListener("click", function (e) {
      e.preventDefault();
      light_mode.classList.add("hidden");
      dark_mode.classList.remove("hidden");
      document.body.classList.add("light");
      document.querySelector(".navigation-btn").style.background = "#ffffff7b";
      logo.src = "../assets/images/kaivera logo dark.webp";
      localStorage.setItem("mode", "light");
    });

    dark_mode.addEventListener("click", function (e) {
      e.preventDefault();
      document.querySelector(".navigation-btn").style.background = "transparent";
      dark_mode.classList.add("hidden");
      light_mode.classList.remove("hidden");
      document.body.classList.remove("light");
      logo.src = "../assets/images/kaivera logo.png";
      localStorage.setItem("mode", "dark");
    });
  });
}

function rebindWishlist() {
  document.addEventListener("click", function (e) {

    if (e.target.classList.contains("remove_wishlist")) {
      const button = e.target;

      const user_id = button.dataset.userId;
      const product_id = button.dataset.productId;

      const formData = new FormData();
      formData.append("user_id", user_id);
      formData.append("product_id", product_id);
      formData.append("action", "remove");

      fetch("controllers/wishlist.php", {
        method: "POST",
        body: formData
      })
        .then(res => res.text())
        .then(data => {
          showNotification(data);
          reloadWishlist(user_id);
        })
        .catch(error => {
          showNotification(error);
        });
    }
  });

  // WishList AJAX

  const wish_btn = document.querySelectorAll('.wishlist_btn');

  wish_btn.forEach(btn => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      const user_id = btn.dataset.userId;
      const product_id = btn.dataset.productId;

      if (!user_id || !product_id) return;


      const isAdded = btn.classList.contains("added");

      const formData = new FormData();
      formData.append("user_id", user_id);
      formData.append("product_id", product_id);
      formData.append("action", isAdded ? "remove" : "add");

      fetch("controllers/wishlist.php", {
        method: "POST",
        body: formData
      })
        .then(res => {
          if (!res.ok) {
            return res.text().then(msg => { throw new Error(msg); });
          }
          return res.text();
        })
        .then(response => {
          showNotification(response);
          if (isAdded) {
            btn.classList.remove("added");
          } else {
            btn.classList.add("added");
          }
          reloadWishlist(user_id);
        })
        .catch(error => showNotification(error));

    });
  });
}

function setUpParallax() {
  //Parallax Scroll
  document.addEventListener("scroll", () => {
    const images = document.querySelectorAll(".image-parallax");
    images.forEach((img) => {
      const speed = img.dataset.speed || 0.5;
      const offset = window.scrollY * speed;
      img.style.transform = `translateY(${offset}px)`;
    });
  });

  window.addEventListener("scroll", () => {
    const imageEl = document.querySelector(".background-parallax");
    const speed = 0.5;
    const scrollY = window.scrollY;
    const newPosY = -1000 + scrollY * speed;
    imageEl.style.backgroundPositionY = `${newPosY}px`;
  });
}

function setUpProduct() {
  const slider = document.getElementById("slider");
  const buttons = document.querySelectorAll(".product-nav button");

  function goToSlide(index) {
    slider.scrollTo({
      left: index * window.innerWidth,
      behavior: "smooth",
    });

    buttons.forEach((btn) => btn.classList.remove("active"));
    buttons[index].classList.add("active");
  }

  buttons.forEach((button, index) => {
    button.addEventListener("click", () => {
      goToSlide(index);
    });
  });

  slider.addEventListener("scroll", () => {
    const index = Math.round(slider.scrollLeft / window.innerWidth);
    buttons.forEach((btn) => btn.classList.remove("active"));
    buttons[index].classList.add("active");
  });




  //  product popup

  function bindProductListeners() {

    const popup = document.getElementById("product-popup");
    const closeBtn = popup.querySelector(".close-btn");

    const popupImg = document.getElementById("productImage");
    const popupName = document.getElementById("popup-name");
    const popupDesc = document.getElementById("popup-desc");
    const totalPriceEl = document.getElementById("totalPrice");

    const quantityInput = document.querySelector('.quantityInput');
    const increaseBtn = document.querySelector('.increase');
    const decreaseBtn = document.querySelector('.decrease');

    const view_detail = document.querySelectorAll(".view_details");

    let unitPrice = 0;
    view_detail.forEach(button => {

      button.addEventListener("click", function (e) {

        const productId = this.dataset.productId;
        const name = this.dataset.name;
        const desc = this.dataset.desc;
        const price = this.dataset.price;
        const img = this.dataset.img;



        document.getElementById('id_input').value = productId;
        document.getElementById('name_input').value = name;
        document.getElementById('image_input').value = img;
        document.getElementById('price_input').value = price;


        unitPrice = parseFloat(price);

        popupName.textContent = name;
        popupDesc.textContent = desc;
        popupImg.src = img;

        quantityInput.value = 1;
        updatePrice();

        popup.classList.remove("hidden");

      });
    })


    closeBtn.addEventListener("click", () => {
      popup.classList.add("hidden");
      quantityInput.value = 1;
      updatePrice();

    });
    document.getElementById("product_image").addEventListener('dblclick', () => {
      popup.classList.add("hidden");
      quantityInput.value = 1;
      updatePrice();
    })


    function updatePrice() {
      const quantity = parseInt(quantityInput.value);
      const total = unitPrice * quantity;
      totalPriceEl.textContent = `$${total.toFixed(2)}`;
    }

    const newIncreaseBtn = increaseBtn.cloneNode(true);
    increaseBtn.replaceWith(newIncreaseBtn);

    newIncreaseBtn.addEventListener('click', () => {
      quantityInput.value = parseInt(quantityInput.value) + 1;
      updatePrice();
    });

    const newDecreaseBtn = decreaseBtn.cloneNode(true);
    decreaseBtn.replaceWith(newDecreaseBtn);

    newDecreaseBtn.addEventListener('click', () => {
      const currentQuantity = parseInt(quantityInput.value);
      if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        updatePrice();
      }

    });




    quantityInput.addEventListener('input', () => {
      if (parseInt(quantityInput.value) < 1 || isNaN(parseInt(quantityInput.value))) {
        quantityInput.value = 1;
      }
      updatePrice();
    });

    // Product Filter
    const productImage = document.getElementById("productImage");
    const colorRadio = document.querySelectorAll('input[name ="color"]')

    const productFilters = {
      Primary: "hue-rotate(0)",
      Veil: "hue-rotate(50deg) saturate(1.1)",
      Azure: "hue-rotate(200deg) saturate(1.1)",
      Emerald: "hue-rotate(100deg) saturate(1.05)",
      Frost: "grayscale(1) brightness(1.15)"
    };
    colorRadio.forEach(radio => {
      radio.addEventListener("change", () => {
        const selectedColor = radio.value;

        productImage.style.filter = productFilters[selectedColor];
      })
    });

    // Add to Cart AJAX
    const alert_cart = document.querySelector(".alert_cart");
    document.querySelectorAll(".add-cart-btn").forEach(button => {

      const newButton = button.cloneNode(true);
      button.replaceWith(newButton);

      newButton.addEventListener('click', function () {

        const form = this.closest("form");
        const formData = new FormData(form);
        const id = document.getElementById("id_input").value;
        formData.append("product_id", id);

        fetch("../controllers/add_to_cart.php", {
          method: "POST",
          body: formData
        })
          .then(res => res.text())
          .then(response => {
            if (response == "<p class='success_msg'><i class='fa-solid fa-circle-check'></i>Product Added To Cart !</p>") {
              alert_cart.classList.add("added");
            }
            showNotification(response);
          })
          .catch(err => showNotification(err));
      });
    });


    if (document.querySelector(".go_to_cart")) {
      document.querySelector(".go_to_cart").addEventListener('click', () => {
        alert_cart.classList.remove("added");
      });
    }







  }
  bindProductListeners();


  function getActiveCategoryId() {
    const activeBtn = document.querySelector('.category-btn.active');
    return activeBtn ? activeBtn.getAttribute('data-category-id') : '1';
  }

  document.getElementById("searchInput").addEventListener("keyup", function () {
    const product_nav = document.querySelector(".product-nav");

    const term = this.value.trim();
    const categoryId = getActiveCategoryId();

    if (term === "") {
      product_nav.classList.remove('product_nav_hidden');
    } else {
      product_nav.classList.add('product_nav_hidden');
    }
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../controllers/search_products.php?term=${encodeURIComponent(term)}&category_id=${categoryId}`, true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        document.querySelector(`#product-container-${categoryId}`).innerHTML = xhr.responseText;
        bindProductListeners();
        rebindWishlist();
      }
    };
    xhr.send();
  });




}



function setUpSliderImage() {

  // Pinned Image Scroll Animation

  document.fonts.ready.then(() => {
    const video = document.getElementById("backgroundVideo");
    const videoFilters = [
      "sepia(0.9) saturate(1.8) brightness(1.1)",
      "grayscale(1) saturate(0)",
      "grayscale(0.4) sepia(0.2) saturate(1.3) hue-rotate(70deg)",
    ];

    const strip = document.getElementById("strip");
    const images = strip.querySelectorAll("img");
    const container = document.getElementById("container");
    const containerHeight = container.offsetHeight;
    const textContainers = gsap.utils.toArray(".text-container");

    const master = gsap.timeline({
      scrollTrigger: {
        trigger: ".image-slider",
        start: "top top",
        end: () => "+=" + containerHeight * images.length * 2,
        scrub: true,
        pin: true,
      },
    });

    master.to(
      strip,
      {
        y: -containerHeight * (images.length - 1),
        ease: "power2.out",
        duration: 1,
      },
      0
    );

    const allTextLines = [];

    textContainers.forEach((container) => {
      const heading = container.querySelector("h1");
      const paragraph = container.querySelector("p");

      const splitHeading = new SplitText(heading, { type: "lines" });
      const splitParagraph = new SplitText(paragraph, { type: "lines" });

      const lines = [...splitHeading.lines, ...splitParagraph.lines];

      gsap.set(lines, {
        clipPath: "polygon(0 100%, 100% 100%, 100% 100%, 0% 100%)",
        y: 50,
      });

      allTextLines.push(lines);
    });

    function getFilterValues(filterStr) {
      const values = {
        grayscale: 0,
        saturate: 1,
        sepia: 0,
        brightness: 1,
        "hue-rotate": 0,
      };

      if (filterStr === "none") return values;

      const parts = filterStr.split(" ");
      parts.forEach((part) => {
        const [name, value] = part.replace(")", "").split("(");
        values[name] = parseFloat(value);
      });

      return values;
    }

    images.forEach((_, i) => {
      const tl = gsap.timeline();
      tl.to(strip, {
        y: -containerHeight * i,
        duration: 1.5,
        ease: "power1.inOut",
      });

      if (videoFilters[i]) {
        const prev = videoFilters[i - 1] || "none";
        const prevVals = getFilterValues(prev);
        const currVals = getFilterValues(videoFilters[i]);

        tl.to(
          { ...prevVals },
          {
            ...currVals,
            duration: 1,
            ease: "none",
            onUpdate: function () {
              const prog = this.progress();
              const grayscale = gsap.utils.interpolate(
                prevVals.grayscale,
                currVals.grayscale,
                prog
              );
              const saturate = gsap.utils.interpolate(
                prevVals.saturate,
                currVals.saturate,
                prog
              );
              const sepia = gsap.utils.interpolate(
                prevVals.sepia,
                currVals.sepia,
                prog
              );
              const brightness = gsap.utils.interpolate(
                prevVals.brightness,
                currVals.brightness,
                prog
              );
              const hueRotate = gsap.utils.interpolate(
                prevVals["hue-rotate"],
                currVals["hue-rotate"],
                prog
              );

              video.style.filter = `
                        grayscale(${grayscale})
                        saturate(${saturate})
                        sepia(${sepia})
                        brightness(${brightness})
                        hue-rotate(${hueRotate}deg)
                    `;
            },
          },
          "<"
        );
      }

      if (allTextLines[i - 1]) {
        tl.to(
          allTextLines[i - 1],
          {
            clipPath: "polygon(0 100%, 100% 100%, 100% 100%, 0% 100%)",
            y: 50,
            duration: 0.6,
            ease: "power4.in",
          },
          "<"
        );
      }

      if (allTextLines[i]) {
        tl.to(
          allTextLines[i],
          {
            clipPath: "polygon(0 0%, 100% 0%, 100% 100%, 0% 100%)",
            y: 0,
            stagger: 0.05,
            duration: 1,
            ease: "power4.out",
          },
          ">"
        );
      }

      master.add(tl);
    });
  });
}



function setUpSignup() {


  document.body.style.overflow = "hidden";
  document.documentElement.style.overflow = "hidden";
  document.body.addEventListener("touchmove", preventScroll, {
    passive: false,
  });

  function preventScroll(e) {
    e.preventDefault();
  }

  const signup_form = document.getElementById('signup_form');
  const login_form = document.getElementById('login_form');
  const username_input = document.getElementById('username_input');
  const email_input = document.getElementById('email_input');
  const phone_input = document.getElementById('phone_input');
  const password_input = document.getElementById('password_input');
  const repeat_password_input = document.getElementById('repeat_password_input');
  const login_email_input = document.getElementById('login_email_input');
  const login_password_input = document.getElementById('login_password_input');


  const signup_error_msg = document.getElementById('signup_error_message');
  const login_error_msg = document.getElementById('login_error_message');



  signup_form.addEventListener('submit', (e) => {

    let errors = [];

    if (username_input) {
      errors = getSignupFormErrors(username_input.value, email_input.value, phone_input.value,
        password_input.value, repeat_password_input.value);
    }

    if (errors.length > 0) {
      e.preventDefault();
      signup_error_msg.innerText = errors.join(". ");
    }
  });

  login_form.addEventListener('submit', (e) => {
    let errors = [];

    errors = getLoginFormErrors(login_email_input.value, login_password_input.value);

    if (errors.length > 0) {
      e.preventDefault();
      login_error_msg.innerText = errors.join(". ");
    }


  });
  function validatePassword(password) {
    const regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    return regex.test(password);
  }

  function getSignupFormErrors(username, email, phone, password, repeat_password) {
    let errors = [];

    if (username === '' || username == null) {
      errors.push("Username is Required");
      username_input.parentElement.classList.add('incorrect');

    }

    if (email === '' || email == null) {
      errors.push("Email is Required");
      email_input.parentElement.classList.add('incorrect');
    }
    if (phone === '' || phone == null) {
      errors.push("Phone is Required");
      phone_input.parentElement.classList.add('incorrect');
    }
    if (password === '' || password == null) {
      errors.push("Password is Required");
      password_input.parentElement.classList.add('incorrect');
    }
    if (repeat_password === '' || repeat_password == null) {
      errors.push("Repeated Password is Required");
      repeat_password_input.parentElement.classList.add('incorrect');
    }
    if (!validatePassword(password)) {
      errors.push("Passwords Must Be 8 Characters Long. At least One Uppercase Letter And A Number");
      password_input.parentElement.classList.add('incorrect');
    }

    if (password != repeat_password) {
      errors.push("Password Does Not Match With Repeated Password");
      password_input.parentElement.classList.add('incorrect');
      repeat_password_input.parentElement.classList.add('incorrect');

    }


    return errors;
  }



  function getLoginFormErrors(email, password) {
    let errors = [];

    if (email === '' || email == null) {
      errors.push("Email is Required");
      login_email_input.parentElement.classList.add('incorrect');
    }
    if (password === '' || password == null) {
      errors.push("Password is Required");
      login_password_input.parentElement.classList.add('incorrect');
    }
    return errors;
  }



  const allInputs = [username_input, email_input, password_input, repeat_password_input];

  allInputs.forEach((input) => {
    input.addEventListener('input', () => {
      if (input.parentElement.classList.contains('incorrect')) {
        input.parentElement.classList.remove('incorrect');
        error_msg.innerText = '';
      }
    })
  })

  // Gsap animation

  const signUpBtn = document.getElementById('signUpBtn')
  const loginBtn = document.getElementById('loginBtn')
  const signUpWrapper = document.querySelector(".signup_wrapper")
  const loginWrapper = document.querySelector(".login_wrapper")

  gsap.set(loginWrapper, {
    xPercent: 100,
    clipPath: "polygon(100% 0, 100% 0, 100% 100%, 100% 100%)"
  })

  loginBtn.addEventListener('click', (e) => {

    gsap.set(signUpWrapper, {
      clipPath: "polygon(0 0, 100% 0%, 100% 100%, 0% 100%)"
    })
    gsap.to(signUpWrapper, {
      xPercent: -100,
      duration: 1.6,
      ease: "power4.inOut",

    })

    gsap.to(loginWrapper, {
      xPercent: 0,
      duration: 1.6,
      ease: "power4.inOut",
      clipPath: "polygon(0% 0, 100% 0, 100% 100%, 0% 100%)"
    });
  });

  signUpBtn.addEventListener('click', () => {

    gsap.set(loginWrapper, {
      clipPath: "polygon(0 0, 100% 0%, 100% 100%, 0% 100%)"
    });
    gsap.to(loginWrapper, {
      xPercent: 100,
      duration: 1.6,
      ease: "power4.inOut",
      clipPath: "polygon(100% 0, 0% 0%, 0% 100%, 100% 100%)"

    });
    gsap.to(signUpWrapper, {
      xPercent: 0,
      duration: 1.6,
      ease: "power4.inOut"

    });
  })
}
function setUpCart() {
  document.querySelectorAll('.remove-item-btn').forEach((button) => {
    button.addEventListener("click", function () {
      const index = this.dataset.index;

      fetch("../controllers/remove_cart.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "index=" + encodeURIComponent(index)
      }).then(response => {
        if (!response.ok) throw new Error("Failed to remove item.");
        return response.text();
      })
        .then(message => {
          showNotification(message);
          this.closest(".border").remove();
        })
        .catch(err => {
          showNotification("<p class='error_msg'><i class='fa-solid fa-circle-exclamation'></i> " + err.message + "</p>");
        });
    });
  });

  const form = document.getElementById("discount_form");
  const receipt = document.querySelector(".receipt");

  form.addEventListener('submit', function (e) {

    e.preventDefault();
    const formData = new FormData(form);

    fetch("../controllers/discount.php", {
      method: "POST",
      body: formData
    }).then(res => res.text())
      .then(data => {
        showNotification(data);
      })
      .catch(err => {
        showNotification(err);
      });

  })

  const order_form = document.getElementById('order_form');
  order_form.addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(order_form);

    fetch("../controllers/order.php", {
      method: "POST",
      body: formData
    })
      .then(res => res.text())
      .then(data => {
        if (data.includes("Successfully Made An Order Thank You!")) {

          sessionStorage.setItem("openReceipt", "true");
          alert(data);
          location.reload();
        } else {
          showNotification(data);
        }
      })
      .catch(err => {
        alert("Error while inserting order ", err);
      });
  })

  receipt.addEventListener("dblclick", function () {
    receipt.classList.remove('open');
  })


  //Download receipt

  document.getElementById("download-image").addEventListener("click", () => {
    const receipt = document.querySelector(".receipt_card");

    html2canvas(receipt).then(canvas => {

      const link = document.createElement("a");
      link.download = "receipt.png";
      link.href = canvas.toDataURL("image/png");
      link.click();
    });
  });

}


function setUpVideoLoads() {
  const spinner = document.querySelector(".spinner");
  const video = document.getElementById("header_video");
  video.addEventListener("canplaythrough", () => {
    spinner.style.display = "none";
  })

}

// Page Load Functions
function initGlobal() {
  setUpHelpBubble();
  setUpNavigation();
  setUpLoader();


}
function initHome() {
  setUpHome();
  setUpParallax();
  setUpSliderImage();
  aboutAnimation();
}

function initProduct() {
  setUpLenis();
  setUpProduct();
  setUpVideoLoads()
}

function initCart() {
  setUpCart();
  setUpLenis();
  setUpVideoLoads()
}
function initContact() {
  setUpLenis();
  setUpContact();

}

function initAbout() {
  setUpVideoLoads()
  setUpLenis();
  setUpAbout();
  setUpSliderImage();
  testimonialCards();

}

function initSignup() {
  setUpVideoLoads()
  setUpSignup();
}
function initAdmin() {
  modeToggle();
}

// Reinitialize Page
function reinitializePage() {
  initGlobal();


  const page = document.body.dataset.page;

  if (page == "home") {
    initHome();
  } else if (page == "product") {
    initProduct();
  } else if (page == "cart") {
    initCart();
  } else if (page == "contact") {
    initContact();
  } else if (page == "about") {
    initAbout();
  }
  else if (page == "signup") {
    initSignup();
  }

}
