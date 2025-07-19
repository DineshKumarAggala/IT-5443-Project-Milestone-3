<?php
session_start();
require_once 'includes/functions.php';

$page_title = 'Center for Applied Computing - Resources';
include 'includes/header.php';
?>

<!-- Main Content -->
<main class="main-content">
    <section class="resources-section">
        <h2>Center Resources</h2>
        <p>The Center for Applied Computing provides comprehensive resources to support research, education, and innovation in computing technologies.</p>

        <!-- Laboratory Facilities Table -->
        <h3>Laboratory Facilities</h3>
        <table class="resources-table">
            <thead>
                <tr>
                    <th>Lab Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
                    <th>Equipment</th>
                    <th>Primary Use</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>AI Research Lab</td>
                    <td>J-350</td>
                    <td>20 stations</td>
                    <td>High-performance workstations, GPU clusters, specialized AI software</td>
                    <td>Machine learning research, neural network development</td>
                    <td>Dr. Michael Chen</td>
                </tr>
                <tr>
                    <td>Cybersecurity Lab</td>
                    <td>J-355</td>
                    <td>15 stations</td>
                    <td>Isolated network environment, penetration testing tools, security appliances</td>
                    <td>Security research, ethical hacking, network defense</td>
                    <td>Dr. Sarah Johnson</td>
                </tr>
                <tr>
                    <td>Software Development Lab</td>
                    <td>J-360</td>
                    <td>25 stations</td>
                    <td>Modern development workstations, version control systems, testing frameworks</td>
                    <td>Software engineering projects, collaborative development</td>
                    <td>Dr. Emily Rodriguez</td>
                </tr>
                <tr>
                    <td>General Computing Lab</td>
                    <td>J-365</td>
                    <td>30 stations</td>
                    <td>Standard workstations, office software, programming environments</td>
                    <td>Coursework, general computing tasks, student projects</td>
                    <td>Lab Manager</td>
                </tr>
                <tr>
                    <td>Collaboration Center</td>
                    <td>J-370</td>
                    <td>50 people</td>
                    <td>Interactive whiteboards, video conferencing, flexible seating</td>
                    <td>Team meetings, presentations, workshops</td>
                    <td>Administrative Staff</td>
                </tr>
            </tbody>
        </table>

        <!-- Computing Resources -->
        <h3>Computing Resources</h3>
        <p>Our center maintains state-of-the-art computing infrastructure to support intensive research and development activities:</p>
        
        <ul class="resource-list">
            <li><strong>High-Performance Computing Cluster:</strong> 64-node cluster with 1,024 CPU cores and 8TB RAM for computational research</li>
            <li><strong>GPU Computing Farm:</strong> 16 NVIDIA Tesla V100 GPUs for machine learning and parallel computing</li>
            <li><strong>Cloud Computing Access:</strong> AWS, Azure, and Google Cloud Platform educational credits and resources</li>
            <li><strong>Software Licenses:</strong> Campus-wide licenses for development tools, statistical software, and specialized applications</li>
            <li><strong>Network Infrastructure:</strong> Gigabit ethernet throughout, dedicated research network segments</li>
        </ul>

        <!-- Research Equipment Table -->
        <h3>Specialized Equipment</h3>
        <table class="resources-table">
            <thead>
                <tr>
                    <th>Equipment Type</th>
                    <th>Model/Specifications</th>
                    <th>Quantity</th>
                    <th>Primary Applications</th>
                    <th>Availability</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>3D Printers</td>
                    <td>Ultimaker 3 Extended, MakerBot Replicator+</td>
                    <td>4 units</td>
                    <td>Prototyping, IoT device cases, educational models</td>
                    <td>Faculty/Student projects</td>
                </tr>
                <tr>
                    <td>IoT Development Kits</td>
                    <td>Arduino, Raspberry Pi, ESP32, various sensors</td>
                    <td>50+ kits</td>
                    <td>Internet of Things research and coursework</td>
                    <td>Course checkout system</td>
                </tr>
                <tr>
                    <td>VR/AR Headsets</td>
                    <td>Oculus Quest 2, HTC Vive Pro, HoloLens 2</td>
                    <td>8 units</td>
                    <td>Virtual reality research, immersive applications</td>
                    <td>Research projects only</td>
                </tr>
                <tr>
                    <td>Network Analysis Tools</td>
                    <td>Wireshark appliances, protocol analyzers</td>
                    <td>6 units</td>
                    <td>Network security research, traffic analysis</td>
                    <td>Faculty supervision required</td>
                </tr>
                <tr>
                    <td>Mobile Device Lab</td>
                    <td>iOS and Android devices, various generations</td>
                    <td>24 devices</td>
                    <td>Mobile app development and testing</td>
                    <td>Course and research use</td>
                </tr>
            </tbody>
        </table>

        <!-- Support Services -->
        <h3>Support Services</h3>
        <p>The center provides comprehensive support to ensure effective utilization of our resources:</p>
        
        <ul class="resource-list">
            <li><strong>Technical Support:</strong> On-site IT specialists for hardware and software assistance</li>
            <li><strong>Research Computing Support:</strong> Consultation for high-performance computing and data analysis</li>
            <li><strong>Training Programs:</strong> Regular workshops on new technologies and research methodologies</li>
            <li><strong>Equipment Maintenance:</strong> Preventive maintenance and repair services for all lab equipment</li>
            <li><strong>Data Management:</strong> Secure storage solutions and backup services for research data</li>
        </ul>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
