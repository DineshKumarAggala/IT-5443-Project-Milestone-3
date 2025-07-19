<?php
session_start();
require_once 'includes/functions.php';

$page_title = 'Center for Applied Computing - Student Application';
$additional_js = array('js/application.js');
include 'includes/header.php';

// Handle form submission
$form_submitted = false;
$application_data = array();
$validation_errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data
    $application_data = array(
        'firstName' => sanitize_input($_POST['firstName'] ?? ''),
        'lastName' => sanitize_input($_POST['lastName'] ?? ''),
        'email' => sanitize_input($_POST['email'] ?? ''),
        'phone' => sanitize_input($_POST['phone'] ?? ''),
        'studentId' => sanitize_input($_POST['studentId'] ?? ''),
        'studentStatus' => sanitize_input($_POST['studentStatus'] ?? ''),
        'gpa' => sanitize_input($_POST['gpa'] ?? ''),
        'graduationDate' => sanitize_input($_POST['graduationDate'] ?? ''),
        'researchInterests' => isset($_POST['researchInterests']) ? $_POST['researchInterests'] : array(),
        'programmingLanguages' => isset($_POST['programmingLanguages']) ? $_POST['programmingLanguages'] : array(),
        'experience' => sanitize_input($_POST['experience'] ?? ''),
        'availability' => sanitize_input($_POST['availability'] ?? ''),
        'workLocation' => sanitize_input($_POST['workLocation'] ?? ''),
        'additionalInfo' => sanitize_input($_POST['additionalInfo'] ?? '')
    );
    
    // Validate form data
    if (!validate_required($application_data['firstName'])) {
        $validation_errors['firstName'] = 'First name is required';
    }
    
    if (!validate_required($application_data['lastName'])) {
        $validation_errors['lastName'] = 'Last name is required';
    }
    
    if (!validate_required($application_data['email']) || !validate_email($application_data['email'])) {
        $validation_errors['email'] = 'Valid email address is required';
    }
    
    if (!validate_required($application_data['phone']) || !validate_phone($application_data['phone'])) {
        $validation_errors['phone'] = 'Valid 10-digit phone number is required';
    }
    
    if (!validate_required($application_data['studentId'])) {
        $validation_errors['studentId'] = 'Student ID is required';
    }
    
    if (!validate_required($application_data['studentStatus'])) {
        $validation_errors['studentStatus'] = 'Student status is required';
    }
    
    if (!validate_required($application_data['gpa']) || !is_numeric($application_data['gpa']) || 
        $application_data['gpa'] < 0 || $application_data['gpa'] > 4.0) {
        $validation_errors['gpa'] = 'Valid GPA (0.0-4.0) is required';
    }
    
    if (!validate_required($application_data['graduationDate'])) {
        $validation_errors['graduationDate'] = 'Expected graduation date is required';
    }
    
    if (empty($application_data['researchInterests'])) {
        $validation_errors['researchInterests'] = 'At least one research interest must be selected';
    }
    
    if (empty($application_data['programmingLanguages'])) {
        $validation_errors['programmingLanguages'] = 'At least one programming language must be selected';
    }
    
    if (!validate_required($application_data['availability'])) {
        $validation_errors['availability'] = 'Availability selection is required';
    }
    
    if (!validate_required($application_data['workLocation'])) {
        $validation_errors['workLocation'] = 'Work location preference is required';
    }
    
    // If no validation errors, mark as submitted
    if (empty($validation_errors)) {
        $form_submitted = true;
        $_SESSION['application_data'] = $application_data;
    }
}
?>

<!-- Main Content -->
<main class="main-content">
    <section class="application-section">
        <h2>Student Research Position Application</h2>
        
        <?php if ($form_submitted): ?>
            <!-- Success Message -->
            <div class="success-message">
                <h3>Application Submitted Successfully!</h3>
                <p>Thank you for your interest in joining our research team. Your application has been received and will be reviewed by our faculty.</p>
            </div>
            
            <!-- Application Summary -->
            <div class="application-summary">
                <h3>Application Summary</h3>
                <table class="application-table">
                    <?php foreach (format_application_data($application_data) as $field): ?>
                        <tr>
                            <td class="label-column"><?php echo htmlspecialchars($field['label']); ?></td>
                            <td class="value-column"><?php echo htmlspecialchars($field['value']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            
            <!-- Next Steps -->
            <div class="next-steps">
                <h3>What's Next?</h3>
                <ul class="instruction-list">
                    <li>Your application will be reviewed by our faculty within 5-7 business days</li>
                    <li>If selected for an interview, you will be contacted via email</li>
                    <li>Interviews are typically conducted within 2 weeks of application submission</li>
                    <li>Final decisions will be communicated within 3 weeks</li>
                </ul>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="application.php" class="btn-secondary">Submit Another Application</a>
                <a href="index.php" class="btn-primary">Return to Home</a>
            </div>
            
        <?php else: ?>
            <!-- Application Form -->
            <div class="description-section">
                <h3>Application Instructions</h3>
                <p>Please complete all sections of this application form. All fields marked with an asterisk (*) are required. Make sure to provide accurate and complete information to help us evaluate your qualifications for research positions.</p>
            </div>
            
            <form method="POST" action="application.php" class="evaluation-form">
                <!-- Personal Information Section -->
                <div class="form-section">
                    <h3>Personal Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group half-width">
                            <label for="firstName" class="form-label">First Name *</label>
                            <input type="text" id="firstName" name="firstName" class="form-input" 
                                   value="<?php echo htmlspecialchars($application_data['firstName'] ?? ''); ?>" required>
                            <?php if (isset($validation_errors['firstName'])): ?>
                                <span class="error-message"><?php echo $validation_errors['firstName']; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group half-width">
                            <label for="lastName" class="form-label">Last Name *</label>
                            <input type="text" id="lastName" name="lastName" class="form-input" 
                                   value="<?php echo htmlspecialchars($application_data['lastName'] ?? ''); ?>" required>
                            <?php if (isset($validation_errors['lastName'])): ?>
                                <span class="error-message"><?php echo $validation_errors['lastName']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group half-width">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-input" 
                                   value="<?php echo htmlspecialchars($application_data['email'] ?? ''); ?>" required>
                            <?php if (isset($validation_errors['email'])): ?>
                                <span class="error-message"><?php echo $validation_errors['email']; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group half-width">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-input" 
                                   value="<?php echo htmlspecialchars($application_data['phone'] ?? ''); ?>" 
                                   placeholder="(555) 123-4567" required>
                            <?php if (isset($validation_errors['phone'])): ?>
                                <span class="error-message"><?php echo $validation_errors['phone']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Academic Information Section -->
                <div class="form-section">
                    <h3>Academic Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group half-width">
                            <label for="studentId" class="form-label">Student ID *</label>
                            <input type="text" id="studentId" name="studentId" class="form-input" 
                                   value="<?php echo htmlspecialchars($application_data['studentId'] ?? ''); ?>" required>
                            <?php if (isset($validation_errors['studentId'])): ?>
                                <span class="error-message"><?php echo $validation_errors['studentId']; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group half-width">
                            <label for="studentStatus" class="form-label">Student Status *</label>
                            <select id="studentStatus" name="studentStatus" class="form-select" required>
                                <option value="">Select your status...</option>
                                <option value="undergraduate" <?php echo ($application_data['studentStatus'] ?? '') === 'undergraduate' ? 'selected' : ''; ?>>Undergraduate</option>
                                <option value="graduate" <?php echo ($application_data['studentStatus'] ?? '') === 'graduate' ? 'selected' : ''; ?>>Graduate</option>
                                <option value="phd" <?php echo ($application_data['studentStatus'] ?? '') === 'phd' ? 'selected' : ''; ?>>Ph.D. Student</option>
                            </select>
                            <?php if (isset($validation_errors['studentStatus'])): ?>
                                <span class="error-message"><?php echo $validation_errors['studentStatus']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group half-width">
                            <label for="gpa" class="form-label">Current GPA *</label>
                            <input type="number" id="gpa" name="gpa" class="form-input" 
                                   value="<?php echo htmlspecialchars($application_data['gpa'] ?? ''); ?>" 
                                   min="0" max="4.0" step="0.01" required>
                            <?php if (isset($validation_errors['gpa'])): ?>
                                <span class="error-message"><?php echo $validation_errors['gpa']; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group half-width">
                            <label for="graduationDate" class="form-label">Expected Graduation Date *</label>
                            <input type="month" id="graduationDate" name="graduationDate" class="form-input" 
                                   value="<?php echo htmlspecialchars($application_data['graduationDate'] ?? ''); ?>" required>
                            <?php if (isset($validation_errors['graduationDate'])): ?>
                                <span class="error-message"><?php echo $validation_errors['graduationDate']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Research Interests Section -->
                <div class="form-section">
                    <h3>Research Interests</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Research Areas of Interest * (Select all that apply)</label>
                        <div class="checkbox-group">
                            <?php 
                            $research_areas = array(
                                'ai' => 'Artificial Intelligence & Machine Learning',
                                'cybersecurity' => 'Cybersecurity & Network Security',
                                'software' => 'Software Engineering & Development',
                                'data' => 'Data Science & Analytics',
                                'hci' => 'Human-Computer Interaction',
                                'systems' => 'Computer Systems & Networks',
                                'theory' => 'Theoretical Computer Science',
                                'other' => 'Other (please specify in additional information)'
                            );
                            
                            foreach ($research_areas as $value => $label): 
                                $checked = in_array($value, $application_data['researchInterests'] ?? array()) ? 'checked' : '';
                            ?>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="researchInterests[]" value="<?php echo $value; ?>" 
                                           class="form-checkbox" <?php echo $checked; ?>>
                                    <?php echo htmlspecialchars($label); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php if (isset($validation_errors['researchInterests'])): ?>
                            <span class="error-message"><?php echo $validation_errors['researchInterests']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Technical Skills Section -->
                <div class="form-section">
                    <h3>Technical Skills</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Programming Languages * (Select all that apply)</label>
                        <div class="checkbox-group">
                            <?php 
                            $programming_languages = array(
                                'python' => 'Python',
                                'java' => 'Java',
                                'javascript' => 'JavaScript',
                                'cpp' => 'C++',
                                'c' => 'C',
                                'csharp' => 'C#',
                                'php' => 'PHP',
                                'sql' => 'SQL',
                                'r' => 'R',
                                'matlab' => 'MATLAB',
                                'other' => 'Other (please specify in additional information)'
                            );
                            
                            foreach ($programming_languages as $value => $label): 
                                $checked = in_array($value, $application_data['programmingLanguages'] ?? array()) ? 'checked' : '';
                            ?>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="programmingLanguages[]" value="<?php echo $value; ?>" 
                                           class="form-checkbox" <?php echo $checked; ?>>
                                    <?php echo htmlspecialchars($label); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php if (isset($validation_errors['programmingLanguages'])): ?>
                            <span class="error-message"><?php echo $validation_errors['programmingLanguages']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="experience" class="form-label">Relevant Experience</label>
                        <textarea id="experience" name="experience" class="form-textarea" 
                                  placeholder="Describe any relevant work experience, internships, projects, or research experience..."><?php echo htmlspecialchars($application_data['experience'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <!-- Availability Section -->
                <div class="form-section">
                    <h3>Availability</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Availability * (Select one)</label>
                        <div class="radio-group">
                            <?php 
                            $availability_options = array(
                                'part-time' => 'Part-time (10-20 hours per week)',
                                'full-time' => 'Full-time (40+ hours per week)',
                                'flexible' => 'Flexible schedule',
                                'summer' => 'Summer only',
                                'academic' => 'Academic year only'
                            );
                            
                            foreach ($availability_options as $value => $label): 
                                $checked = ($application_data['availability'] ?? '') === $value ? 'checked' : '';
                            ?>
                                <label class="radio-label">
                                    <input type="radio" name="availability" value="<?php echo $value; ?>" 
                                           class="form-radio" <?php echo $checked; ?> required>
                                    <?php echo htmlspecialchars($label); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php if (isset($validation_errors['availability'])): ?>
                            <span class="error-message"><?php echo $validation_errors['availability']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="workLocation" class="form-label">Preferred Work Location *</label>
                        <select id="workLocation" name="workLocation" class="form-select" required>
                            <option value="">Select location preference...</option>
                            <option value="on-campus" <?php echo ($application_data['workLocation'] ?? '') === 'on-campus' ? 'selected' : ''; ?>>On-campus only</option>
                            <option value="remote" <?php echo ($application_data['workLocation'] ?? '') === 'remote' ? 'selected' : ''; ?>>Remote only</option>
                            <option value="hybrid" <?php echo ($application_data['workLocation'] ?? '') === 'hybrid' ? 'selected' : ''; ?>>Hybrid (on-campus and remote)</option>
                            <option value="flexible" <?php echo ($application_data['workLocation'] ?? '') === 'flexible' ? 'selected' : ''; ?>>Flexible</option>
                        </select>
                        <?php if (isset($validation_errors['workLocation'])): ?>
                            <span class="error-message"><?php echo $validation_errors['workLocation']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Additional Information Section -->
                <div class="form-section">
                    <h3>Additional Information</h3>
                    
                    <div class="form-group">
                        <label for="additionalInfo" class="form-label">Additional Information</label>
                        <textarea id="additionalInfo" name="additionalInfo" class="form-textarea" 
                                  placeholder="Please provide any additional information that would help us evaluate your application..."><?php echo htmlspecialchars($application_data['additionalInfo'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn-submit">Submit Application</button>
                </div>
            </form>
        <?php endif; ?>
    </section>
</main>

<?php include 'includes/footer.php'; ?>