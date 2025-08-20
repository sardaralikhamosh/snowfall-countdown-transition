<div class="elementor-element elementor-element-b0f96d1 elementor-widget elementor-widget-html" data-id="b0f96d1" data-element_type="widget" data-widget_type="html.default">
  <div id="landing-page" style="height: 100vh; display: flex; justify-content: center; align-items: center; background: url('https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-3.jpg') center/cover no-repeat; overflow: hidden; font-family: 'Arial', sans-serif; position: relative;">

    <!-- Gradient overlay (hidden at first) -->
    <div id="overlay" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.8)); opacity: 0; pointer-events: none; transition: opacity 0.6s;"></div>

    <!-- Launch Button -->
    <button id="launchBtn" class="launch-button">
      <span id="btnText">Launch</span>
      <span class="pulse-layer layer1"></span>
      <span class="pulse-layer layer2"></span>
      <span class="pulse-layer layer3"></span>
    </button>

    <!-- Confetti Container -->
    <div id="confetti" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; overflow: hidden;"></div>
    
    <!-- GIF Container (hidden initially) -->
    <div id="gif-container" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; overflow: hidden; display: none; z-index: 999;">
      <img src="https://hamqadam.com/wp-content/uploads/2025/08/W9k1.gif" style="width: 100%; height: 100%; object-fit: cover;" alt="Celebration GIF">
    </div>
  </div>

  <style>
    .launch-button {
      position: relative;
      width: 225px; /* increased */
      height: 225px; /* increased */
      border-radius: 50%;
      border: none;
      background-color: #1C5A34 !important;
      color: #fff;
      font-size: 34px;
      margin-top: 60px;
      z-index: 10;
      overflow: visible;
      cursor: pointer;
      box-shadow: 0 0 25px rgba(19, 90, 50, 0.5);
    }

    .launch-button:hover {
      background: rgba(19, 90, 50, 0.8) !important;
    }

    .launch-button #btnText {
      position: relative;
      z-index: 2;
    }

    .pulse-layer {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 225px; /* increased */
      height: 225px; /* increased */
      border-radius: 50%;
      background: rgba(19, 90, 50, 0.3);
      transform: translate(-50%, -50%) scale(1);
      animation: pulseEffect 2s infinite ease-out;
      z-index: 1;
    }

    .layer2 {
      animation-delay: 0.5s;
      background: rgba(19, 90, 50, 0.2);
    }

    .layer3 {
      animation-delay: 1s;
      background: rgba(19, 90, 50, 0.1);
    }

    @keyframes pulseEffect {
      0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
      }
      100% {
        transform: translate(-50%, -50%) scale(2.5);
        opacity: 0;
      }
    }

    #btnText.timer-active {
      font-size: 55px;
      font-weight: bold;
      transition: font-size 0.3s ease-in-out;
    }

    .confetti-piece {
      position: absolute;
      width: 8px;
      height: 14px;
      background-color: hsl(var(--hue), 100%, 60%);
      opacity: 0.8;
      border-radius: 2px;
      animation: modernFall 2s ease-out forwards;
    }

    @keyframes modernFall {
      0% {
        transform: translateY(-20px) rotateZ(0deg);
        opacity: 1;
      }
      100% {
        transform: translateY(100vh) rotateZ(720deg);
        opacity: 0;
      }
    }
  </style>

  <script>
    const launchBtn = document.getElementById("launchBtn");
    const btnText = document.getElementById("btnText");
    const confettiContainer = document.getElementById("confetti");
    const overlay = document.getElementById("overlay");
    const landingPage = document.getElementById("landing-page");
    const gifContainer = document.getElementById("gif-container");
    
    // Background images
    const initialBackground = 'https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-3.jpg';
    const snowBackground = 'https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-2.jpg';

    launchBtn.addEventListener("click", () => {
      let counter = 5;
      btnText.textContent = counter;

      // Add large timer style
      btnText.classList.add("timer-active");

      const interval = setInterval(() => {
        counter--;
        if (counter > 0) {
          btnText.textContent = counter;
        } else {
          clearInterval(interval);
          launchBtn.style.display = "none";

          // Change background image immediately when countdown finishes
          landingPage.style.backgroundImage = `url('${snowBackground}')`;
          
          // Show background overlay
          overlay.style.opacity = "1";
          
          // Show the GIF in full screen
          gifContainer.style.display = "block";

          // Trigger confetti
          triggerConfetti();
        }
      }, 1000);
    });

    function triggerConfetti() {
      for (let i = 0; i < 120; i++) {
        const confetti = document.createElement("div");
        confetti.classList.add("confetti-piece");

        const left = Math.random() * 100;
        const delay = Math.random() * 1;
        const rotate = Math.random() * 360;
        const hue = Math.floor(Math.random() * 360);

        confetti.style.left = `${left}vw`;
        confetti.style.animationDelay = `${delay}s`;
        confetti.style.setProperty('--hue', hue);
        confetti.style.transform = `rotate(${rotate}deg)`;

        confettiContainer.appendChild(confetti);

        setTimeout(() => confetti.remove(), 3000);
      }
    }
    
    document.addEventListener('keydown', function(event) {
      // Check if the spacebar is pressed and launch button is still visible
      if (event.code === 'Space' && launchBtn.style.display !== 'none') {
        event.preventDefault(); // Prevent default spacebar scrolling
        launchBtn.click();
      }
    });
  </script>
</div>