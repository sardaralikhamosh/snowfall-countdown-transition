<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown to Video</title>
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
            background: url('https://hamqadam.com/wp-content/uploads/2025/08/yasi-sir-data-3.jpg') center/cover no-repeat;
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
            background-color: #1C5A34;
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

        #bgVideo {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            z-index: -1;
            display: none;
            object-fit: cover;
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
        
        @media (max-width: 768px) {
            .launch-button {
                width: 180px;
                height: 180px;
                font-size: 28px;
            }
            
            #btnText.timer-active {
                font-size: 45px;
            }
            
            .instructions {
                bottom: 10px;
                left: 10px;
                right: 10px;
                max-width: none;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div id="landing-page">
        <!-- Gradient overlay (hidden at first) -->
        <div id="overlay"></div>

        <!-- Video Background (hidden at first) -->
        <video id="bgVideo" loop muted playsinline>
            <source src="https://hamqadam.com/wp-content/uploads/2025/08/bg.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Launch Button -->
        <button id="launchBtn" class="launch-button">
            <span id="btnText">Launch</span>
            <span class="pulse-layer layer1"></span>
            <span class="pulse-layer layer2"></span>
            <span class="pulse-layer layer3"></span>
        </button>
        
        <div class="instructions">
            <p>Click the Launch button to start the countdown. Press Spacebar for quick start.</p>
        </div>
    </div>

    <script>
        const launchBtn = document.getElementById("launchBtn");
        const btnText = document.getElementById("btnText");
        const overlay = document.getElementById("overlay");
        const landingPage = document.getElementById("landing-page");
        const bgVideo = document.getElementById("bgVideo");

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

                    // Hide the background image and show the video
                    landingPage.style.backgroundImage = 'none';
                    bgVideo.style.display = 'block';
                    
                    // Play the video
                    bgVideo.play().catch(e => {
                        console.log("Video play failed:", e);
                    });
                    
                    // Show background overlay
                    overlay.style.opacity = "1";
                }
            }, 1000);
        });
        
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