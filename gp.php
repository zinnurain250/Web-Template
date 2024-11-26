<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GP Balance Check</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            animation: gradientMove 10s ease infinite;
        }

        @keyframes gradientMove {
            0% {
                background: linear-gradient(135deg, #6a11cb, #2575fc);
            }
            50% {
                background: linear-gradient(135deg, #ff7e5f, #feb47b);
            }
            100% {
                background: linear-gradient(135deg, #6a11cb, #2575fc);
            }
        }

        .container {
            background: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .number-input {
            padding: 15px;
            width: 100%;
            font-size: 18px;
            border-radius: 10px;
            border: 2px solid #2575fc;
            margin-bottom: 25px;
            outline: none;
            transition: border-color 0.3s ease;
            background-color: #f0f8ff;
            color: #333;
        }

        .number-input:focus {
            border-color: #6a11cb;
        }

        .btn {
            padding: 14px 20px;
            font-size: 18px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-submit {
            background-color: #6a11cb;
            color: #fff;
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.2);
        }

        .btn-submit:hover {
            background-color: #5a0db3;
            box-shadow: 0 8px 20px rgba(106, 17, 203, 0.3);
        }

        .btn-join {
            background-color: #2575fc;
            color: #fff;
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.2);
        }

        .btn-join:hover {
            background-color: #1d66e3;
            box-shadow: 0 8px 20px rgba(37, 117, 252, 0.3);
        }

        /* JSON Response Styling */
        .response {
            margin-top: 30px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            color: #333;
            font-size: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #6a11cb;
            visibility: hidden;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 1s ease, visibility 1s ease, transform 1s ease;
        }

        .response.show {
            visibility: visible;
            opacity: 1;
            transform: scale(1);
        }

        .response-line {
            display: none;
            font-size: 16px;
            color: #555;
            margin-bottom: 12px;
            padding: 10px;
            background-color: #f0f8ff;
            border-radius: 5px;
            border-left: 5px solid #6a11cb;
            transition: all 0.4s ease;
        }

        .response-line.show {
            display: block;
            animation: fadeInLine 0.5s ease-in-out forwards;
        }

        @keyframes fadeInLine {
            0% {
                opacity: 0;
                transform: translateX(-10px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .response-line strong {
            color: #6a11cb;
            font-weight: bold;
        }

        /* Hover and Button Effects */
        .btn:active {
            transform: scale(0.98);
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>GP Balance Check</h1>
        <form method="POST">
            <input type="number" name="number" class="number-input" placeholder="Enter your GP number" required>
            <br>
            <button type="submit" name="submit" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-join" onclick="window.open('https://t.me/satiszone/', '_blank')">Join Channel</button>
        </form>

        <div id="responseContainer" class="response">
            <div class="response-line" id="line1"></div>
            <div class="response-line" id="line2"></div>
            <div class="response-line" id="line3"></div>
            <div class="response-line" id="line4"></div>
            <div class="response-line" id="line5"></div>
            <div class="response-line" id="line6"></div>
            <div class="response-line" id="line7"></div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $number = $_POST['number'];
            $api_url = "http://103.98.76.5/~rafixtmy/gp-bal.php?number=" . urlencode($number);

            // Fetching the API response
            $response = @file_get_contents($api_url);
            if ($response === FALSE) {
                echo '<script>
                        document.getElementById("line1").innerHTML = "<strong>Platform:</strong> Error fetching data.";
                        document.getElementById("line2").innerHTML = "<strong>MSISDN:</strong> Not available.";
                        document.getElementById("line3").innerHTML = "<strong>Account Balance:</strong> N/A";
                        document.getElementById("line4").innerHTML = "<strong>Rate Plan:</strong> N/A";
                        document.getElementById("line5").innerHTML = "<strong>MCA Status:</strong> N/A";
                        document.getElementById("line6").innerHTML = "<strong>Success:</strong> false";
                        document.getElementById("line7").innerHTML = "<strong>Status Code:</strong> 500";
                        document.getElementById("responseContainer").classList.add("show");
                        document.getElementById("line1").classList.add("show");
                        document.getElementById("line2").classList.add("show");
                        document.getElementById("line3").classList.add("show");
                        document.getElementById("line4").classList.add("show");
                        document.getElementById("line5").classList.add("show");
                        document.getElementById("line6").classList.add("show");
                    </script>';
            } else {
                $json_response = json_decode($response, true);
                echo '<script>
                        document.getElementById("line1").innerHTML = "<strong>Platform:</strong> ' . $json_response['platform'] . '";
                        document.getElementById("line2").innerHTML = "<strong>MSISDN:</strong> ' . $json_response['msisdn'] . '";
                        document.getElementById("line3").innerHTML = "<strong>Account Balance:</strong> ' . $json_response['accountBalance'] . '";
                        document.getElementById("line4").innerHTML = "<strong>Rate Plan:</strong> ' . $json_response['ratePlan'] . '";
                        document.getElementById("line5").innerHTML = "<strong>MCA Status:</strong> ' . $json_response['mcaStatus'] . '";
                        document.getElementById("line6").innerHTML = "<strong>Success:</strong> ' . ($json_response['success'] ? 'true' : 'false') . '";
                        document.getElementById("line7").innerHTML = "<strong>Status Code:</strong> ' . $json_response['status_code'] . '";
                        document.getElementById("responseContainer").classList.add("show");
                        document.getElementById("line1").classList.add("show");
                        document.getElementById("line2").classList.add("show");
                        document.getElementById("line3").classList.add("show");
                        document.getElementById("line4").classList.add("show");
                        document.getElementById("line5").classList.add("show");
                        document.getElementById("line6").classList.add("show");
                    </script>';
            }
        }
        ?>
    </div>
</body>
</html>
