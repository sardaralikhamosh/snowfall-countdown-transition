<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winter Countdown with Snowfall</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            height: 100vh;
        }
        
        #landing-page {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://hamqadam.com/wp-content/uploads/2025/08/Aga-Khan-4.jpg') center/cover no-repeat;
            overflow: hidden;
            position: relative;
        }

        #overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.8));
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s;
        }

        .launch-button {
            position: relative;
            width: 225px;
            height: 225px;
            border-radius: 50%;
            border: none;
            background-color: #135A32;
            color: #fff;
            font-size: 34px;
            z-index: 10;
            overflow: visible;
            cursor: pointer;
            box-shadow: 0 0 25px rgba(19, 90, 50, 0.5);
            transition: transform 0.2s;
        }

        .launch-button:hover {
            background: rgba(19, 90, 50, 0.8);
            transform: scale(1.05);
        }

        .launch-button #btnText {
            position: relative;
            z-index: 2;
        }

        .pulse-layer {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 225px;
            height: 225px;
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
        
        .snowflake {
            position: absolute;
            color: white;
            font-size: 1em;
            animation: snowFall linear infinite;
            pointer-events: none;
            user-select: none;
        }
        
        @keyframes snowFall {
            0% {
                transform: translateY(-10vh) translateX(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) translateX(10vw) rotate(360deg);
                opacity: 0;
            }
        }
        
        #audioControls {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 100;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        #audioControls:hover {
            background: rgba(0, 0, 0, 0.7);
        }
        
        #volumeIcon {
            font-size: 24px;
            color: white;
        }
        
        .instructions {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            z-index: 10;
            max-width: 300px;
        }
    </style>
</head>
<body>
    <div id="landing-page">
        <!-- Gradient overlay (hidden at first) -->
        <div id="overlay"></div>

        <!-- Launch Button -->
        <button id="launchBtn" class="launch-button">
            <span id="btnText">Play Ginan</span>
            <span class="pulse-layer layer1"></span>
            <span class="pulse-layer layer2"></span>
            <span class="pulse-layer layer3"></span>
        </button>

        <!-- Confetti Container -->
        <div id="confetti"></div>
        
        <!-- Snowflakes Container -->
        <div id="snowflakes"></div>
        
        <!-- Audio controls -->
        <div id="audioControls">
            <span id="volumeIcon">🔊</span>
        </div>
        
        <div class="instructions">
            <p>Click the Play Ginan button to start the countdown with audio. Press Spacebar for quick start.</p>
        </div>
    </div>

    <script>
        const launchBtn = document.getElementById("launchBtn");
        const btnText = document.getElementById("btnText");
        const confettiContainer = document.getElementById("confetti");
        const snowflakesContainer = document.getElementById("snowflakes");
        const overlay = document.getElementById("overlay");
        const landingPage = document.getElementById("landing-page");
        const audioControls = document.getElementById("audioControls");
        const volumeIcon = document.getElementById("volumeIcon");
        
        // Background images
        const initialBackground = 'https://hamqadam.com/wp-content/uploads/2025/08/Aga-Khan-4.jpg';
        const snowBackground = 'https://hamqadam.com/wp-content/uploads/2025/08/aga-khan-v.avif';

        // Set initial styles
        confettiContainer.style.position = 'absolute';
        confettiContainer.style.top = '0';
        confettiContainer.style.left = '0';
        confettiContainer.style.width = '100%';
        confettiContainer.style.height = '100%';
        confettiContainer.style.pointerEvents = 'none';
        confettiContainer.style.overflow = 'hidden';
        
        snowflakesContainer.style.position = 'absolute';
        snowflakesContainer.style.top = '0';
        snowflakesContainer.style.left = '0';
        snowflakesContainer.style.width = '100%';
        snowflakesContainer.style.height = '100%';
        snowflakesContainer.style.pointerEvents = 'none';
        snowflakesContainer.style.overflow = 'hidden';
        snowflakesContainer.style.display = 'none';

        // Create audio element
        let backgroundAudio = new Audio();
        backgroundAudio.loop = true;
        // Replace with your actual audio file URL
        backgroundAudio.src = 'https://hamqadam.com/wp-content/uploads/2025/08/urdu-ginan.mpeg.wav';
        backgroundAudio.volume = 0.7; // Set initial volume to 70%
        
        let isMuted = false;

        // Mute button functionality
        audioControls.addEventListener("click", () => {
            isMuted = !isMuted;
            backgroundAudio.muted = isMuted;
            volumeIcon.textContent = isMuted ? "🔇" : "🔊";
        });

        launchBtn.addEventListener("click", () => {
            // Start audio immediately on button click
            backgroundAudio.play().catch(e => {
                console.log("Audio play failed:", e);
            });
            
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
                    
                    // Show snowflakes immediately
                    snowflakesContainer.style.display = "block";
                    createSnowflakes();

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
        
        function createSnowflakes() {
            const snowflakes = ['❄', '❅', '❆', '✻', '✼', '❄', '❅', '❆'];
            const snowflakeCount = 50;
            
            for (let i = 0; i < snowflakeCount; i++) {
                const snowflake = document.createElement("div");
                snowflake.classList.add("snowflake");
                snowflake.textContent = snowflakes[Math.floor(Math.random() * snowflakes.length)];
                
                const left = Math.random() * 100;
                const size = Math.random() * 1.5 + 0.5;
                const duration = Math.random() * 5 + 5;
                const delay = Math.random() * 5;
                const opacity = Math.random() * 0.7 + 0.3;
                
                snowflake.style.left = `${left}vw`;
                snowflake.style.fontSize = `${size}em`;
                snowflake.style.animationDuration = `${duration}s`;
                snowflake.style.animationDelay = `${delay}s`;
                snowflake.style.opacity = opacity;
                
                snowflakesContainer.appendChild(snowflake);
            }
        }
        
        document.addEventListener('keydown', function(event) {
            // Check if the spacebar is pressed and Play Ginan button is still visible
            if (event.code === 'Space' && launchBtn.style.display !== 'none') {
                event.preventDefault(); // Prevent default spacebar scrolling
                launchBtn.click();
            }
        });
    </script>
</body>
</html>