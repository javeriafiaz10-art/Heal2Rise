<?php include_once "header.php"; ?>

<style>
    .hero-section {
        background: linear-gradient(45deg, #1ab394, #23c6c8);
        color: white;
        padding: 100px 0;
        text-align: center;
        border-bottom-left-radius: 50% 20px;
        border-bottom-right-radius: 50% 20px;
    }
    .hero-section h1 { font-size: 48px; font-weight: 800; margin-bottom: 20px; }
    .hero-section p { font-size: 20px; opacity: 0.9; margin-bottom: 30px; }
    
    .feature-box {
        padding: 40px 20px;
        transition: 0.3s;
        border: none;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        text-align: center;
    }
    .feature-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .feature-icon {
        font-size: 50px;
        color: #1ab394;
        margin-bottom: 20px;
    }
    .section-title {
        text-align: center;
        margin: 60px 0 40px;
        font-weight: 700;
        color: #2c3e50;
    }
    .btn-custom {
        padding: 12px 30px;
        font-size: 18px;
        border-radius: 30px;
        font-weight: 600;
        text-transform: uppercase;
        transition: 0.3s;
    }
    .btn-main { background: #fff; color: #1ab394; border: none; }
    .btn-main:hover { background: #f8f9fa; color: #18a689; }
</style>

<div class="hero-section">
    <div class="container">
        <h1>Heal2Rise: Empowering Through Connection</h1>
        <p>A bridge between those in need and those who can help. <br>Automating support for a better tomorrow.</p>
        <a href="login.php" class="btn btn-custom btn-main">Login <i class="fa fa-arrow-right"></i></a>
        <a href="register.php" class="btn btn-custom btn-outline-light" style="border: 2px solid white; color: white; margin-left: 10px;">Register</a>
    </div>

</div>

<div class="container">
    
    <h2 class="section-title">How It Works</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="feature-box">
                <div class="feature-icon"><i class="fa fa-edit"></i></div>
                <h4>Post a Case</h4>
                <p>Users can easily register and post their cases (Health, Education, or Financial) with complete details.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <div class="feature-icon"><i class="fa fa-handshake-o"></i></div>
                <h4>Auto NGO Connection</h4>
                <p>Our system intelligently connects your case with a relevant NGO to ensure timely support.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <div class="feature-icon"><i class="fa fa-line-chart"></i></div>
                <h4>Track Progress</h4>
                <p>Monitor your case status in real-time. A dedicated team member is assigned to every connection.</p>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 50px; background: #f9fbfd; padding: 60px 20px; border-radius: 20px;">
        <div class="col-md-6">
            <h2 style="font-weight:700; color:#2c3e50;">Our Mission</h2>
            <p style="font-size:17px; line-height:1.8; color:#7f8c8d;">
                Heal2Rise ka maqsad technology ke zariye insaniyat ki khidmat karna hai. Humne ek aisa digital system banaya hai jahan zarurat-mand log (Users) aur madad karne wale idaray (NGOs) ek hi platform par mil sakein. 
                <br><br>
                Is prototype phase mein hum case management, auto-assignment, aur progress monitoring ko behtar bana rahe hain taake har case ko sahi tawajjo mil sake.
            </p>
        </div>
       
    </div>

    <div class="row text-center" style="margin: 80px 0;">
        <div class="col-md-4">
            <h2 style="color:#1ab394; font-weight:800;">100%</h2>
            <p class="text-muted">Transparent Process</p>
        </div>
        <div class="col-md-4">
            <h2 style="color:#1ab394; font-weight:800;">Auto</h2>
            <p class="text-muted">NGO Matching</p>
        </div>
        <div class="col-md-4">
            <h2 style="color:#1ab394; font-weight:800;">24/7</h2>
            <p class="text-muted">Monitoring Support</p>
        </div>
    </div>

</div>

<footer style="background: #2c3e50; color: white; padding: 40px 0; text-align: center;">
    <div class="container">
        <h4>Heal2Rise Platform</h4>
        <p>Follow our journey to make support accessible for everyone.</p>
        <div style="font-size: 20px; margin: 20px 0;">
            <i class="fa fa-facebook" style="margin: 0 10px;"></i>
            <i class="fa fa-twitter" style="margin: 0 10px;"></i>
            <i class="fa fa-envelope" style="margin: 0 10px;"></i>
        </div>
        <hr style="opacity: 0.1;">
        <p><small>&copy; 2026 Heal2Rise Final Project. Designed for Impact.</small></p>
    </div>
</footer>
