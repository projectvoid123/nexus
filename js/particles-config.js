particlesJS('particles-js', {
    particles: {
        number: {
            value: 255,
            density: {
                enable: true,
                value_area: 789.15
            }
        },
        color: {
            value: "#ffffff"
        },
        shape: {
            type: "circle"
        },
        opacity: {
            value: 0.65,
            random: false,
            animation: {
                enable: true,
                speed: 0.25,
                opacity_min: 0,
                sync: false
            }
        },
        size: {
            value: 2.5,
            random: true,
            animation: {
                enable: true,
                speed: 0.333,
                size_min: 0,
                sync: false
            }
        },
        line_linked: {
            enable: false
        },
        move: {
            enable: true,
            speed: 0.3,
            direction: "none",
            random: true,
            straight: false,
            out_mode: "out",
            bounce: false
        }
    },
    interactivity: {
        detect_on: "canvas",
        events: {
            onhover: {
                enable: false,
                mode: "bubble"
            },
            onclick: {
                enable: false,
                mode: "push"
            },
            resize: true
        }
    },
    retina_detect: true
});