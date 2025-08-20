<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown with Single Play GIF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body, html {
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
            position: relative;
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
            cursor: pointer;
            box-shadow: 0 0 25px rgba(19, 90, 50, 0.5);
            transition: background-color 0.3s;
        }

        .launch-button:hover {
            background-color: rgba(19, 90, 50, 1);
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
            background: rgba(19, 90, 50, 1);
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
        
        #gif-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            display: none;
            z-index: 5;
        }
        
        #gif-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div id="landing-page">
        <!-- Launch Button -->
        <button id="launchBtn" class="launch-button">
            <span id="btnText">Launch</span>
            <span class="pulse-layer layer1"></span>
            <span class="pulse-layer layer2"></span>
            <span class="pulse-layer layer3"></span>
        </button>
        
        <!-- GIF Container (hidden initially) -->
        <div id="gif-container">
            <img id="gif-image" src="https://hamqadam.com/wp-content/uploads/2025/08/output_transparent.gif" alt="Celebration GIF">
        </div>
    </div>

    <script>
        const launchBtn = document.getElementById("launchBtn");
        const btnText = document.getElementById("btnText");
        const landingPage = document.getElementById("landing-page");
        const gifContainer = document.getElementById("gif-container");
        const gifImage = document.getElementById("gif-image");
        
        // Background images
        const initialBackground = 'https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-3.jpg';
        const finalBackground = 'https://blueviolet-mantis-359437.hostingersite.com/wp-content/uploads/2025/08/yasi-sir-data-2.jpg';

        // Track if GIF has played
        let gifPlayed = false;

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
                    landingPage.style.backgroundImage = `url('${finalBackground}')`;
                    
                    // Show the GIF in full screen (only if not played before)
                    if (!gifPlayed) {
                        gifContainer.style.display = "block";
                        gifPlayed = true;
                        
                        // Hide GIF after it finishes playing (assuming 4 seconds duration)
                        setTimeout(() => {
                            gifContainer.style.display = "none";
                        }, 4000);
                    }
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