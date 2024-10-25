<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Sender</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .sms-form {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            max-width: 420px;
            width: 100%;
            transition: transform 0.3s ease-in-out;
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
        }
        .sms-form:before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #a0aec0, #718096);
            border-radius: 14px;
            z-index: -1;
        }
        .sms-form:hover {
            transform: translateY(-5px);
        }
        .sms-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3748;
            font-size: 24px;
        }
        .sms-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #4a5568;
        }
        .sms-form input, 
        .sms-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .sms-form input:focus, 
        .sms-form textarea:focus {
            border-color: #a0aec0;
            outline: none;
        }
        .sms-form button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4fd1c5, #3182ce);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .sms-form button:hover {
            background: linear-gradient(135deg, #38b2ac, #2b6cb0);
            transform: scale(1.03);
        }
        .notification {
            display: none;
            text-align: center;
            margin-top: 10px;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .notification.show {
            opacity: 1;
            display: block;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        /* Button for back navigation */
        .back-btn {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .back-btn:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
            transform: scale(1.03);
        }
        @media (max-width: 600px) {
            .sms-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="sms-form">
        <h2>Send SMS</h2>
        <form id="smsForm">
            <label for="to">To:</label>
            <input type="text" id="to" name="to" placeholder="Enter phone number" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
            
            <button type="submit">Send</button>
        </form>

        <form action="index.php">
            <button class="back-btn" type="submit">BACK</button>
        </form>

        <div class="notification success" id="successMessage">
            SMS sent successfully!
        </div>
        <div class="notification error" id="errorMessage">
            Error sending SMS!
        </div>
    </div>

    <script>
        document.getElementById('smsForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let to = document.getElementById('to').value;
            let message = document.getElementById('message').value;

            let formData = new FormData();
            formData.append('to', to);
            formData.append('message', message);

            fetch('sms2.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showNotification('successMessage');
                    hideNotification('errorMessage');
                } else {
                    document.getElementById('errorMessage').innerText = data.message;
                    showNotification('errorMessage');
                    hideNotification('successMessage');
                }
            })
            .catch(error => {
                document.getElementById('errorMessage').innerText = "Error sending SMS!";
                showNotification('errorMessage');
                hideNotification('successMessage');
            });
        });

        function showNotification(id) {
            document.getElementById(id).classList.add('show');
        }

        function hideNotification(id) {
            document.getElementById(id).classList.remove('show');
        }
    </script>

</body>
</html>
