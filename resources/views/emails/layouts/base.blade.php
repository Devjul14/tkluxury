<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style type="text/css">
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            color: #333333;
            line-height: 1.6;
        }
        
        /* Email Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
        }
        
        /* Header */
        .email-header {
            padding: 40px 30px 20px;
            text-align: center;
            background: linear-gradient(135deg, #4a6bff 0%, #3a5bef 100%);
            color: white;
            border-radius: 8px 8px 0 0;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        
        .email-header p {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        
        .email-header .icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: inline-block;
        }
        
        /* Content */
        .email-content {
            padding: 30px;
        }
        
        /* Booking Summary */
        .booking-summary {
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e0e6ff;
            margin-bottom: 25px;
            overflow: hidden;
        }
        
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #f8faff;
            border-bottom: 1px solid #e0e6ff;
        }
        
        .booking-number {
            font-weight: 600;
            font-size: 16px;
        }
        
        .booking-status {
            background-color: #d4edda;
            color: #28a745;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        
        .room-info {
            display: flex;
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .room-image {
            width: 100px;
            height: 75px;
            border-radius: 4px;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .room-details h3 {
            margin: 0 0 5px;
            font-size: 16px;
        }
        
        .room-details p {
            margin: 0;
            color: #666666;
            font-size: 14px;
        }
        
        .booking-details {
            padding: 15px 20px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .detail-label {
            color: #666666;
            font-weight: 500;
        }
        
        .detail-value {
            font-weight: 500;
        }
        
        .total-row {
            border-top: 1px solid #e0e6ff;
            padding-top: 15px;
            margin-top: 15px;
            font-weight: 700;
        }
        
        /* Guest Info */
        .guest-info {
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e0e6ff;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 15px;
            color: #2c3e50;
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #4a6bff;
            border-radius: 3px;
        }
        
        /* Special Requests */
        .special-requests {
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e0e6ff;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #4a6bff;
        }
        
        /* Next Steps */
        .next-steps {
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e0e6ff;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .step {
            display: flex;
            margin-bottom: 15px;
        }
        
        .step:last-child {
            margin-bottom: 0;
        }
        
        .step-icon {
            width: 24px;
            height: 24px;
            background: #e0e6ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            color: #4a6bff;
            font-size: 12px;
        }
        
        .step-content h4 {
            margin: 0 0 5px;
            font-size: 15px;
        }
        
        .step-content p {
            margin: 0;
            color: #666666;
            font-size: 14px;
        }
        
        /* Footer */
        .email-footer {
            padding: 20px;
            text-align: center;
            background-color: #f8faff;
            border-top: 1px solid #e0e6ff;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
            color: #666666;
        }
        
        .footer-logo {
            margin-bottom: 15px;
        }
        
        .footer-links {
            margin: 15px 0;
        }
        
        .footer-links a {
            color: #4a6bff;
            text-decoration: none;
            margin: 0 10px;
        }
        
        .social-icons {
            margin: 15px 0;
        }
        
        .social-icons a {
            display: inline-block;
            margin: 0 5px;
            color: #4a6bff;
            text-decoration: none;
            font-size: 16px;
        }
        
        /* Responsive */
        @media only screen and (max-width: 480px) {
            .email-header {
                padding: 30px 20px 15px;
            }
            
            .email-header h1 {
                font-size: 24px;
            }
            
            .room-info {
                flex-direction: column;
            }
            
            .room-image {
                width: 100%;
                height: 150px;
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>