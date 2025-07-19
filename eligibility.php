<?php
session_start();
require_once 'includes/functions.php';

$page_title = 'Center for Applied Computing - Eligibility Evaluation';
$additional_js = array('js/eligibility.js');
include 'includes/header.php';
?>

<!-- Main Content -->
<main class="main-content">
    <section class="eligibility-section">
        <h2>Student Eligibility Evaluation</h2>
        
        <!-- Page Description -->
        <div class="description-section">
            <h3>Purpose and Instructions</h3>
            <p>This evaluation tool helps determine your eligibility for research positions and programs at the Center for Applied Computing. Please provide accurate information about your academic background and coursework.</p>
            
            <p><strong>Instructions:</strong></p>
            <ul class="instruction-list">
                <li>First, select your current student status (Undergraduate or Graduate)</li>
                <li>Enter your letter grades (A, B, C, D, or F) for each relevant course</li>
                <li>Click "Evaluate" to calculate your GPA and receive eligibility results</li>
                <li>A minimum GPA of 3.0 is required for most research positions</li>
            </ul>
        </div>

        <!-- Evaluation Form -->
        <div class="evaluation-form-container">
            <form id="eligibilityForm" class="evaluation-form">
                <!-- Student Status Selection -->
                <div class="form-group">
                    <label for="studentStatus" class="form-label">Student Status:</label>
                    <select id="studentStatus" name="studentStatus" class="form-select" required>
                        <option value="">Select your status...</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="graduate">Graduate</option>
                    </select>
                </div>

                <!-- Course Grades Section -->
                <div id="coursesSection" class="courses-section" style="display: none;">
                    <h3>Course Grades</h3>
                    <p class="courses-instruction">Please enter your letter grades for the following courses:</p>
                    
                    <div id="coursesList" class="courses-list">
                        <!-- Courses will be dynamically populated here -->
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" id="evaluateBtn" class="btn-evaluate" disabled>Evaluate</button>
                </div>
            </form>

            <!-- Results Section -->
            <div id="resultsSection" class="results-section" style="display: none;">
                <h3>Evaluation Results</h3>
                <div id="resultsContent" class="results-content">
                    <!-- Results will be displayed here -->
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
