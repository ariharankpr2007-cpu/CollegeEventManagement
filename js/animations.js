document.addEventListener("DOMContentLoaded", function () {

    const revealElements =
        document.querySelectorAll(".scroll-reveal");

    if (!("IntersectionObserver" in window)) {
        revealElements.forEach(function (element) {
            element.classList.add("visible");
        });
        return;
    }

    const observer = new IntersectionObserver(
        function (entries, observer) {

            entries.forEach(function (entry) {

                if (entry.isIntersecting) {

                    entry.target.classList.add("visible");

                    observer.unobserve(entry.target);
                }

            });

        },
        {
            threshold: 0.15
        }
    );

    revealElements.forEach(function (element) {
        observer.observe(element);
    });

});
/* =========================================
   CAMPUSHUB STAT COUNTERS
========================================= */

const counters = document.querySelectorAll(".counter");

counters.forEach(function (counter) {

    const target = Number(counter.getAttribute("data-target"));
    const suffix = counter.textContent.includes("+") ? "+" : "";

    let current = 0;

    const duration = 1200;
    const startTime = performance.now();

    counter.classList.add("counting");

    function updateCounter(currentTime) {

        const elapsed = currentTime - startTime;

        const progress = Math.min(elapsed / duration, 1);

        const easedProgress =
            1 - Math.pow(1 - progress, 3);

        current = Math.floor(target * easedProgress);

        if (target === 1000) {
            counter.textContent =
                current.toLocaleString() + "+";
        }
        else if (target === 24) {
            counter.textContent =
                current + "/7";
        }
        else {
            counter.textContent =
                current + suffix;
        }

        if (progress < 1) {
            requestAnimationFrame(updateCounter);
        }
        else {
            counter.classList.remove("counting");
        }
    }

    requestAnimationFrame(updateCounter);

});