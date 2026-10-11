<?php
/**
 * config.php - Shared configuration and validation helper functions
 * CafeTrack PHP Project
 */

// Session configuration
session_start();

// Hardcoded demo credentials (from original README.md)
define('DEMO_USERNAME', 'maoadmin');
define('DEMO_PASSWORD', 'Admin12345');

/**
 * Validate username using regular expression
 * - Alphanumeric characters and underscores only
 * - Length between 3 and 20 characters
 *
 * @param string $username
 * @return bool
 */
function validateUsername($username) {
    $pattern = '/^[a-zA-Z0-9_]{3,20}$/';
    return preg_match($pattern, $username);
}

/**
 * Validate email using regular expression
 * - Standard email format
 *
 * @param string $email
 * @return bool
 */
function validateEmail($email) {
    $pattern = '/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email);
}

/**
 * Validate password using regular expression
 * - Minimum 6 characters
 * - At least one letter (uppercase or lowercase)
 * - At least one digit
 *
 * @param string $password
 * @return bool
 */
function validatePassword($password) {
    // At least 6 characters, at least one letter, at least one digit
    $pattern = '/^(?=.*[a-zA-Z])(?=.*\d).{6,}$/';
    return preg_match($pattern, $password);
}

/**
 * Validate that two passwords match
 *
 * @param string $password
 * @param string $confirmPassword
 * @return bool
 */
function validatePasswordMatch($password, $confirmPassword) {
    return $password === $confirmPassword;
}

/**
 * Sanitize input string for safe output
 *
 * @param string $data
 * @return string
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}
?>
