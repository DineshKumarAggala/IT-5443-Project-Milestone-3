<?php
session_start();
require_once 'includes/functions.php';

$page_title = 'Center for Applied Computing - Application Submitted';
$errors = array();
$application_data = array();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validate and sanitize all inputs
    $required_fields = array(
        'firstName', 'lastName', 'email', 'phone', 'studentId',
        'studentStatus', 'gpa', 'graduationDate', 'experience', 
        'availability', 'workLocation'
    );
    
    // Check required fields
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || !validate_required($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        } else {
            $application_data[$field] = sanitize_input($_POST[$field]);
        }
    }
    
    // Validate email format
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        if (!validate_email($_POST['email'])) {
            $errors[] = 'Please enter a valid email address.';
        }
    }
    
    // Validate phone number
    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        if (!validate_phone($_POST['phone'])) {
            $errors[] = 'Please enter a valid 10-digit phone number.';
        }
    }
    
    // Validate GPA
    if (isset($_POST['gpa']) && !empty($_POST['gpa'])) {
        $gpa = floatval($_POST['gpa']);
        if ($gpa < 0 || $gpa > 4) {
            $errors[] = 'GPA must be between 0.0 and 4.0.';
        }
    }
    
    // Validate Student ID format (assuming KSU format)
    if (isset($_POST['studentId']) && !empty($_POST['studentId'])) {
        $studentId = preg_replace('/[^0-9]/', '', $_POST['studentId']);
        if (strlen($studentId) !== 9 || !preg_match('/^900/', $studentId)) {
            $errors[] = 'Student ID must be a 9-digit number starting with 900.';
        }
    }
    
    // Validate research interests (at least one required)
    if (!isset($_POST['researchInterests']) || empty($_POST['researchInterests'])) {
        $errors[] = 'Please select at least one research interest.';
    } else {
        $application_data['researchInterests'] = $_POST['researchInterests'];
    }
    
    // Validate programming languages (at least one required)
    if (!isset($_POST['programmingLanguages']) || empty($_POST['programmingLanguages'])) {
        $errors[] = 'Please select at least one programming language.';
    } else {
        $application_data['programmingLanguages'] = $_POST['programmingLanguages'];
    }
    
    // Validate graduation date (should be in the future)
    if (isset($_POST['graduationDate']) && !empty($_POST['graduationDate'])) {
        $gradDate = strtotime($_POST['graduationDate']);
        $currentDate = time();
        if ($gradDate <= $currentDate) {
            $errors[] = 'Graduation date must be in the future.';
        }
    }
    
    // Handle optional fields
    if (isset($_POST['additionalInfo'])) {
        $application_data['additionalInfo'] = sanitize_input($_POST['additionalInfo']);
    }
    
    // If there are validation errors, redirect back to form
    if (!empty($errors)) {
        $_SESSION['application_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header('Location: application.php');
        exit();
    }
    
    // Store successful application data
    $_SESSION['application_submitted'] = true;
    $_SESSION['application_data'] = $application_data;
    
} else {
    // If accessed directly without POST, redirect to application form
    header('Location: application.php');
    exit();
}

include 'includes/header.php';
?>

<!-- Main Content -->
<main class="main-content">
    <section class="application-section">
        <h2>Application Submitted Successfully</h2>
        
        <div class="success-message">
            <h3>Thank You for Your Application!</h3>
            <p>Your research position application has been successfully submitted to the Center for Applied Computing. Please review the information below to ensure all details are correct.</p>
        </div>

        <!-- Application Summary -->
        <div class="application-summary">
            <h3>Application Summary</h3>
            <table class="application-table">
                <?php 
                $formatted_data = format_application_data($application_data);
                foreach ($formatted_data as $item): 
                ?>
                <tr>
                    <td class="label-column"><?php echo htmlspecialchars($item['label']); ?>:</td>
                    <td class="value-column"><?php echo htmlspecialchars($item['value']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Next Steps -->
        <div class="next-steps">
            <h3>Next Steps</h3>
            <ul class="instruction-list">
                <li>Your application will be reviewed by our faculty committee within 5-7 business days</li>
                <li>You will receive an email confirmation at <?php echo htmlspecialchars($application_data['email']); ?> within 24 hours</li>
                <li>If selected for an interview, you will be contacted within 2 weeks</li>
                <li>Questions? Contact us at <a href="mailto:research@kennesaw.edu" class="contact-link">research@kennesaw.edu</a></li>
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="index.php" class="btn-secondary">Return to Home</a>
            <a href="application.php" class="btn-primary">Submit Another Application</a>
        </div>
    </section>
</main>

<?php 
// Clear session data after displaying
unset($_SESSION['application_data']);
unset($_SESSION['application_submitted']);

include 'includes/footer.php'; 
?>
