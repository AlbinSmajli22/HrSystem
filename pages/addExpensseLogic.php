<?php
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$errors = array('file_size' => '', 'file_exist' => '', 'file_format' => '' );


if (isset($_POST['addExpense'])) {
    
    try {
        $send_to=$_POST['send_to'];
        $claim_date=$_POST['claim_date'];
        $currency=$_POST['currency'];
        $description=$_POST['description'];
        $comments=$_POST['comments'];
        $category=$_POST['category'];
        $details=$_POST['details'];
        $amount=$_POST['amount'];
        $tax=$_POST['tax'];
        $status='Submited';
        $image_file = $_FILES["image"]["name"];
        $type = $_FILES["image"]["type"];
        $size = $_FILES["image"]["size"];
        $temp = $_FILES["image"]["tmp_name"];
        $path = "../receiptsIMG/" . $image_file;

        if (empty($image_file)) {
            $errorMsg = "Please Selcet Image";
            header("Location: empexpenses.php");
            
        } else if ($type == "image/jpg" || $type == "image/png" || $type == "image/jpeg" || $type == "image/gif") {
            if (!file_exists($path)) {
                if ($size < 5000000) {
                    move_uploaded_file($temp, "../receiptsIMG/" . $image_file);
                    header("Location: empexpenses.php");
                } else {

                    $errorMsg = "your File is larger than 5MB";
                    header("Location: empexpenses.php");
                 
                }
            } else {

                $errorMsg = "File alredy exist...Check upload folder";
                header("Location:empexpenses.php");
             
            }
        } else {

            $errorMsg = "Upload jpg, jpeg, png & gif file format...Check file extension";
            header("Location: empexpenses.php");
        }
        if (!isset($errorMsg)) {
            $addExpensesQuery = "INSERT INTO  expenses (id, send_to, user_id, claim_date, currency, description, comments, category, details, amount, tax, receipts,  status) 
            VALUES (null, :send_to, :user_id, :claim_date, :currency, :description, :comments, :category, :details, :amount, :tax, :receipts,  :status )";

            $prep = $con->prepare($addExpensesQuery);            
            $prep->bindParam(':send_to', $send_to);
            $prep->bindParam(':user_id', $userId);
            $prep->bindParam(':claim_date', $claim_date);
            $prep->bindParam(':currency', $currency);
            $prep->bindParam(':description', $description);
            $prep->bindParam(':comments', $comments);
            $prep->bindParam(':category', $category);
            $prep->bindParam(':details', $details);
            $prep->bindParam(':amount', $amount);
            $prep->bindParam(':tax', $tax);
            $prep->bindParam(':receipts', $image_file);
            $prep->bindParam(':status', $status);

            $prep->execute();
            header("Location: /HrSystem/pages/empexpenses.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
if (isset($_POST['editExpense'])) {
    
    try {
        $expense_id=$_POST['expense_id'];
        $send_to=$_POST['send_to'];
        $claim_date=$_POST['claim_date'];
        $currency=$_POST['currency'];
        $description=$_POST['description'];
        $comments=$_POST['comments'];
        $category=$_POST['category'];
        $details=$_POST['details'];
        $amount=$_POST['amount'];
        $tax=$_POST['tax'];
        $status='Submited';
        $image_file = $_FILES["image"]["name"];
        $type = $_FILES["image"]["type"];
        $size = $_FILES["image"]["size"];
        $temp = $_FILES["image"]["tmp_name"];
        $path = "../receiptsIMG/" . $image_file;
        $receipts = $_POST["receipts"];

        if (empty($image_file)) {

           
            $editExpensesQuery = "UPDATE  expenses SET id=:id, send_to=:send_to, user_id=:user_id, claim_date=:claim_date, currency=:currency, description=:description, comments=:comments, 
            category=:category, details=:details, amount=:amount, tax=:tax, receipts=:receipts  ,status=:status
            where id=:id";

            $prep = $con->prepare($editExpensesQuery);            
            $prep->bindParam(':send_to', $send_to);
            $prep->bindParam(':id', $expense_id);
            $prep->bindParam(':user_id', $userId);
            $prep->bindParam(':claim_date', $claim_date);
            $prep->bindParam(':currency', $currency);
            $prep->bindParam(':description', $description);
            $prep->bindParam(':comments', $comments);
            $prep->bindParam(':category', $category);
            $prep->bindParam(':details', $details);
            $prep->bindParam(':amount', $amount);
            $prep->bindParam(':tax', $tax);
            $prep->bindParam(':receipts', $receipts);
            $prep->bindParam(':status', $status);

            $prep->execute();
            header("Location: /HrSystem/pages/empexpenses.php");
            
        } else if ($type == "image/jpg" || $type == "image/png" || $type == "image/jpeg" || $type == "image/gif") {
            if (!file_exists($path)) {
                if ($size < 5000000) {
                    move_uploaded_file($temp, "../receiptsIMG/" . $image_file);
                    header("Location: empexpenses.php");
                } else {

                    $errorMsg = "your File is larger than 5MB";
                    header("Location: empexpenses.php");
                 
                }
            } else {

                $errorMsg = "File alredy exist...Check upload folder";
                header("Location:empexpenses.php");
             
            }
        } else {

            $errorMsg = "Upload jpg, jpeg, png & gif file format...Check file extension";
            header("Location: empexpenses.php");
        }
        if (!empty($image_file)) {

            if ($type == "image/jpg" || $type == "image/png" || $type == "image/jpeg" || $type == "image/gif") {
                if (!file_exists($path)) {
                    if ($size < 5000000) {
                        move_uploaded_file($temp, "../receiptsIMG/" . $image_file);
                        header("Location: empexpenses.php");
                    } else {
    
                        $errorMsg = "your File is larger than 5MB";
                        header("Location: empexpenses.php");
                     
                    }
                } else {
    
                    $errorMsg = "File alredy exist...Check upload folder";
                    header("Location:empexpenses.php");
                 
                }
            }else {

                $errorMsg = "Upload jpg, jpeg, png & gif file format...Check file extension";
                header("Location: empexpenses.php");
            }
            


            $editExpensesQuery = "UPDATE  expenses SET id=:id, send_to=:send_to, user_id=:user_id, claim_date=:claim_date, currency=:currency, description=:description, comments=:comments, 
            category=:category, details=:details, amount=:amount, tax=:tax, receipts=:receipts,  status=:status
            where id=:id";

            $prep = $con->prepare($editExpensesQuery);            
            $prep->bindParam(':send_to', $send_to);
            $prep->bindParam(':id', $expense_id);
            $prep->bindParam(':user_id', $userId);
            $prep->bindParam(':claim_date', $claim_date);
            $prep->bindParam(':currency', $currency);
            $prep->bindParam(':description', $description);
            $prep->bindParam(':comments', $comments);
            $prep->bindParam(':category', $category);
            $prep->bindParam(':details', $details);
            $prep->bindParam(':amount', $amount);
            $prep->bindParam(':tax', $tax);
            $prep->bindParam(':receipts', $image_file);
            $prep->bindParam(':status', $status);

            $prep->execute();
            header("Location: /HrSystem/pages/empexpenses.php");
        }
       
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}



$categoryQuery = "SELECT * FROM expensescategory
WHERE company_id=:company_id";
$prep = $con->prepare($categoryQuery);
$prep->bindParam(':company_id', $companyId);
$prep->execute();
$categoryes = $prep->fetchAll();


$approverQuery = "SELECT * FROM expenseapprovers right join users on expenseapprovers.user_id = users.user_id
WHERE expenseapprovers.company_id=:company_id";
$prep = $con->prepare($approverQuery);
$prep->bindParam(':company_id', $companyId);

$prep->execute();
$expenseapprovers = $prep->fetchAll();


$exceptionsQuery = "SELECT * FROM expenses
WHERE user_id = :user_id";
$prep = $con->prepare($exceptionsQuery);
$prep->bindParam(':user_id', $userId);
$prep->execute();
$expenses = $prep->fetchAll();
?>