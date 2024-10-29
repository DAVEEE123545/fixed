<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1100px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .left-section {
            width: 30%;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            padding: 30px;
            text-align: center;
            border-right: 1px solid #e0e0e0;
            color: white;
        }

        .left-section img {
            border-radius: 50%;
            width: 160px;
            height: 160px;
            object-fit: cover;
            margin-bottom: 20px;
            border: 5px solid white;
        }

        .left-section h2 {
            font-size: 26px;
            margin-bottom: 10px;
        }

        .left-section p {
            color: #ddd;
            font-size: 14px;
        }

        .left-section button {
            width: 120px;
            margin-top: 20px;
            padding: 12px;
            font-size: 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .follow-btn {
            background-color: #00c6ff;
            color: white;
        }

        .follow-btn:hover {
            background-color: #008ebc;
        }

        .message-btn {
            background-color: #f0f0f0;
            color: #333;
            margin-left: 10px;
        }

        .message-btn:hover {
            background-color: #ccc;
        }

        .social-links {
            margin-top: 30px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            color: #ddd;
            font-size: 18px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-links a i {
            margin-right: 8px;
        }

        .social-links a:hover {
            color: #fff;
        }

        .right-section {
            width: 70%;
            padding: 40px;
        }

        .profile-info {
            margin-bottom: 50px;
        }

        .profile-info h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .profile-info p {
            margin-bottom: 10px;
            color: #555;
            font-size: 15px;
        }

        .profile-info p strong {
            font-weight: 600;
        }

        .project-status {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .status-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .status-card h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #777;
        }

        .status-card p {
            margin-bottom: 8px;
            font-size: 14px;
            color: #666;
        }

        .progress-bar {
            height: 8px;
            background-color: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar span {
            display: block;
            height: 100%;
            background-color: #007bff;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-section {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }

            .right-section {
                width: 100%;
            }

            .project-status {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <img src="wa.jpg" alt="Profile Picture">
            <h2>Admin</h2>
            <p>Full Stack Developer<br>Quezon city, Sauyo rd. Lipton st.</p>
            <div class="social-links">
                <a href="#"><i class="fas fa-globe"></i>Website: bootdey.com</a>
                <a href="#"><i class="fab fa-github"></i>Github: bootdey</a>
                <a href="#"><i class="fab fa-twitter"></i>Twitter: @bootdey</a>
                <a href="#"><i class="fab fa-instagram"></i>Instagram: @bootdey</a>
                <a href="#"><i class="fab fa-facebook"></i>Facebook: bootdey</a>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div class="profile-info">
                <h3>Profile Information</h3>
                <p><strong>Full Name:</strong>Admin</p>
                <p><strong>Email:</strong>Admin1</p>
                <p><strong>Phone:</strong> 123456</p>
                <p><strong>Mobile:</strong> 123456</p>
                <p><strong>Address:</strong> Quezon city, Sauyo rd. Lipton st.</p>
            </div>

            <div class="project-status">
                <div class="status-card">
                    <h4> STATUS</h4>
                    <p>Facility Member</p>
                    <div class="progress-bar">
                        <span style="width: 80%;"></span>
                    </div>
                    <p>Website Markup</p>
                    <div class="progress-bar">
                        <span style="width: 65%;"></span>
                    </div>
                    <p>One Page</p>
                    <div class="progress-bar">
                        <span style="width: 90%;"></span>
                    </div>
                </div>

                <div class="status-card">
                    <h4>ROLE</h4>
                    <p>Mobile Template</p>
                    <div class="progress-bar">
                        <span style="width: 60%;"></span>
                    </div>
                    <p>Facility Coordinator</p>
                    <div class="progress-bar">
                        <span style="width: 85%;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
