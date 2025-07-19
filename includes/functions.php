<?php
/**
 * Common functions for the Center for Applied Computing website
 */

/**
 * Sanitize input data
 * @param string $data - Input data to sanitize
 * @return string - Sanitized data
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Validate email format
 * @param string $email - Email to validate
 * @return bool - True if valid email format
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (basic format)
 * @param string $phone - Phone number to validate
 * @return bool - True if valid phone format
 */
function validate_phone($phone) {
    // Remove all non-digit characters
    $cleaned = preg_replace('/[^0-9]/', '', $phone);
    // Check if it's 10 digits
    return strlen($cleaned) === 10;
}

/**
 * Validate required field
 * @param string $value - Value to check
 * @return bool - True if not empty
 */
function validate_required($value) {
    return !empty(trim($value));
}

/**
 * Get current page name for navigation highlighting
 * @return string - Current page name
 */
function get_current_page() {
    $current_page = basename($_SERVER['PHP_SELF']);
    return str_replace('.php', '', $current_page);
}

/**
 * Format application data for display
 * @param array $data - Application data
 * @return array - Formatted data with labels
 */
function format_application_data($data) {
    $formatted = array();
    
    $field_labels = array(
        'firstName' => 'First Name',
        'lastName' => 'Last Name',
        'email' => 'Email Address',
        'phone' => 'Phone Number',
        'studentId' => 'Student ID',
        'studentStatus' => 'Student Status',
        'gpa' => 'GPA',
        'graduationDate' => 'Expected Graduation Date',
        'researchInterests' => 'Research Interests',
        'programmingLanguages' => 'Programming Languages',
        'experience' => 'Relevant Experience',
        'availability' => 'Availability',
        'workLocation' => 'Preferred Work Location',
        'additionalInfo' => 'Additional Information'
    );
    
    foreach ($data as $key => $value) {
        if (isset($field_labels[$key])) {
            $formatted[] = array(
                'label' => $field_labels[$key],
                'value' => is_array($value) ? implode(', ', $value) : $value
            );
        }
    }
    
    return $formatted;
}
?>