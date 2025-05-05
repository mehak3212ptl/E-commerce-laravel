<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f0fdf4;
      font-family: Arial, sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .popup {
      background-color: #4caf50; /* Green background */
      color: white;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      max-width: 500px;
      text-align: center;
      animation: popUp 0.7s ease-out;
    }

    .emoji {
      font-size: 48px;
      margin-bottom: 15px;
    }

    h2 {
      margin-top: 0;
    }

    a {
      color: #e8f5e9;
      font-weight: bold;
      text-decoration: underline;
    }

    @keyframes popUp {
      0% {
        transform: scale(0.5);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }
  </style>
</head>
<body>

  <div class="popup">
    <div class="emoji">✅</div>
    <h2>Hi {{ $tenantData['name'] }},</h2>
    <p>Thank you for your payment of rupees {{ $tenantData['amount'] }}.</p>
    <p>Your plan has been activated successfully.</p>
    <p><strong>Your domain:</strong> <a href="http://{{ $tenantData['domain'] }}" target="_blank">{{ $tenantData['domain'] }}</a></p>
    <p>You can now access your website using this domain.</p>
    <br>
    <p>Regards,<br>Mehak</p>
  </div>

</body>
</html>
