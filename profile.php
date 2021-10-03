<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");

$detailsMessage = "";
$passwordMessage = "";

if(isset($_POST["saveDetailsButton"])) {  // SAVES CHANGES TO EMAIL AND NAMES
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

    if($account->updateDetails($firstName, $lastName, $email, $userLoggedIn)) {
        // SHOWS A SUCCESS MESSAGE
        $detailsMessage = "<div class='alertSuccess'>
        Details updated successfully!
        </div>";
    }
    else {
        // SHOWS A FAILURE MESSAGE
        $errorMessage = $account->getFirstError();

        $detailsMessage = "<div class='alertError'>
                                $errorMessage
                            </div>";
    }
}

if(isset($_POST["savePasswordButton"])) {  // SAVES CHANGES TO PASSWORD
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]); 
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);

    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedIn)) {
        $passwordMessage = "<div class='alertSuccess'>
                                Password updated successfully!
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();

        $passwordMessage = "<div class='alertError'>
                                $errorMessage
                            </div>";
    }
}
?>

<div class="settingsContainer column">
    <div class="formSection">
        <form method="POST">
            <h2>User Details</h2>

            <?php
                $user = new User($con, $userLoggedIn);

                $firstName = isset($_POST["firstName"]) ? $_POST["firstName"]: $user->getFirstName();
                $lastName = isset($_POST["lastName"]) ? $_POST["lastName"]: $user->getLastName();
                $email = isset($_POST["email"]) ? $_POST["email"]: $user->getEmail();
            ?>
            <input type="text" name="firstName" placeholder="First Name" value="<?php echo $firstName ?>">

            <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $lastName ?>">

            <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>">

            <div class="message">
                <?php echo $detailsMessage; ?>
            </div>
            <input type="submit" name="saveDetailsButton" value="Save">
        </form>
    </div>

    <div class="formSection">
        <form method="POST">
            <h2>Update Password</h2>
            <input type="password" name="oldPassword" placeholder="Enter the old password">

            <input type="password" name="newPassword" placeholder="Enter the new password">

            <input type="password" name="newPassword2" placeholder="Confirm new password">

            <div class="message">
                <?php echo $passwordMessage; ?>
            </div>

            <input type="submit" name="savePasswordButton" value="Save">
        </form>
    </div>

</div>