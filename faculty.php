<?php
session_start();
require_once 'includes/functions.php';

$page_title = 'Center for Applied Computing - Faculty';
include 'includes/header.php';
?>

<!-- Main Content -->
<main class="main-content">
    <section class="faculty-section">
        <h2>Our Faculty</h2>
        <p>Meet our distinguished faculty members who bring expertise, innovation, and dedication to the Center for Applied Computing.</p>

        <!-- Faculty Member 1 -->
        <div class="faculty-member">
            <div class="faculty-info">
                <h3><a href="https://facultyweb.kennesaw.edu/faculty/sjohnson" target="_blank" class="faculty-name-link">Dr. Sarah Johnson</a></h3>
                <p class="faculty-position">Professor and Director</p>
                <h4>Research Interests:</h4>
                <p>Cybersecurity, Network Security, Internet of Things (IoT) Security, Privacy-Preserving Technologies, and Secure Software Development. Dr. Johnson's research focuses on developing innovative security solutions for emerging technologies and distributed systems.</p>
                <h4>Contact Information:</h4>
                <p>Email: <a href="mailto:sjohnson@kennesaw.edu" class="contact-link">sjohnson@kennesaw.edu</a><br />
                Phone: (470) 578-6000<br />
                Office: J-371</p>
            </div>
        </div>

        <!-- Faculty Member 2 -->
        <div class="faculty-member">
            <div class="faculty-info">
                <h3><a href="https://facultyweb.kennesaw.edu/faculty/mchen" target="_blank" class="faculty-name-link">Dr. Michael Chen</a></h3>
                <p class="faculty-position">Associate Professor</p>
                <h4>Research Interests:</h4>
                <p>Artificial Intelligence, Machine Learning, Natural Language Processing, Computer Vision, and Data Mining. His work involves developing AI algorithms for real-world applications including healthcare informatics and autonomous systems.</p>
                <h4>Contact Information:</h4>
                <p>Email: <a href="mailto:mchen@kennesaw.edu" class="contact-link">mchen@kennesaw.edu</a><br />
                Phone: (470) 578-6001<br />
                Office: J-375</p>
            </div>
        </div>

        <!-- Faculty Member 3 -->
        <div class="faculty-member">
            <div class="faculty-info">
                <h3><a href="https://facultyweb.kennesaw.edu/faculty/erodriguez" target="_blank" class="faculty-name-link">Dr. Emily Rodriguez</a></h3>
                <p class="faculty-position">Assistant Professor</p>
                <h4>Research Interests:</h4>
                <p>Software Engineering, Human-Computer Interaction, User Experience Design, Agile Development Methodologies, and Software Quality Assurance. Dr. Rodriguez specializes in creating user-centered software solutions and improving development processes.</p>
                <h4>Contact Information:</h4>
                <p>Email: <a href="mailto:erodriguez@kennesaw.edu" class="contact-link">erodriguez@kennesaw.edu</a><br />
                Phone: (470) 578-6002<br />
                Office: J-380</p>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
