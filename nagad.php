<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nagad Info Checker</title>
    <style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
        }
        body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #8B46FF 0%, #4B6BFF 100%);
        }
        
        .container {
        width: 90%;
        max-width: 400px;
        background: white;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 20px;
        animation: bounce 1s infinite;
        }
        
        @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
        }
        
        .input-field {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        }
        
        .input-field:focus {
        border-color: #4B6BFF;
        box-shadow: 0 0 10px rgba(75, 107, 255, 0.2);
        outline: none;
        }
        
        .button-group {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        }
        
        .button {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        }
        
        .button:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        }
        
        .button:active:after {
        width: 200px;
        height: 200px;
        }
        
        .get-info {
        background-color: #2ECC71;
        }
        
        .join-channel {
        background-color: #FF4757;
        text-decoration: none;
        }
        
        .info-container {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out;
        opacity: 0;
        }
        
        .info-container.show {
        max-height: 500px;
        opacity: 1;
        }
        
        .info-item {
        margin: 10px 0;
        display: flex;
        align-items: center;
        transform: translateX(-20px);
        opacity: 0;
        transition: all 0.3s ease;
        }
        
        .info-container.show .info-item {
        transform: translateX(0);
        opacity: 1;
        }
        
        .info-container.show .info-item:nth-child(1) { transition-delay: 0.1s; }
        .info-container.show .info-item:nth-child(2) { transition-delay: 0.2s; }
        .info-container.show .info-item:nth-child(3) { transition-delay: 0.3s; }
        .info-container.show .info-item:nth-child(4) { transition-delay: 0.4s; }
        .info-container.show .info-item:nth-child(5) { transition-delay: 0.5s; }
        .info-container.show .info-item:nth-child(6) { transition-delay: 0.6s; }
        .info-container.show .info-item:nth-child(7) { transition-delay: 0.7s; }
        .info-container.show .info-item:nth-child(8) { transition-delay: 0.8s; }
        
        .info-label {
        color: #4B6BFF;
        font-weight: bold;
        margin-right: 10px;
        }
        
        .loading {
        text-align: center;
        display: none;
        animation: pulse 1s infinite;
        }
        
        @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
        }
        
        .error-message {
        color: #FF4757;
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
        display: none;
        padding: 15px;
        border: 2px solid #FF4757;
        border-radius: 10px;
        background-color: #ffe6e6;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">⭐ Nagad Info Checker ⭐</h1>
        <form method="POST">
            <input type="tel" name="phoneNumber" class="input-field" placeholder="Enter Number Here (e.g., 01XXXXXXXXX)" required>
            <div class="button-group">
                <button type="submit" class="button get-info">🔍 Get Info</button>
                <a href="https://t.me/satiszone" class="button join-channel">💬 Join TG</a>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['phoneNumber'])) {
            $phoneNumber = trim($_POST['phoneNumber']);
            if (strlen($phoneNumber) === 11 && strpos($phoneNumber, '01') === 0) {
                $url = "https://blush-janaye-60.tiiny.io/?msisdn=" . $phoneNumber;
                $response = file_get_contents($url);
                
                if ($response !== FALSE) {
                    $data = json_decode($response, true);
                    if ($data) {
                        echo '<div id="infoContainer" class="info-container show">';
                        echo '<div class="info-item"><span class="info-label">👤 Name:</span><span>' . htmlspecialchars($data['name'] ?? 'N/A') . '</span></div>';
                        
                        echo '<div class="info-item"><span class="info-label">🆔 User ID:</span><span>' . htmlspecialchars($data['userId']) . '</span></div>';
                        echo '<div class="info-item"><span class="info-label">📍 Status:</span><span>' . htmlspecialchars($data['status']) . '</span></div>';
                        echo '<div class="info-item"><span class="info-label">🔍 User Type:</span><span>' . htmlspecialchars($data['userType']) . '</span></div>';
                        echo '<div class="info-item"><span class="info-label">💼 RB Base:</span><span>' . (isset($data['rbBase']) && $data['rbBase'] ? 'Yes' : 'No') . '</span></div>';
                        echo '<div class="info-item"><span class="info-label">🔑 Auth Token Info:</span><span>' . (isset($data['authTokenInfo']) ? htmlspecialchars($data['authTokenInfo']) : 'N/A') . '</span></div>';
                        echo '<div class="info-item"><span class="info-label">✅ Verification Status:</span><span>' . htmlspecialchars($data['verificationStatus']) . '</span></div>';
                        echo '<div class="info-item"><span class="info-label">⚙️ Execution Status:</span><span>' . (isset($data['executionStatus']) ? htmlspecialchars($data['executionStatus']) : 'N/A') . '</span></div>';
                        echo '</div>';
                    } else {
                        echo '<div id="errorMessage" class="error-message">🤖 Invalid data received from server or no information found.</div>';
                                            }
                                        } else {
                                            echo '<div id="errorMessage" class="error-message">❌ Error in fetching data. Please try again later.</div>';
                                        }
                                    } else {
                                        echo '<div id="errorMessage" class="error-message">⚠️ Invalid phone number format. Please enter a valid number starting with "01".</div>';
                                    }
                                }
                                ?>
                                
                                <div id="loading" class="loading">
                                    <div class="shimmer" style="width: 50%; height: 20px; margin: 10px auto;"></div>
                                    <div class="shimmer" style="width: 80%; height: 20px; margin: 10px auto;"></div>
                                    <div class="shimmer" style="width: 60%; height: 20px; margin: 10px auto;"></div>
                                </div>
                            </div>
                        
                            <script>
                                document.querySelector('form').addEventListener('submit', function(event) {
                                    document.getElementById('loading').style.display = 'block';
                                    setTimeout(function() {
                                        document.getElementById('loading').style.display = 'none';
                                    }, 3000);  // Simulating loading delay
                                });
                            </script>
                        </body>
                        </html>
                        