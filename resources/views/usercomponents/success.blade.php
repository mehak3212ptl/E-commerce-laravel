<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f0fdf4;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .popup {
      background-color: #ffffff;
      color: #333;
      padding: 40px 50px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      max-width: 520px;
      text-align: center;
      position: relative;
      animation: slideUpFade 0.8s ease-out;
    }

    .popup::before {
      content: '';
      position: absolute;
      top: -20px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 60px;
      background: #4caf50;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      color: white;
      animation: popIcon 0.5s ease-out;
    }

    .popup::before {
      content: "✔";
    }

    h2 {
      margin-top: 30px;
      font-size: 26px;
      color: #2e7d32;
    }

    p {
      font-size: 16px;
      line-height: 1.5;
      margin: 10px 0;
    }

    a {
      color: #388e3c;
      font-weight: bold;
      text-decoration: underline;
    }

    @keyframes slideUpFade {
      0% {
        transform: translateY(30px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @keyframes popIcon {
      0% {
        transform: scale(0.4);
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
    <h2>Payment Successful!</h2>
    <p>Thank you for your payment of rupees <strong></strong>.</p>
    <p>Your order has been Delivered in 5Days.</p>
    <p>You can now trak  your order using the order id.</p>
    <br>
    <p>Need help? <a href="#">Contact Support</a></p>
    <br>
    <p>Regards,<br><strong>Mehak</strong></p>
  </div>

</body>
</html>
