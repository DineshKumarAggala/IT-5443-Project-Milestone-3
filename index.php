<?php
session_start();
require_once 'includes/functions.php';

$page_title = 'Center for Applied Computing - Home';
include 'includes/header.php';
?>

<!-- Main Content -->
<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section">
        <img src="img/hero-banner.svg" alt="Center for Applied Computing" class="hero-image">
        <div class="hero-content">
            <h2>Welcome to the Center for Applied Computing</h2>
            <p>The Center for Applied Computing serves as a hub for innovation, research, and academic excellence in information technology and computer science. Our mission is to advance the field of computing through cutting-edge research, quality education, and meaningful industry partnerships.</p>
        </div>
    </section>

    <!-- Center Description -->
    <section class="description-section">
        <h2>About Our Center</h2>
        <p>Established as a premier research and educational facility, the Center for Applied Computing focuses on practical applications of computing technologies that address real-world challenges. Our interdisciplinary approach combines theoretical foundations with hands-on experience to prepare students for successful careers in technology.</p>
        <br />
        <p>We specialize in areas including software engineering, data science, cybersecurity, artificial intelligence, and information systems. Our faculty and students collaborate on projects that span across industries, from healthcare and finance to government and non-profit organizations.</p>
        <br />
        <p>The center provides state-of-the-art facilities, including modern computer labs, collaborative workspaces, and specialized equipment for research and development. We are committed to fostering an environment where innovation thrives and students can explore the frontiers of computing technology.</p>
    </section>

    <!-- Latest News -->
    <section class="news-section">
        <h2>Latest News</h2>
        <ul class="news-list">
            <li class="news-item">
                <h3>New AI Research Lab Opens</h3>
                <p>The Center announces the opening of a new artificial intelligence research laboratory equipped with high-performance computing resources and specialized software for machine learning research.</p>
                <span class="news-date">June 15, 2025</span>
            </li>
            <li class="news-item">
                <h3>Faculty Research Grant Award</h3>
                <p>Dr. Sarah Johnson receives a significant NSF grant to study cybersecurity applications in IoT devices, bringing $500,000 in funding to the center over three years.</p>
                <span class="news-date">June 10, 2025</span>
            </li>
            <li class="news-item">
                <h3>Student Team Wins National Competition</h3>
                <p>Our undergraduate programming team placed first in the National Collegiate Programming Contest, demonstrating excellence in algorithmic problem-solving and teamwork.</p>
                <span class="news-date">June 5, 2025</span>
            </li>
            <li class="news-item">
                <h3>Industry Partnership Announcement</h3>
                <p>The Center forms a strategic partnership with TechCorp Industries to provide internship opportunities and collaborative research projects for our students and faculty.</p>
                <span class="news-date">May 28, 2025</span>
            </li>
            <li class="news-item">
                <h3>Spring Symposium Success</h3>
                <p>Over 200 attendees participated in our annual Spring Research Symposium, featuring presentations from faculty, graduate students, and industry partners on emerging technologies.</p>
                <span class="news-date">May 20, 2025</span>
            </li>
        </ul>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
