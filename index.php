<?php
// Composer class autoloader
require_once __DIR__ . '/vendor/autoload.php';

use App\ContactForm;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname  = filter_var($_POST[ContactForm::FORM_FIELD_FIRSTNAME], FILTER_SANITIZE_STRING);
    $lastname   = filter_var($_POST[ContactForm::FORM_FIELD_LASTNAME], FILTER_SANITIZE_STRING);
    $email      = filter_var($_POST[ContactForm::FORM_FIELD_EMAIL], FILTER_SANITIZE_STRING);
    $subject    = filter_var($_POST[ContactForm::FORM_FIELD_SUBJECT_TEXT], FILTER_SANITIZE_STRING);
    $message    = filter_var($_POST[ContactForm::FORM_FIELD_CLIENT_MSG], FILTER_SANITIZE_STRING);


    // Save to DB
    require_once 'database.php';

    $connection = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $connection->prepare(
        "INSERT INTO
        contact (
            {${ContactForm::FORM_FIELD_FIRSTNAME}},
            {${ContactForm::FORM_FIELD_LASTNAME}},
            {${ContactForm::FORM_FIELD_EMAIL}},
            {${ContactForm::FORM_FIELD_SUBJECT_TEXT}},
            {${ContactForm::FORM_FIELD_CLIENT_MSG}}
        )
        VALUES (?, ?, ?, ?, ?)"
    );
    if (!$sql) {
        die($connection->error);
    }

    $sql->bind_param("sssss", $firstname, $lastname, $email, $subject, $message);
    
    $sql->execute();
    $sql->close();

    echo "New records created successfully";


}

?>


<form action="" method="post" novalidate>
        <div class="row">
           <div class="col">
             <div class="form-group">
                <label>First name</label>
                <input name="<?php echo ContactForm::FORM_FIELD_FIRSTNAME;?>">
                <div class="invalid-feedback">
                    <?php echo $errors['firstname'] ?? '' ?>
                </div>
            </div>
         </div>
         <div class="col">
            <div class="form-group">
                <label>Last name</label>
                <input name="<?php echo ContactForm::FORM_FIELD_LASTNAME;?>">
                <div class="invalid-feedback">
                    <?php echo $errors['lastname'] ?? '' ?>
                </div>
            </div>
        <div class="col">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="<?php echo ContactForm::FORM_FIELD_EMAIL;?>">
                <div class="invalid-feedback">
                    <?php echo $errors['email'] ?? '' ?>
                </div>
            </div>
       </div>
       <div class="col">
          <div class="form-group">
               <label>Subject</label>
               <input name="<?php echo ContactForm::FORM_FIELD_SUBJECT_TEXT;?>">
                <div class="invalid-feedback">
                    <?php echo $errors['subject'] ?? '' ?>
                </div>
       </div>
       <div class="col">
          <div class="form-group">
               <label>Message</label>
               <input id="subject" name="<?php echo ContactForm::FORM_FIELD_CLIENT_MSG;?>" style="height:200px">
                <div class="invalid-feedback">
                    <?php echo $errors['message'] ?? '' ?>
                </div>
          </div>
       </div>
       <div class="form-group">
       <input type="submit" value="Submit">
    </div>
</form>
