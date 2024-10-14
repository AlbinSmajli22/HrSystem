<?php
include_once 'config.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$errors = array('companyExist' => '', 'mailError' => '');


if (isset($_POST['registre'])) {

    $email = $_POST['email'];
    $company_name = $_POST['company_name'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $temPass = $_POST['password'];
    $password = password_hash($temPass, PASSWORD_DEFAULT);
    $emp_num = $_POST['emp_num'];
    $Position_ID=null;
    $Departament_ID=null;
    $role=1;
    $location=null;
    $status=null;
    $report_to=null;
    $gender=null;
    $born=null;
    $started=date("y-m-d");
    $adress=null;

    $query = "SELECT * FROM company WHERE company_name like '$company_name'";

    $prep = $con->prepare($query);
    $prep->execute();
    $companies = $prep->rowCount();


    if ($companies > 0) {
        $errors['companyExist'] = 'Company alredy exist!';
    } else {

        $sql = "INSERT INTO company (company_name, emp_num) VALUES (:company_name, :emp_num)";

        $prep = $con->prepare($sql);

        $prep->bindParam(':company_name', $company_name);
        $prep->bindParam(':emp_num', $emp_num);

        $prep->execute();

        $last_id = $con->lastInsertId();
        

        $departament_name = 'Human Resources';
        $company_id=$last_id;

        $departamentQuery = "INSERT INTO departament (departament_name, company_id ) 
        VALUES (:departament_name,  :company_id)";

        $prep = $con->prepare($departamentQuery);

        $prep->bindParam(':departament_name', $departament_name);
        $prep->bindParam(':company_id', $company_id);

        $prep->execute();

        $company=$last_id;
        
                
                $userQuery = "INSERT INTO users (name, surname, email, password, Position_ID, Departament_ID, role, location, status, report_to, gender, born, started, adress, company) 
                VALUES (:name, :surname, :email, :password,:Position_ID,:Departament_ID,:role, :location, :status, :report_to, :gender, :born, :started, :adress, :company)";

                $prep = $con->prepare($userQuery);
            
                $prep->bindParam(':name', $name);
                $prep->bindParam(':surname', $surname);
                $prep->bindParam(':email', $email);
                $prep->bindParam(':password', $password);
                $prep->bindParam(':Position_ID', $Position_ID);
                $prep->bindParam(':Departament_ID', $Departament_ID);
                $prep->bindParam(':role', $role);
                $prep->bindParam(':location', $location);
                $prep->bindParam(':status', $status);
                $prep->bindParam(':report_to', $report_to);
                $prep->bindParam(':gender', $gender);
                $prep->bindParam(':born', $born);
                $prep->bindParam(':started', $started);
                $prep->bindParam(':adress', $adress);
                $prep->bindParam(':company', $company);
               
                $prep->execute();

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'e8e4bb3b3dd606';                     //SMTP username
            $mail->Password = 'e23bf9a8c45224';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
*/


            $mail = new PHPMailer();
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'e8e4bb3b3dd606';                     //SMTP username
            $mail->Password = 'e23bf9a8c45224';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port = 2525;


            //Recipients
            $mail->setFrom('albinibini6@gmail.com');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'No Replay';
            $mail->Body = 'Your company <b>' . $company_name . '</b> has been registred';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            header("Location: index.php");


        } catch (Exception $e) {

            $errors['mailError'] = "Message could not be sent. Mailer Error:{$mail->ErrorInfo}";
        }
    }
}
?>