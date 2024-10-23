$(document).ready(function () {
    let timeLeft = 300; // 5 minutes in seconds
    const timerElement = document.getElementById('timer');

    function startCountdown() {
        const countdownInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                // Reload the page when the countdown ends
                window.location.reload();
            } else {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }
        }, 1000);
    }

    // Start the countdown when the page loads
    startCountdown();
})