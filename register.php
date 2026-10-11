<?php
/**
 * register.php - Registration page for CafeTrack
 * Uses PHP validation with regular expressions for server-side form validation
 * Originally converted from register.html
 */

include_once __DIR__ . '/includes/config.php';

$errors = [];
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    // Server-side validation using regular expressions
    if (empty($username)) {
        $errors['username'] = "Please enter a username";
    } elseif (!validateUsername($username)) {
        if (strlen($username) < 3) {
            $errors['username'] = "Username must be at least 3 characters";
        } elseif (strlen($username) > 20) {
            $errors['username'] = "Username cannot exceed 20 characters";
        } else {
            $errors['username'] = "Username can only contain letters, numbers, and underscores";
        }
    }

    if (empty($email)) {
        $errors['email'] = "Please enter your email";
    } elseif (!validateEmail($email)) {
        $errors['email'] = "Please enter a valid email address";
    }

    if (empty($password)) {
        $errors['password'] = "Please enter a password";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    } elseif (!validatePassword($password)) {
        $errors['password'] = "Password must contain at least one letter and one number";
    }

    if (empty($confirmPassword)) {
        $errors['confirm-password'] = "Please confirm your password";
    } elseif (strlen($confirmPassword) < 6) {
        $errors['confirm-password'] = "Confirm password must be at least 6 characters";
    } elseif ($password !== $confirmPassword) {
        $errors['confirm-password'] = "Passwords do not match";
    }

    // If validation passes, redirect to login with success message
    if (empty($errors)) {
        $_SESSION['register_success'] = "Registration successful! Please log in.";
        header("Location: login.php");
        exit();
    }
}

$pageTitle = "CafeTrack - Register";
include __DIR__ . '/includes/header.php';
?>

<div class="split-page">
    <?php include __DIR__ . '/includes/brand_right.php'; ?>

    <div class="split-right">
        <div class="form-card">
            <div class="form-header">
                <h2 class="form-brand">Merrylane Cafe</h2>
                <h1 class="form-page-title">Register</h1>
            </div>

            <?php if (!empty($errors)): ?>
            <div class="error-summary">
                <?php foreach ($errors as $field => $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form id="registerForm" action="register.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>">
                    <?php if (isset($errors['username'])): ?>
                    <span class="error"><?php echo $errors['username']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                    <?php if (isset($errors['email'])): ?>
                    <span class="error"><?php echo $errors['email']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password">
                    <?php if (isset($errors['password'])): ?>
                    <span class="error"><?php echo $errors['password']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                    <?php if (isset($errors['confirm-password'])): ?>
                    <span class="error"><?php echo $errors['confirm-password']; ?></span>
                    <?php endif; ?>
                </div>

                <input type="submit" class="btn-submit" value="Register">
            </form>

            <div class="link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    // Client-side validation using jQuery Validate with Regular Expressions
    $("#registerForm").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 20,
                pattern: /^[a-zA-Z0-9_]{3,20}$/
            },
            email: {
                required: true,
                email: true,
                pattern: /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/
            },
            password: {
                required: true,
                minlength: 6,
                pattern: /^(?=.*[a-zA-Z])(?=.*\d).{6,}$/
            },
            "confirm-password": {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            username: {
                required: "Please enter a username",
                minlength: "Username must be at least 3 characters",
                maxlength: "Username cannot exceed 20 characters",
                pattern: "Username can only contain letters, numbers, and underscores"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                pattern: "Please enter a valid email address"
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 6 characters",
                pattern: "Password must contain at least one letter and one number"
            },
            "confirm-password": {
                required: "Please confirm your password",
                minlength: "Confirm password must be at least 6 characters",
                equalTo: "Passwords do not match"
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            // Form will submit to PHP for server-side validation
            return true;
        }
    });
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
