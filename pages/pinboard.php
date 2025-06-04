<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];

$deleteOld="DELETE FROM notes WHERE created < NOW() - INTERVAL 30 DAY";
$prep = $con->prepare($deleteOld);
$prep->execute();

$NotesQuery = "SELECT * FROM notes RIGHT JOIN users ON notes.user = users.user_id 
WHERE notes.company=:company
ORDER BY created DESC";
$prep = $con->prepare($NotesQuery);
$prep->bindParam(':company', $companyId);
$prep->execute();
$notes = $prep->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pinboard.css">
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

<body style="background-color: #F4F6FA; ">
    <div>
        <?php include '../template/sidebar.php' ?>
    </div>
    <div class="content">
        <?php include '../template/navbar.php' ?>
        <div class="pinBoardHead">
            <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
        </div>

        <div class="pinBoardBody">
            <div class="intro">
                <div class="pull-right">
                    <button type="button" id="addNewPin" data-bs-toggle="modal" data-bs-target="#addNewPinModal"
                        data-bs-whatever="@mdo"><i class="fa fa-thumb-tack"></i> Add A New Pin</button>

                    <div class="modal fade-assigne-GoalModal" id="addNewPinModal" tabindex="-1"
                        aria-labelledby="addNewPinModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated slideInTop">
                                <form action="pinboardLogic.php" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">×</button>
                                        <h4 class="modal-title" id="exampleModalLabel">Add A New Pin</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="beginning-part">
                                            <div class="row">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" maxlength="40" id="title"
                                                    oninput="countTitleCharacters()">
                                                <span class="counter" id="titleCharCount">40 characters left</span>
                                            </div>
                                            <div class="row">
                                                <label for="Body">Body</label>
                                                <textarea name="body" id="body" maxlength="180" rows="3"
                                                    oninput="countBodyCharacters()"></textarea>
                                                <span class="counter" id="bodyCharCount">180 characters left</span>
                                            </div>
                                        </div>
                                        <div class="last-part">
                                            <small>
                                                <strong>Important Note:</strong>
                                                Please adhere to your company guidelines when entering a pin. Any pins
                                                contravening the rules can be reported (by clicking the asterisk icon)
                                                and may be removed by the administrators.
                                            </small>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-exit" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="addnote" class="btn-save">Save</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <p>
                    The Pinboard is the area where you can 'pin' short public messages to all other employees. Whether
                    it is a classified ad, or a 'well done' message to a co-worker, or anything else!
                </p>
                <p>
                    Note: Pins will be displayed for a maximum of <strong>30</strong> days.
                </p>


            </div>
            <div class="pinBoard">

                <ul class="notes">
                    <?php foreach ($notes as $note): ?>
                        <li>
                            <div>
                                <small>By <?=$note['name']?> <?=$note['surname']?> (less than a minute ago)</small>
                                <h4><?=$note['title']?></h4>
                                <p> <?=$note['body']?> </p>
                                <?php if($note['user']==$userId): ?>
                                <a href="deleteNote.php?notes_id=<?= $note['notes_id'] ?>">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
        <?php include '../template/footer.php'; ?>
    </div>
    <script>
        function countTitleCharacters() {
            var title = document.getElementById('title');
            var charCountSpan = document.getElementById('titleCharCount')
            var length = title.value.length;

            charCountSpan.textContent = (40 - length) + ' characters left';

        }
        function countBodyCharacters() {
            var title = document.getElementById('body');
            var charCountSpan = document.getElementById('bodyCharCount')
            var length = title.value.length;

            charCountSpan.textContent = (180 - length) + ' characters left';

        }
    </script>
</body>

</html>