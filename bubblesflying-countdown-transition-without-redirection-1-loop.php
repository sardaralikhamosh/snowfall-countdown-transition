<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown with Single Loop GIF</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }
        
        #landing-page {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-3.jpg') center/cover no-repeat;
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
            z-index: 5;
        }

        .launch-button {
            position: relative;
            width: 225px;
            height: 225px;
            border-radius: 50%;
            border: none;
            background-color: #1C5A34 !important;
            color: #fff;
            font-size: 34px;
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
        
        #gif-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            display: none;
            z-index: 15;
        }
        
        #gif-player {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .replay-button {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 24px;
            background-color: rgba(28, 90, 52, 0.8);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 18px;
            cursor: pointer;
            z-index: 20;
            display: none;
            transition: all 0.3s ease;
        }
        
        .replay-button:hover {
            background-color: rgba(28, 90, 52, 1);
            transform: translateX(-50%) scale(1.05);
        }
    </style>
</head>
<body>
    <div id="landing-page">
        <!-- Gradient overlay -->
        <div id="overlay"></div>

        <!-- Launch Button -->
        <button id="launchBtn" class="launch-button">
            <span id="btnText">Launch</span>
            <span class="pulse-layer layer1"></span>
            <span class="pulse-layer layer2"></span>
            <span class="pulse-layer layer3"></span>
        </button>

        <!-- Confetti Container -->
        <div id="confetti"></div>
        
        <!-- GIF Container -->
        <div id="gif-container">
            <video id="gif-player" playsinline></video>
        </div>
        
        <!-- Replay Button -->
        <button id="replayBtn" class="replay-button">Play Again</button>
    </div>

    <script>
        const launchBtn = document.getElementById("launchBtn");
        const btnText = document.getElementById("btnText");
        const confettiContainer = document.getElementById("confetti");
        const overlay = document.getElementById("overlay");
        const landingPage = document.getElementById("landing-page");
        const gifContainer = document.getElementById("gif-container");
        const gifPlayer = document.getElementById("gif-player");
        const replayBtn = document.getElementById("replayBtn");
        
        // Background images
        const initialBackground = 'https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-3.jpg';
        const snowBackground = 'https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-2.jpg';
        
        // Set up the video to play only once
        gifPlayer.addEventListener('loadedmetadata', function() {
            // Ensure it only plays once
            gifPlayer.loop = false;
        });
        
        gifPlayer.addEventListener('ended', function() {
            // Show replay button when video ends
            replayBtn.style.display = 'block';
        });

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
                    
                    // Show and play the GIF video (single play)
                    gifContainer.style.display = "block";
                    gifPlayer.src = "https://hamqadam.com/wp-content/uploads/2025/08/birthday-12378.gif";
                    gifPlayer.play();

                    // Trigger confetti
                    triggerConfetti();
                }
            }, 1000);
        });
        
        // Replay functionality
        replayBtn.addEventListener("click", function() {
            gifPlayer.currentTime = 0;
            gifPlayer.play();
            replayBtn.style.display = 'none';
            triggerConfetti();
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
</body>
</html>