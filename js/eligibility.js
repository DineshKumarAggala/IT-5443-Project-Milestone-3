// Course data for different student statuses
const courseData = {
    undergraduate: [
        'CS 1301 - Introduction to Computing',
        'CS 1302 - Software Development',
        'CS 2302 - Data Structures',
        'CS 2335 - Programming Principles',
        'CS 3305 - Data Structures and Algorithms',
        'CS 3410 - Database Systems',
        'CS 3502 - Operating Systems',
        'MATH 1190 - Calculus I',
        'MATH 1260 - Calculus II',
        'STAT 1401 - Elementary Statistics'
    ],
    graduate: [
        'CS 6232 - Computer Networks',
        'CS 6283 - Mobile Application Development',
        'CS 6384 - Machine Learning',
        'CS 6422 - Advanced Database Systems',
        'CS 6460 - Information Security',
        'CS 6675 - Advanced Algorithms',
        'CS 7471 - Advanced Software Engineering',
        'IT 6203 - Web Programming',
        'IT 6823 - Data Analytics',
        'IT 7823 - Advanced Data Analytics'
    ]
};

// Grade point values
const gradePoints = {
    'A': 4.0,
    'B': 3.0,
    'C': 2.0,
    'D': 1.0,
    'F': 0.0
};

// Minimum GPA requirement
const MIN_GPA = 3.0;

// DOM elements
const studentStatusSelect = document.getElementById('studentStatus');
const coursesSection = document.getElementById('coursesSection');
const coursesList = document.getElementById('coursesList');
const evaluateBtn = document.getElementById('evaluateBtn');
const eligibilityForm = document.getElementById('eligibilityForm');
const resultsSection = document.getElementById('resultsSection');
const resultsContent = document.getElementById('resultsContent');

// Event listeners
studentStatusSelect.addEventListener('change', handleStatusChange);
eligibilityForm.addEventListener('submit', handleFormSubmit);

/**
 * Handle student status change
 * Dynamically populate courses based on selected status
 */
function handleStatusChange() {
    const selectedStatus = studentStatusSelect.value;
    
    if (selectedStatus) {
        displayCourses(selectedStatus);
        coursesSection.style.display = 'block';
        evaluateBtn.disabled = false;
    } else {
        coursesSection.style.display = 'none';
        evaluateBtn.disabled = true;
    }
    
    // Hide results when status changes
    resultsSection.style.display = 'none';
}

/**
 * Display courses based on student status
 * @param {string} status - Student status (undergraduate/graduate)
 */
function displayCourses(status) {
    const courses = courseData[status];
    coursesList.innerHTML = '';
    
    courses.forEach((course, index) => {
        const courseItem = document.createElement('div');
        courseItem.className = 'course-item';
        
        courseItem.innerHTML = `
            <label for="course-${index}" class="course-label">${course}</label>
            <select id="course-${index}" name="course-${index}" class="grade-select" required>
                <option value="">Select grade...</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="F">F</option>
            </select>
        `;
        
        coursesList.appendChild(courseItem);
    });
}

/**
 * Handle form submission
 * Calculate GPA and display results
 */
function handleFormSubmit(event) {
    event.preventDefault();
    
    const selectedStatus = studentStatusSelect.value;
    const courses = courseData[selectedStatus];
    let totalPoints = 0;
    let totalCourses = 0;
    let allGradesEntered = true;
    
    // Calculate GPA
    courses.forEach((course, index) => {
        const gradeSelect = document.getElementById(`course-${index}`);
        const selectedGrade = gradeSelect.value;
        
        if (selectedGrade) {
            totalPoints += gradePoints[selectedGrade];
            totalCourses++;
        } else {
            allGradesEntered = false;
        }
    });
    
    // Check if all grades are entered
    if (!allGradesEntered) {
        alert('Please enter grades for all courses.');
        return;
    }
    
    // Calculate average GPA
    const averageGPA = totalCourses > 0 ? (totalPoints / totalCourses).toFixed(2) : 0;
    
    // Display results
    displayResults(averageGPA, selectedStatus);
}

/**
 * Display evaluation results
 * @param {number} gpa - Calculated GPA
 * @param {string} status - Student status
 */
function displayResults(gpa, status) {
    const isEligible = parseFloat(gpa) >= MIN_GPA;
    
    // Store eligibility status in session storage for application form access
    if (isEligible) {
        // Send eligibility status to server via AJAX
        fetch('eligibility.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=set_eligibility&eligible=true&gpa=' + gpa
        });
    }
    
    let resultsHTML = `
        <div class="gpa-display">
            Your calculated GPA: <strong>${gpa}</strong> / 4.0
        </div>
    `;
    
    if (isEligible) {
        resultsHTML += `
            <div class="results-success">
                <h4>🎉 Congratulations!</h4>
                <p>Your GPA of <strong>${gpa}</strong> meets the minimum requirement of ${MIN_GPA}. You are eligible to apply for research positions at the Center for Applied Computing.</p>
                <p>Our research opportunities include projects in cybersecurity, artificial intelligence, software engineering, and data analytics. We encourage you to explore these exciting opportunities to advance your academic and professional career.</p>
                <p>Next steps:</p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Review available research positions on our website</li>
                    <li>Contact faculty members whose research interests align with yours</li>
                    <li>Prepare your application materials including resume and transcript</li>
                    <li>Submit your application through our online portal</li>
                </ul>
                <a href="application.php" class="application-link">Apply Now</a>
            </div>
        `;
    } else {
        resultsHTML += `
            <div class="results-failure">
                <h4>Thank You for Your Interest</h4>
                <p>We appreciate your interest in the Center for Applied Computing. However, your current GPA of <strong>${gpa}</strong> does not meet the minimum requirement of ${MIN_GPA} for our research programs.</p>
                <p>We encourage you to:</p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Continue working hard to improve your academic performance</li>
                    <li>Consider taking additional courses to strengthen your foundation</li>
                    <li>Participate in study groups and seek academic support resources</li>
                    <li>Apply again in the future when you meet the GPA requirement</li>
                </ul>
                <p>Remember, academic excellence is a journey, and we believe in your potential to succeed. Please don't hesitate to reach out to our faculty for guidance and mentorship opportunities.</p>
            </div>
        `;
    }
    
    resultsContent.innerHTML = resultsHTML;
    resultsContent.className = `results-content ${isEligible ? 'results-success' : 'results-failure'}`;
    resultsSection.style.display = 'block';
    
    // Scroll to results
    resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

/**
 * Initialize the form
 */
function initializeForm() {
    // Reset form state
    studentStatusSelect.value = '';
    coursesSection.style.display = 'none';
    resultsSection.style.display = 'none';
    evaluateBtn.disabled = true;
}

// Handle AJAX response for eligibility status
function handleEligibilityResponse() {
    // This function can be expanded to handle server responses
    // For now, we rely on session storage and server-side session management
}

// Initialize form when page loads
document.addEventListener('DOMContentLoaded', initializeForm);

// Add session storage for client-side eligibility tracking
function setEligibilitySession(eligible, gpa) {
    sessionStorage.setItem('eligible', eligible);
    sessionStorage.setItem('gpa', gpa);
}

// Update the displayResults function to use session storage
function displayResults(gpa, status) {
    const isEligible = parseFloat(gpa) >= MIN_GPA;
    
    // Store eligibility in session storage
    setEligibilitySession(isEligible, gpa);
    
    // Send to server via fetch
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=set_eligibility&eligible=${isEligible}&gpa=${gpa}`
    }).catch(error => {
        console.log('Could not store eligibility status on server:', error);
    });
    
    let resultsHTML = `
        <div class="gpa-display">
            Your calculated GPA: <strong>${gpa}</strong> / 4.0
        </div>
    `;
    
    if (isEligible) {
        resultsHTML += `
            <div class="results-success">
                <h4>🎉 Congratulations!</h4>
                <p>Your GPA of <strong>${gpa}</strong> meets the minimum requirement of ${MIN_GPA}. You are eligible to apply for research positions at the Center for Applied Computing.</p>
                <p>Our research opportunities include projects in cybersecurity, artificial intelligence, software engineering, and data analytics. We encourage you to explore these exciting opportunities to advance your academic and professional career.</p>
                <p>Next steps:</p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Review available research positions on our website</li>
                    <li>Contact faculty members whose research interests align with yours</li>
                    <li>Prepare your application materials including resume and transcript</li>
                    <li>Submit your application through our online portal</li>
                </ul>
                <a href="application.php" class="application-link">Apply Now</a>
            </div>
        `;
    } else {
        resultsHTML += `
            <div class="results-failure">
                <h4>Thank You for Your Interest</h4>
                <p>We appreciate your interest in the Center for Applied Computing. However, your current GPA of <strong>${gpa}</strong> does not meet the minimum requirement of ${MIN_GPA} for our research programs.</p>
                <p>We encourage you to:</p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Continue working hard to improve your academic performance</li>
                    <li>Consider taking additional courses to strengthen your foundation</li>
                    <li>Participate in study groups and seek academic support resources</li>
                    <li>Apply again in the future when you meet the GPA requirement</li>
                </ul>
                <p>Remember, academic excellence is a journey, and we believe in your potential to succeed. Please don't hesitate to reach out to our faculty for guidance and mentorship opportunities.</p>
            </div>
        `;
    }
    
    resultsContent.innerHTML = resultsHTML;
    resultsContent.className = `results-content ${isEligible ? 'results-success' : 'results-failure'}`;
    resultsSection.style.display = 'block';
    
    // Scroll to results
    resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
