<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$expense_id = $_GET['expense_id'];

$expenseQuery = " SELECT e.id, e.send_to, e.user_id, e.claim_date, e.currency, e.approved,
e.description, e.comments, e.category, e.details,e.amount, e.tax,
e.receipts, e.status, e.created, u.user_id, u.image, u.name, u.surname, 
u.Position_ID, p.position_id, p.position_name  FROM expenses e RIGHT JOIN users u on u.user_id=e.user_id RIGHT JOIN position p ON p.position_id=u.Position_ID
WHERE e.id = :expense_id";
$prep = $con->prepare($expenseQuery);
$prep->bindParam(':expense_id', $expense_id);
$prep->execute();
$Expense = $prep->fetch();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/updateExpense.css">
    <script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
</head>

<body style="background-color: #F4F6FA;">
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="expenseHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div id="expenseBody">
            <div id="theExpenseContent">
                <div id="text">
                    <div id="Expense_Claim">
                        <h5>Expense Claim</h5>
                        <?php if ($Expense['status'] == 'Submited') { ?>
                            <span id="Submited"><?= $Expense['status'] ?></span>
                        <?php } elseif ($Expense['status'] == 'Approved') { ?>
                            <span id="Approved"><?= $Expense['status'] ?></span>
                        <?php } else { ?>
                            <span id="Declined"><?= $Expense['status'] ?></span>
                        <?php } ?>
                    </div>

                    <div id="Expense_ClaimBody">
                        <div id="user">
                            <img id="userImg" src="../receiptsIMG/<?= $Expense['image'] ?>" alt="">
                            <div id="userName">
                                <p style="color:#0D6EFD;"><?= $Expense['name'] ?> <?= $Expense['surname'] ?></p>
                                <p> <?= $Expense['position_name'] ?></p>
                            </div>
                        </div>
                        <div id="description">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description"
                                value="<?= $Expense['description'] ?>">
                        </div>
                        <div id="comments">
                            <label for="comments">Comments</label>
                            <textarea name="comments" id="comments"><?= $Expense['comments'] ?></textarea>
                        </div>
                        <div id="date">
                            <div class="date_row">
                                <label for="claim_date">Expense Claim Date</label>
                                <input type="date" name="claim_date" id="" value="<?= $Expense['claim_date'] ?>">
                            </div>
                            <div class="date_row">
                                <label for="created">Submitted Date</label>
                                <input type="date" name="created" id="created" value="<?= $Expense['created'] ?>">
                            </div>
                            <div class="date_row">
                                <label for="approved">Approved Date</label>
                                <input type="date" name="approved" id="approved" value="<?= $Expense['approved'] ?>">
                            </div>
                        </div>
                        <div id="bill">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Expense Category</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Tax Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $Expense['category'] ?></td>
                                        <td><?= $Expense['details'] ?></td>
                                        <td><?= $Expense['currency'] ?><?= $Expense['amount'] ?> </td>
                                        <td><?= $Expense['currency'] ?><?= $Expense['tax'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Total</h3>
                                        </td>
                                        <td>
                                            <h3></h3>
                                        </td>
                                        <td>
                                            <h3><?= $Expense['currency'] ?><?= $Expense['amount'] ?></h3>
                                        </td>
                                        <td>
                                            <h3><?= $Expense['currency'] ?><?= $Expense['tax'] ?></h3>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="receipts">
                            <div id="card">
                                <div id="cardpartone">
                                    <img src="../images/img-icon.png" alt="">
                                </div>
                                <div id="cardpartwo">
                                    <a href="../receiptsIMG/<?= $Expense['receipts'] ?>" download>
                                        <?= $Expense['receipts'] ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="reimbursementAmount">
                            <label for="reimbursement">Reimbursement Amount</label>
                            <input type="number" name="reimbursement" id="reimbursement"
                                value="<?= $Expense['amount'] ?>">
                        </div>
                    </div>
                </div>
                <div id="butons">
                    <button>Approved</button>
                    <button>Rejected</button>
                    <button>Cancel</button>
                </div>
            </div>
            <div id="theExpenseDates">
                <p>created <?= $Expense['created'] ?></p>
                <p>created by <?= $Expense['name'] ?> <?= $Expense['surname'] ?></p>
            </div>
        </div>

        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>