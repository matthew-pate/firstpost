<?php
if (isset($_POST['email'])) {

    // EDIT THE FOLLOWING TWO LINES:
    $email_to = "mattpate@gmail.com";
    $email_subject = "New form submission from Portfolio";

    function problem($error)
    {
        echo "We're sorry, but there were error(s) found with the form you submitted.";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])
    ) {
        problem("We're sorry, but there appears to be a problem with the form you submitted.");
    }

    $fname = $_POST['fname']; // required
    $lname = $_POST['lname']; // required
    $email = $_POST['email']; // required
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The Email address you entered does not appear to be valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $fname)) {
        $error_message .= 'The first name you entered does not appear to be valid.<br>';
    }

    if (!preg_match($string_exp, $lname)) {
        $error_message .= 'The last name you entered does not appear to be valid.<br>';
    }

    if (strlen($comments) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "First Name: " . clean_string($fname) . "\n";
    $email_message .= "Last Name: " . clean_string($lname) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($comments) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n";
    $headers .= 'Reply-To: ' . $email . "\r\n";
    'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- INCLUDE YOUR SUCCESS MESSAGE BELOW -->

    Thanks for getting in touch. We'll get back to you soon.

<?php
}
?>