gsap.registerPlugin(ScrollTrigger);

const heroText1 = document.querySelector(".landing-page .content h1:nth-child(1)");

gsap.to(heroText1, {
    clipPath: "polygon(0% 0%, 100% 0%, 100% 50%, 0% 50%)",
    y: "-180px",
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
    y: "-100px",
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
    y: "-40px",

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


gsap.to(video, {
    y: "730px",
    width: "96vw",
    height: "75vh",
    scrollTrigger: {
        trigger: video,
        start: "-100px top",
        end: "600px center",
        scrub: 1,
    }
})

const hero_video = document.getElementById("load_video");
const hero_spinner = document.getElementById("hero_spinner")

hero_video.addEventListener("canplaythrough", () => {
    hero_spinner.style.display = "none"
})