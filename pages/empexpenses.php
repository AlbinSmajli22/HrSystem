<?php
require_once '../config.php';
session_start();

include 'addExpensseLogic.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/expenses.css">
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
        <div class="expensesHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="expensesBody">
            <div class="expensesTableHead">
                <h5>
                    Expenses
                </h5>
                <button id="addExpenseCategory" data-bs-toggle="modal" data-bs-target="#addExpensesModal" data-bs-whatever="@mdo">
                    <a>
                        <i class="fa fa-plus"></i>  
                        Add Expense
                    </a>
                </button>
                <div class="modal fade-addExpensesModal" id="addExpensesModal" tabindex="-1"
                    aria-labelledby="addExpensesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Claim</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <label for="send_to">Send Claim To *</label>
                                    <select name="send_to" id="send_to">
                                    <?php foreach ($expenseapprovers as $expenseapprover): ?>
                                        <option value="<?= $expenseapprover['user_id'] ?>"><?= $expenseapprover['name'] ?> <?= $expenseapprover['surname'] ?></option>
                                    <?php endforeach; ?>
                                    </select><br>
                                    
                                    <label for="claim_date">Expense Claim Date *</label>
                                    <input type="date" name="claim_date" id="claim_date"><br>

                                    <label for="currency">Currency Unit</label>
                                    <select name="currency" id="currency">
                                       <option value="L">Albanian (L)</option>
                                       <option value="€">France (€)</option>
                                       <option value="€">Germany (€)</option>
                                       <option value="ID">Iraq (ID)</option>
                                       <option value="₪">Israel (₪)</option>
                                       <option value="£">United Kingdom (£)</option>
                                       <option value="$">United States ($)</option>
                                    </select><br>

                                    <label for="description">Description *</label>
                                    <input type="text" name="description" id="description"><br>

                                    <label for="comments">Comments (Optional)</label>
                                    <input type="text" name="comments" id="comments"><br>

                                    <label for="category">Category *</label> 
                                    <select name="category" id="category">
                                    <?php foreach ($categoryes as $category): ?>
                                        <option value="<?= $category['name'] ?>"> <?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                    </select><br>

                                    <label for="details">Details</label>
                                    <input type="text" name="details" id="details"><br>

                                    <label for="amount">Amount *</label>
                                    <input type="number" name="amount" id="amount"><br>

                                    <label for="tax">Tax</label>
                                    <input type="number" name="tax" id="tax"><br>   

                                    <label for="image">Upload Receipts</label>
                                    <input type="file" name="image" id="receipts">
                                    <div class="red-text"> <?php echo $errors['file_size'] ?> <?php echo $errors['file_exist'] ?> <?php echo $errors['file_format'] ?></div>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" name="addExpense" class="btn btn-success">Submit Claim</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="expensesTableBody">
                <table class="recentExpenses">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Comments</th>
                            <th>Expense Claim Date</th>
                            <th>Amount</th>
                            <th>Currency Unit</th>
                            <th>Actions</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenses as $expense): ?>
                            <tr>
                                <td>
                                    <?= $expense['description'] ?>
                                </td>
                                <td>
                                    <?= $expense['comments'] ?>
                                </td>
                                <td>
                                    <?= $expense['claim_date'] ?>
                                </td>
                                <td>
                                    <?= $expense['amount'] ?>
                                </td>
                                <td>
                                    <?= $expense['currency'] ?>
                                </td>
                                <td>
                                    <button class=" btn btn-xs btn-circle btn-outline btn-info m-l-sm"
                                        data-bs-toggle="modal" data-bs-target="#expenseEditModal<?=$expense['id']?>"
                                        data-bs-whatever="@mdo"> <i class=" fa fa-edit"></i> </button>
                                    <a href="deleteExpensse.php?expensse_id=<?=$expense['id']?>"
                                        class="btn btn-xs btn-circle btn-outline btn-danger m-l-sm"> <i
                                            class="fa fa-trash"></i> </a>
                                </td>
                                <div class="modal fade-expenseEditModal" id="expenseEditModal<?=$expense['id']?>" tabindex="-1"
                    aria-labelledby="expenseEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Exception</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                <input type="hidden" name="expense_id" value="<?= $expense['id'] ?>">
                                    <label for="send_to">Send Claim To *</label>
                                    <select name="send_to" id="send_to">
                                        <option value="<?= $expense['send_to'] ?>"></option>
                                    <?php foreach ($expenseapprovers as $expenseapprover): ?>
                                        <option value="<?= $expenseapprover['user_id'] ?>"><?= $expenseapprover['name'] ?> <?= $expenseapprover['surname'] ?></option>
                                    <?php endforeach; ?>
                                    </select><br>
                                    
                                    <label for="claim_date">Expense Claim Date *</label>
                                    <input type="date" name="claim_date" id="claim_date" value="<?= $expense['claim_date'] ?>"><br>

                                    <label for="currency">Currency Unit</label>
                                    <select name="currency" id="currency">
                                        <option value="<?= $expense['currency'] ?>"><?= $expense['currency'] ?></option>
                                       <option value="L">Albanian (L)</option>
                                       <option value="€">France (€)</option>
                                       <option value="€">Germany (€)</option>
                                       <option value="ID">Iraq (ID)</option>
                                       <option value="₪">Israel (₪)</option>
                                       <option value="£">United Kingdom (£)</option>
                                       <option value="$">United States ($)</option>
                                    </select><br>

                                    <label for="description">Description *</label>
                                    <input type="text" name="description" id="description" value="<?= $expense['description'] ?>"><br>

                                    <label for="comments">Comments (Optional)</label>
                                    <input type="text" name="comments" id="comments" value="<?= $expense['comments'] ?>"><br>

                                    <label for="category">Category *</label> 
                                    <select name="category" id="category">
                                    <option value="<?= $expense['category'] ?>"><?= $expense['category'] ?></option>
                                    <?php foreach ($categoryes as $category): ?>
                                        <option value="<?= $category['name'] ?>"> <?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                    </select><br>

                                    <label for="details">Details</label>
                                    <input type="text" name="details" id="details" value="<?= $expense['details'] ?>"><br>

                                    <label for="amount">Amount *</label>
                                    <input type="number" name="amount" id="amount" value="<?= $expense['amount'] ?>"><br>

                                    <label for="tax">Tax</label>
                                    <input type="number" name="tax" id="tax"  value="<?= $expense['tax'] ?>"><br>   

                                    <label for="image">Upload Receipts</label>
                                    <input type="hidden" name="receipts" id="receipts" value="<?= $expense['receipts'] ?>">
                                    <input type="file" name="image" id="receipts" value="">
                                    
                                </div>
                                <div class="modal-footer">
                                <button type="submit" name="editExpense" class="btn btn-success">Edit Claim</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div>

                </div>
            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>

</body>

</html>