gsap.registerPlugin(ScrollTrigger);

const heroText1 = document.querySelector(".landing-page .content h1:nth-child(1)");

gsap.to(heroText1, {
    clipPath: "polygon(0% 0%, 100% 0%, 100% 50%, 0% 50%)",
    y: "-100px",
    scrollTrigger: {
        trigger: heroText1,
        start: "-183px center",
        end: "500px center",
        scrub: 1,

    }
})
const heroText2 = document.querySelector(".landing-page .content h1:nth-child(2)");

gsap.to(heroText2, {
    clipPath: "polygon(0% 0%, 100% 0%, 100% 28%, 0% 28%)",
    y: "-50px",
    scrollTrigger: {
        trigger: heroText2,
        start: "-70px center",
        end: "500px center",
        scrub: 1,
    }
})
const heroText3 = document.querySelector(".landing-page .content h1:nth-child(3)");

gsap.to(heroText3, {
    clipPath: "polygon(0% 0%, 100% 0%, 100% 20%, 0% 20%)",
    y: "-20px",

    scrollTrigger: {
        trigger: heroText3,
        start: "20px center",
        end: "500px center",
        scrub: 1,
    }
})
const heroText4 = document.querySelector(".landing-page .content h1:nth-child(4)");

gsap.to(heroText4, {
    clipPath: "polygon(0% 0%, 100% 0%, 100% 7%, 0% 7%)",

    scrollTrigger: {
        trigger: heroText4,
        start: "63px center",
        end: "500px center",
        scrub: 1,
    }
})


const video_container = document.querySelector(".hero-video");
const video = document.querySelector(".hero-video .video");

const windowWidth = window.innerWidth;


gsap.set(video, {
    y: windowWidth > 800 ? "-108vh" : "-105vh",
    width: windowWidth > 800 ? "30vw" : "70%",
    height: windowWidth > 800 ? "33vh" : "40vh",
})
gsap.to(video, {
    y: "0",
    width: "95%",
    height: "100%",
    scrollTrigger: {
        trigger: video,
        start: "top top",
        end: "600px top",
        scrub: 1,
    }
})

const hero_video = document.getElementById("load_video");
const hero_spinner = document.getElementById("hero_spinner")

hero_video.addEventListener("canplaythrough", () => {
    hero_spinner.style.display = "none"
})