<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>reCAPTCHA v3 Example</title>
    <script src="https://www.google.com/recaptcha/api.js?render=your_site_key"></script>
</head>
<body>
    <form id="your-form-id" action="verify_recaptcha.php" method="post">
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <!-- Add your form fields here -->
        <button type="submit">Submit</button>
    </form>

    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('your_site_key', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaResponse').value = token;
        });
    });
    </script>
</body>
</html>
