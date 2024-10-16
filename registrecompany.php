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
    $role=1;
    $location=null;
    $status=null;
    $report_to=null;
    $gender=null;
    $born=null;
    $started=date("y-m-d");



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
        
        //create new departament

        $departament_name = 'Human Resources';
        $company_id=$last_id;

        $departamentQuery = "INSERT INTO departament (departament_name, company_id ) 
        VALUES (:departament_name,  :company_id)";

        $prep = $con->prepare($departamentQuery);

        $prep->bindParam(':departament_name', $departament_name);
        $prep->bindParam(':company_id', $company_id);

        $prep->execute();
        $Departament_ID = $con->lastInsertId();

        //Create new position

        $position_name ="Human Resource Manager";

        $positionQuery = "INSERT INTO position (position_name, Departament_ID ) 
        VALUES (:position_name,  :Departament_ID)";

        $prep = $con->prepare($positionQuery);

        $prep->bindParam(':position_name', $position_name);
        $prep->bindParam(':Departament_ID', $Departament_ID);

        $prep->execute();
        $Position_ID = $con->lastInsertId();



        
        
               
                $userQuery = "INSERT INTO users (name, surname, email, password, Position_ID, Departament_ID, role, location, status, report_to, gender, born, started, company) 
                VALUES (:name, :surname, :email, :password,:Position_ID,:Departament_ID,:role, :location, :status, :report_to, :gender, :born, :started,  :company)";

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
                $prep->bindParam(':company', $company_id);
               
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

            //var_dump($last_id, $Departament_ID, $Position_ID );
            header("Location: index.php");


        } catch (Exception $e) {

            $errors['mailError'] = "Message could not be sent. Mailer Error:{$mail->ErrorInfo}";
        }
    }
}
?>