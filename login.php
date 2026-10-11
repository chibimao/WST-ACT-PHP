<?php
/**
 * login.php - Login page for CafeTrack
 * Uses PHP validation with regular expressions for server-side form validation
 * Originally converted from index.html
 */

include_once __DIR__ . '/includes/config.php';

$errors = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Server-side validation using regular expressions
    if (empty($username)) {
        $errors['username'] = "Please enter your username";
    } elseif (!validateUsername($username)) {
        if (strlen($username) < 3) {
            $errors['username'] = "Username must be at least 3 characters";
        } elseif (strlen($username) > 20) {
            $errors['username'] = "Username cannot exceed 20 characters";
        } else {
            $errors['username'] = "Username can only contain letters, numbers, and underscores";
        }
    }

    if (empty($password)) {
        $errors['password'] = "Please enter your password";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    }

    // If no validation errors, check credentials
    if (empty($errors)) {
        if ($username === DEMO_USERNAME && $password === DEMO_PASSWORD) {
            // Clear any previous lock
            if (isset($_SESSION['login_failed_attempts'])) {
                unset($_SESSION['login_failed_attempts']);
            }
            if (isset($_SESSION['login_lock_until'])) {
                unset($_SESSION['login_lock_until']);
            }
            header("Location: dashboard.php");
            exit();
        } else {
            // Track failed attempts for server-side lockout
            $_SESSION['login_failed_attempts'] = ($_SESSION['login_failed_attempts'] ?? 0) + 1;

            if ($_SESSION['login_failed_attempts'] >= 3) {
                $_SESSION['login_lock_until'] = time() + (1 * 60); // 1 minute lock
                $errors['password'] = "Too many failed attempts. Please try again later.";
            } else {
                $errors['password'] = "Invalid username or password.";
            }
        }
    }
}

$pageTitle = "CafeTrack - Login";
include __DIR__ . '/includes/header.php';
?>

<div class="split-page">
    <?php include __DIR__ . '/includes/brand_left.php'; ?>

    <div class="split-right">
        <div class="form-card">
            <div class="form-header">
                <h2 class="form-brand">Merrylane Cafe</h2>
                <h1 class="form-page-title">Login</h1>
            </div>

            <?php if (!empty($errors)): ?>
            <div class="error-summary">
                <?php foreach ($errors as $field => $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form id="loginForm" action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username"
                           value="<?php echo $username; ?>"
                           <?php if (isset($_SESSION['login_lock_until']) && $_SESSION['login_lock_until'] > time()): ?>disabled<?php endif; ?>>
                    <?php if (isset($errors['username'])): ?>
                    <span class="error"><?php echo $errors['username']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password"
                           <?php if (isset($_SESSION['login_lock_until']) && $_SESSION['login_lock_until'] > time()): ?>disabled<?php endif; ?>>
                    <?php if (isset($errors['password'])): ?>
                    <span class="error"><?php echo $errors['password']; ?></span>
                    <?php endif; ?>
                </div>

                <input type="submit" class="btn-submit" value="Login"
                       <?php if (isset($_SESSION['login_lock_until']) && $_SESSION['login_lock_until'] > time()): ?>disabled<?php endif; ?>>
            </form>

            <div class="link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    // Client-side validation using jQuery Validate with Regular Expressions
    $("#loginForm").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 20,
                pattern: /^[a-zA-Z0-9_]{3,20}$/
            },
            password: {
                required: true,
                minlength: 6,
                pattern: /^(?=.*[a-zA-Z])(?=.*\d).{6,}$/
            }
        },
        messages: {
            username: {
                required: "Please enter your username",
                minlength: "Username must be at least 3 characters",
                maxlength: "Username cannot exceed 20 characters",
                pattern: "Username can only contain letters, numbers, and underscores"
            },
            password: {
                required: "Please enter your password",
                minlength: "Password must be at least 6 characters",
                pattern: "Password must contain at least one letter and one number"
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
