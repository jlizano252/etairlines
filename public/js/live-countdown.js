// LIVE COUNTDOWN...

window.addEventListener('load', function() {
    setInterval( countdown, 1000);
});

const countdown = () => {
    // Count down date...
    let countDownDate = new Date("Aug 15, 2022 08:00:00").getTime();

    // Current date...
    let now = new Date().getTime();

    // Range...
    let distance = countDownDate - now;

    // Days, hours, minutes and seconds...
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("count").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
        document.getElementById("count").innerHTML = "EXPIRED";
    }
}
