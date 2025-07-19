/**
 * Application Form Validation and Interactivity
 * Provides client-side validation for the student application form
 */

// Form validation functions
class ApplicationFormValidator {
    constructor() {
        this.form = document.querySelector('form[action="application.php"]');
        this.errors = {};
        this.init();
    }

    init() {
        if (!this.form) return;
        
        // Add event listeners for real-time validation
        this.addEventListeners();
        
        // Validate on submit
        this.form.addEventListener('submit', (e) => {
            if (!this.validateForm()) {
                e.preventDefault();
                this.showErrors();
            }
        });
    }

    addEventListeners() {
        // Real-time validation for key fields
        const fields = ['firstName', 'lastName', 'email', 'phone', 'studentId', 'gpa'];
        
        fields.forEach(fieldName => {
            const field = this.form.querySelector(`#${fieldName}`);
            if (field) {
                field.addEventListener('blur', () => this.validateField(fieldName));
                field.addEventListener('input', () => this.clearFieldError(fieldName));
            }
        });

        // Phone number formatting
        const phoneField = this.form.querySelector('#phone');
        if (phoneField) {
            phoneField.addEventListener('input', this.formatPhoneNumber.bind(this));
        }

        // GPA validation
        const gpaField = this.form.querySelector('#gpa');
        if (gpaField) {
            gpaField.addEventListener('input', this.validateGPA.bind(this));
        }
    }

    validateField(fieldName) {
        const field = this.form.querySelector(`#${fieldName}`);
        if (!field) return true;

        const value = field.value.trim();
        let isValid = true;

        switch (fieldName) {
            case 'firstName':
            case 'lastName':
            case 'studentId':
                isValid = this.validateRequired(value);
                break;
            case 'email':
                isValid = this.validateEmail(value);
                break;
            case 'phone':
                isValid = this.validatePhone(value);
                break;
            case 'gpa':
                isValid = this.validateGPAValue(value);
                break;
        }

        if (!isValid) {
            this.showFieldError(fieldName, this.getErrorMessage(fieldName));
        } else {
            this.clearFieldError(fieldName);
        }

        return isValid;
    }

    validateForm() {
        this.errors = {};
        let isValid = true;

        // Validate required text fields
        const requiredFields = ['firstName', 'lastName', 'email', 'phone', 'studentId', 'studentStatus', 'gpa', 'graduationDate'];
        
        requiredFields.forEach(fieldName => {
            const field = this.form.querySelector(`[name="${fieldName}"]`);
            if (field && !this.validateRequired(field.value)) {
                this.errors[fieldName] = this.getErrorMessage(fieldName);
                isValid = false;
            }
        });

        // Validate email format
        const emailField = this.form.querySelector('#email');
        if (emailField && emailField.value && !this.validateEmailFormat(emailField.value)) {
            this.errors.email = 'Please enter a valid email address';
            isValid = false;
        }

        // Validate phone format
        const phoneField = this.form.querySelector('#phone');
        if (phoneField && phoneField.value && !this.validatePhoneFormat(phoneField.value)) {
            this.errors.phone = 'Please enter a valid 10-digit phone number';
            isValid = false;
        }

        // Validate GPA
        const gpaField = this.form.querySelector('#gpa');
        if (gpaField && gpaField.value && !this.validateGPAValue(gpaField.value)) {
            this.errors.gpa = 'Please enter a valid GPA between 0.0 and 4.0';
            isValid = false;
        }

        // Validate checkboxes
        const researchInterests = this.form.querySelectorAll('input[name="researchInterests[]"]:checked');
        if (researchInterests.length === 0) {
            this.errors.researchInterests = 'Please select at least one research interest';
            isValid = false;
        }

        const programmingLanguages = this.form.querySelectorAll('input[name="programmingLanguages[]"]:checked');
        if (programmingLanguages.length === 0) {
            this.errors.programmingLanguages = 'Please select at least one programming language';
            isValid = false;
        }

        // Validate radio buttons
        const availability = this.form.querySelector('input[name="availability"]:checked');
        if (!availability) {
            this.errors.availability = 'Please select your availability';
            isValid = false;
        }

        return isValid;
    }

    validateRequired(value) {
        return value && value.trim().length > 0;
    }

    validateEmail(value) {
        return this.validateRequired(value) && this.validateEmailFormat(value);
    }

    validateEmailFormat(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    validatePhone(value) {
        return this.validateRequired(value) && this.validatePhoneFormat(value);
    }

    validatePhoneFormat(phone) {
        // Remove all non-digit characters
        const cleaned = phone.replace(/[^0-9]/g, '');
        return cleaned.length === 10;
    }

    validateGPAValue(value) {
        if (!this.validateRequired(value)) return false;
        const gpa = parseFloat(value);
        return !isNaN(gpa) && gpa >= 0 && gpa <= 4.0;
    }

    formatPhoneNumber(event) {
        const input = event.target;
        let value = input.value.replace(/[^0-9]/g, '');
        
        if (value.length >= 6) {
            value = `(${value.slice(0, 3)}) ${value.slice(3, 6)}-${value.slice(6, 10)}`;
        } else if (value.length >= 3) {
            value = `(${value.slice(0, 3)}) ${value.slice(3)}`;
        }
        
        input.value = value;
    }

    validateGPA(event) {
        const input = event.target;
        const value = parseFloat(input.value);
        
        if (value > 4.0) {
            input.value = '4.0';
        } else if (value < 0) {
            input.value = '0.0';
        }
    }

    getErrorMessage(fieldName) {
        const messages = {
            firstName: 'First name is required',
            lastName: 'Last name is required',
            email: 'Valid email address is required',
            phone: 'Valid phone number is required',
            studentId: 'Student ID is required',
            studentStatus: 'Student status is required',
            gpa: 'Valid GPA is required',
            graduationDate: 'Expected graduation date is required',
            researchInterests: 'At least one research interest must be selected',
            programmingLanguages: 'At least one programming language must be selected',
            availability: 'Availability selection is required',
            workLocation: 'Work location preference is required'
        };
        
        return messages[fieldName] || 'This field is required';
    }

    showFieldError(fieldName, message) {
        const field = this.form.querySelector(`#${fieldName}`) || this.form.querySelector(`[name="${fieldName}"]`);
        if (!field) return;

        // Remove existing error
        this.clearFieldError(fieldName);

        // Add error class to field
        field.classList.add('error');

        // Create and show error message
        const errorElement = document.createElement('span');
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        
        // Insert error message after the field
        field.parentNode.appendChild(errorElement);
    }

    clearFieldError(fieldName) {
        const field = this.form.querySelector(`#${fieldName}`) || this.form.querySelector(`[name="${fieldName}"]`);
        if (!field) return;

        // Remove error class
        field.classList.remove('error');

        // Remove error message
        const errorElement = field.parentNode.querySelector('.error-message');
        if (errorElement) {
            errorElement.remove();
        }
    }

    showErrors() {
        // Clear all existing errors first
        Object.keys(this.errors).forEach(fieldName => {
            this.clearFieldError(fieldName);
        });

        // Show new errors
        Object.keys(this.errors).forEach(fieldName => {
            this.showFieldError(fieldName, this.errors[fieldName]);
        });

        // Scroll to first error
        const firstErrorField = this.form.querySelector('.error');
        if (firstErrorField) {
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstErrorField.focus();
        }
    }
}

// Enhanced form interactivity
class FormEnhancements {
    constructor() {
        this.init();
    }

    init() {
        this.addProgressIndicator();
        this.addTooltips();
        this.addCharacterCounters();
        this.addConditionalFields();
    }

    addProgressIndicator() {
        const form = document.querySelector('form[action="application.php"]');
        if (!form) return;

        const sections = form.querySelectorAll('.form-section');
        const progressBar = document.createElement('div');
        progressBar.className = 'form-progress';
        progressBar.innerHTML = `
            <div class="progress-bar">
                <div class="progress-fill" style="width: 0%"></div>
            </div>
            <div class="progress-text">0% Complete</div>
        `;

        form.insertBefore(progressBar, sections[0]);

        // Update progress as fields are filled
        form.addEventListener('input', () => this.updateProgress());
        form.addEventListener('change', () => this.updateProgress());
    }

    updateProgress() {
        const form = document.querySelector('form[action="application.php"]');
        const progressFill = form.querySelector('.progress-fill');
        const progressText = form.querySelector('.progress-text');
        
        if (!progressFill || !progressText) return;

        const requiredFields = form.querySelectorAll('input[required], select[required], textarea[required]');
        const checkboxGroups = ['researchInterests[]', 'programmingLanguages[]'];
        const radioGroups = ['availability'];
        
        let filledFields = 0;
        let totalFields = requiredFields.length + checkboxGroups.length + radioGroups.length;

        // Check required fields
        requiredFields.forEach(field => {
            if (field.value.trim()) filledFields++;
        });

        // Check checkbox groups
        checkboxGroups.forEach(groupName => {
            const checkedBoxes = form.querySelectorAll(`input[name="${groupName}"]:checked`);
            if (checkedBoxes.length > 0) filledFields++;
        });

        // Check radio groups
        radioGroups.forEach(groupName => {
            const checkedRadio = form.querySelector(`input[name="${groupName}"]:checked`);
            if (checkedRadio) filledFields++;
        });

        const percentage = Math.round((filledFields / totalFields) * 100);
        progressFill.style.width = `${percentage}%`;
        progressText.textContent = `${percentage}% Complete`;
    }

    addTooltips() {
        const tooltips = {
            gpa: 'Enter your current cumulative GPA on a 4.0 scale',
            studentId: 'Enter your university student ID number',
            graduationDate: 'Select the month and year you expect to graduate'
        };

        Object.keys(tooltips).forEach(fieldId => {
            const field = document.querySelector(`#${fieldId}`);
            if (field) {
                field.setAttribute('title', tooltips[fieldId]);
            }
        });
    }

    addCharacterCounters() {
        const textareas = document.querySelectorAll('textarea');
        
        textareas.forEach(textarea => {
            const maxLength = 500; // Set a reasonable limit
            textarea.setAttribute('maxlength', maxLength);
            
            const counter = document.createElement('div');
            counter.className = 'character-counter';
            counter.textContent = `0/${maxLength} characters`;
            
            textarea.parentNode.appendChild(counter);
            
            textarea.addEventListener('input', () => {
                const length = textarea.value.length;
                counter.textContent = `${length}/${maxLength} characters`;
                
                if (length > maxLength * 0.9) {
                    counter.style.color = '#dc3545';
                } else {
                    counter.style.color = '#6c757d';
                }
            });
        });
    }

    addConditionalFields() {
        // Add any conditional field logic here if needed
        // For example, showing additional fields based on selections
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ApplicationFormValidator();
    new FormEnhancements();
});

// Add some CSS for form enhancements
const style = document.createElement('style');
style.textContent = `
    .form-progress {
        margin-bottom: 30px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }
    
    .progress-bar {
        width: 100%;
        height: 10px;
        background-color: #e9ecef;
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 10px;
    }
    
    .progress-fill {
        height: 100%;
        background-color: #0039A6;
        transition: width 0.3s ease;
    }
    
    .progress-text {
        text-align: center;
        font-weight: 600;
        color: #0039A6;
    }
    
    .character-counter {
        text-align: right;
        font-size: 0.9em;
        color: #6c757d;
        margin-top: 5px;
    }
    
    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }
    
    .error-message {
        color: #dc3545;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
    }
`;
document.head.appendChild(style);