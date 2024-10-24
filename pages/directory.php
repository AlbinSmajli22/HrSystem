<?php
require_once '../config.php';
session_start();
$userId = $_SESSION['user_id'];
$companyId = $_SESSION['company'];
include 'editDirectoryLogic.php';

$filterquery = "SELECT * from departament where company_id=$companyId";

$prep = $con->prepare($filterquery);
$prep->execute();
$filterdatas = $prep->fetchAll();



$filterquery2 = "SELECT * from position LEFT JOIN departament on position.Departament_ID=departament.departament_id
WHERE departament.company_id=$companyId";

$prep = $con->prepare($filterquery2);
$prep->execute();
$filterdatas2 = $prep->fetchAll();
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;
$next = $page + 1;
$previous = $page - 1;

$sql = "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id 
        WHERE company=$companyId
        order by name asc LIMIT $start , $limit";


if (isset($_POST['search'])) {

  $searchRequest = $_POST['search-box'];

  $sql = "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id
        WHERE name LIKE '{$searchRequest}%' AND company=$companyId 
        order by name asc";
}
if (isset($_POST['applayFilter'])) {
  $showDepartament = $_POST['showDepartament'];
  $showLocation = $_POST['showLocation'];
  $showPosition = $_POST['showPosition'];
  $showEmploymentStatus = $_POST['showEmploymentStatus'];

  $sql = "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id
        WHERE company=$companyId AND departament.departament_name LIKE '{$showDepartament}%' && location LIKE '{$showLocation}%' && position.position_name LIKE '{$showPosition}%' && status LIKE '{$showEmploymentStatus}%'
        order by name asc ";

}

$prep = $con->prepare($sql);
$prep->execute();
$datas = $prep->fetchAll();

$sql_count = "SELECT * from users
        LEFT JOIN position ON users.Position_ID = position.position_id
        LEFT JOIN departament ON users.Departament_ID = departament.departament_id
        WHERE company=$companyId";
$prep = $con->prepare($sql_count);
$prep->execute();
$total_datas = $prep->rowCount();

$total_page = ceil($total_datas / $limit);
$currentTime = date('h:i A');
$company=$_SESSION['company'];

?>

<html lang="en">

<head>
<script src="https://kit.fontawesome.com/3d560ffcbd.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/directory.css">
</head>

<body>
  <div>
    <?php include '../template/sidebar.php' ?>
  </div>
  <?php if ($_SESSION['role'] == 1) { ?>
    <div class="content">
      <?php include '../template/navbar.php' ?>
      <div class="name">
        <?php echo "<h2>" . $_SESSION['company_name'] . "</h2>"; ?>
      </div>
      <div class="clocks">
        <div class="clock1">
          <div class="clock1-1">

            <a href="">Main Office</a>
          </div>
          <div class="clock1-2">
            <i class="fa-regular fa-clock  fa-2xl" style="color: #3772d7;"></i>
            <?php echo '<h2>' . $currentTime . '</h2>' ?>
          </div>
        </div>
        <div class="clock2">
          <div class="clock2-1">

            <a href="">Production Office</a>
          </div>
          <div class="clock2-2">
            <i class="fa-regular fa-clock fa-2xl" style="color: #3772d7;"></i>
            <?php echo '<h2>' . $currentTime . '</h2>' ?>
          </div>
        </div>
      </div>
      <div class="usersData">

        <div class="filters">
          <h5>Employee Directory</h5>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add Employee
          </button>
          <button type="button" class="addFilter" data-bs-toggle="modal" data-bs-target="#filtersModal"
            data-bs-whatever="@mdo">
            <i class="fa-solid fa-filter " style="color: #888;"></i>
            <a>Filter</a>
            <i class="fa-solid fa-toggle-off "></i>
          </button>
          <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="filtersleModalLabel">New message</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="mb-3">
                      <label for="showDepartament" class="col-form-label">Show Departament</label>
                      <select id="showDepartament" name="showDepartament">
                        <option value="">Chose Departament:</option>
                        <?php foreach ($filterdatas as $filterdata): ?>
                          <option value="<?= $filterdata['departament_name'] ?>">
                            <?= $filterdata['departament_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="showLocation" class="col-form-label">Show Location </label>
                      <select id="showLocation" name="showLocation">
                        <option value="">Chose Location</option>
                        <option value="Main Office">Main Office</option>
                        <option value="Production">Production</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="showPosition" class="col-form-label">Show Position</label>
                      <select id="showPosition" name="showPosition">
                        <option value="">Chose Position:</option>
                        <?php foreach ($filterdatas2 as $filterdata2): ?>
                          <option value="<?= $filterdata2['position_name'] ?>">
                            <?= $filterdata2['position_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="showEmploymentStatus" class="col-form-label">Show Employment Status</label>
                      <select id="showEmploymentStatus" name="showEmploymentStatus">
                        <option value="">Chose Status:</option>
                        <option value="Casual">Casual</option>
                        <option value="Contract">Contract</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part">Part Time</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Reset Filter</button>
                      <button type="submit" name="applayFilter" class="btn btn-success">Applay Filter</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <form class="serachBar" method="POST">
          <input type="text" name="search-box" class="search-box" placeholder="Search directory...">
          <button type="submit" name='search'>Search</button>
        </form>
        <table class="userTable">
          <thead>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
              aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../addUserLogic.php" method="POST">
                      <div class="mb-3">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                      </div>
                      <div class="mb-3">
                        <label for="surname" class="col-form-label">Surname:</label>
                        <input type="text" class="form-control" name="surname" id="surname" required>
                      </div>
                      <div class="mb-3">
                        <label for="email" class="col-form-label">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                      </div>
                      <div class="mb-3">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                      </div>
                      <div class="mb-3">
                        <label for="Position_ID" class="col-form-label">Position Name:</label>
                        <select id="status" name="Position_ID" id="Position_ID" class="form-control"
                          placeholder="Chose Position">
                          <option value="">Chose Position</option>
                          <?php foreach ($filterdatas2 as $filterdata2): ?>
                            <option value="<?= $filterdata2['position_id'] ?>">
                              <?= $filterdata2['position_name'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="Departament_ID" class="col-form-label">Departament_Name:</label>
                        <select id="status" name="Departament_ID" id="Departament_ID" class="form-control"
                          placeholder="Chose Departament">
                          <option value="">Chose Departament</option>
                          <?php foreach ($filterdatas as $filterdata): ?>
                            <option value="<?= $filterdata['departament_id'] ?>">
                              <?= $filterdata['departament_name'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="role" class="col-form-label">Role:</label>
                        <input type="number" class="form-control" name="role" id="role" required>
                      </div>
                      <div class="mb-3">
                        <label for="location" class="col-form-label">Location:</label>
                        <select id="location" name="location" class="form-control" placeholder="Chose Location">
                          <option value="">Chose Location</option>
                          <option value="Main Office">Main Office</option>
                          <option value="Production">Production</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="status" class="col-form-label">Status:</label>
                        <select id="status" name="status" class="form-control" placeholder="Chose Status">
                          <option value="">Chose Status</option>
                          <option value="Casual">Casual</option>
                          <option value="Contract">Contract</option>
                          <option value="Full Time">Full Time</option>
                          <option value="Part">Part Time</option>
                          <option value="Unpaid">Unpaid</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="report_to" class="col-form-label">Report to:</label>
                        <select id="report_to" name="report_to" class="form-control" placeholder="Chose Leader">
                          <option value="">Chose Leader</option>
                          <?php foreach ($datas as $data): ?>
                            <option value="<?= $data['user_id'] ?>">
                              <?= $data['name'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="gender" class="col-form-label">Chose Gender:</label>
                        <select id="gender" name="gender" class="form-control" placeholder="Chose Gender">
                          <option value="">Chose Gender</option>
                          <option value="Male">Male</option>
                          <option value="Fmale">Fmale</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="born" class="col-form-label">Birth Date:</label>
                        <input type="date" name="born" id="born">
                      </div>
                      <div class="mb-3">
                        <label for="started" class="col-form-label">Started Date:</label>
                        <input type="date" name="started" id="started">
                      </div>
                      <div class="mb-3">
                        <input type="hidden" name="company" id="company" value="<?= $company ?>" placeholder="<?= $company ?>">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success">Registre Employee</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Position</th>
              <th>Departament</th>
              <th>Location</th>
              <th>Edit / Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datas as $data): ?>
              <tr>
                <td>
                  <?= $data['name'] ?>
                  <?= $data['surname'] ?>
                </td>
                <td>
                  <?= $data['email'] ?>
                </td>
                <td>
                  <?= $data['position_name'] ?>
                </td>
                <td>
                  <?= $data['departament_name'] ?>
                </td>
                <td>
                  <?= $data['location'] ?>
                </td>
                <td>
                  <button type="button" id="edit" class="btn btn-xs btn-outline-info rounded-circle m-l-sm me-2"  data-bs-toggle="modal"
                  data-bs-target="#editModal<?php echo $data['user_id']; ?>" data-bs-whatever="@mdo"><i class="fa fa-edit"></i>
                    
                    
                  </button> 
                  <button type="button" class="btn btn-xs btn-outline-danger rounded-circle m-l-sm"> <i class="fa fa-trash"></i>
                    <a  href="deleteDirectory.php?user_id=<?= $data['user_id']; ?>"> </a>
                  </button>
                  
                </td>
                <td>
                
  

              </tr>

              <div class="modal fade" id="editModal<?php echo $data['user_id']; ?>" tabindex="-1"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editModalLabel">New message</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                      <form action="" method="POST">
                        <div class="mb-3">
                          <label for="name" class="col-form-label">Name:</label>
                          <input type="text" class="form-control" name="name" id="name" value="<?= $data['name']; ?>">
                        </div>
                        <div class="mb-3">
                          <label for="surname" class="col-form-label">Surname:</label>
                          <input type="text" class="form-control" name="surname" id="surname"
                            value="<?= $data['surname']; ?>">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="col-form-label">E-mail:</label>
                          <input type="email" class="form-control" name="email" id="email" value="<?= $data['email']; ?>">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="col-form-label">Password:</label>
                          <input type="password" class="form-control" name="password" id="password"
                            value="<?= $data['password']; ?>">
                        </div>

                        <div class="mb-3">
                          <label for="Position_ID" class="col-form-label">Position Name:</label>
                          <select name="Position_ID" id="Position_ID" class="form-control">
                            <?php foreach ($filterdatas2 as $positions): ?>
                              <option value="<?= $positions['position_id'] ?>">
                                <?= $positions['position_name'] ?>
                              </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="Departament_ID" class="col-form-label">Departament_Name:</label>
                          <select name="Departament_ID" id="Departament_ID" class="form-control">
                            <?php foreach ($filterdatas as $departaments): ?>
                              <option value="<?= $departaments['departament_id'] ?>">
                                <?= $departaments['departament_name'] ?>
                              </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="role" class="col-form-label">Role:</label>
                          <select name="role" class="form-control" id="role">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="location" class="col-form-label">Location:</label>
                          <select id="location" name="location" class="form-control" placeholder="Chose Location">
                            <option value="<?= $data['location'] ?>">
                              <?= $data['location'] ?>
                            </option>
                            <option value="Main Office">Main Office</option>
                            <option value="Production">Production</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="status" class="col-form-label">Status:</label>
                          <select id="status" name="status" class="form-control" placeholder="Chose Status">
                            <option value="<?= $data['status'] ?>">
                              <?= $data['status'] ?>
                            </option>
                            <option value="Casual">Casual</option>
                            <option value="Contract">Contract</option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part">Part Time</option>
                            <option value="Unpaid">Unpaid</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="report_to" class="col-form-label">Report to:</label>
                          <input type="number" name="report_to" id="report_to" value="<?= $data['report_to'] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="gender" class="col-form-label">Chose Gender:</label>
                          <select id="gender" name="gender" class="form-control" placeholder="Chose Gender">
                            <option value="<?= $data['gender'] ?>">
                              <?= $data['gender'] ?>
                            </option>
                            <option value="Male">Male</option>
                            <option value="Fmale">Fmale</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="born" class="col-form-label">Birth Date:</label>
                          <input type="date" name="born" id="born" value="<?= $data['born'] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="started" class="col-form-label">Started Date:</label>
                          <input type="date" name="started" id="started" value="<?= $data['started'] ?>">
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" class="form-control" name="user_id" id="user_id"
                            value="<?= $data['user_id']; ?>">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="edit" class="btn btn-success">Edit Employee</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="pagination">
          <ul>
            <li><a href="directory.php?page=1">
                << </a>
            </li>
            <li><a href="directory.php?page=<?php echo $previous == 0 ? 1 : $previous ?>">
                < </a>
            </li>
            <?php for ($i = 1; $i <= $total_page; $i++) {
              $current_page = $page;
              $previous_2 = $current_page - 2;
              $next_2 = $current_page + 2;
              if ($i >= $previous_2 && $i <= $next_2) {
                ?>
                <li><a href="directory.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
              <?php }
            } ?>
            <li><a href="directory.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a></li>
            <li><a href="directory.php?page=<?php echo $total_page ?>">>></a></li>
          </ul>
        </div>
      </div>
      <?php include '../template/footer.php'; ?>
    </div>
  <?php } else { ?>
    <div class="content">
      <?php include '../template/navbar.php' ?>
      <div class="name">
        <h2>MetDaan</h2>
      </div>
      <div class="clocks">
        <div class="clock1">
          <div class="clock1-1">

            <a href="">Main Office</a>
          </div>
          <div class="clock1-2">
            <i class="fa-regular fa-clock  fa-2xl" style="color: #3772d7;"></i>
            <?php echo '<h2>' . $currentTime . '</h2>' ?>
          </div>
        </div>
        <div class="clock2">
          <div class="clock2-1">

            <a href="">Production Office</a>
          </div>
          <div class="clock2-2">
            <i class="fa-regular fa-clock fa-2xl" style="color: #3772d7;"></i>
            <?php echo '<h2>' . $currentTime . '</h2>' ?>
          </div>
        </div>
      </div>
      <div class="usersData">

        <div class="filters">
          <h5>Employee Directory</h5>

          <button type="button" class="addFilter" data-bs-toggle="modal" data-bs-target="#filtersModal"
            data-bs-whatever="@mdo">
            <i class="fa-solid fa-filter " style="color: #888;"></i>
            <a>Filter</a>
            <i class="fa-solid fa-toggle-off "></i>
          </button>
          <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="filtersleModalLabel">New message</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="mb-3">
                      <label for="showDepartament" class="col-form-label">Show Departament</label>
                      <select id="showDepartament" name="showDepartament">
                        <option value="">Chose Departament:</option>
                        <?php foreach ($filterdatas as $filterdata): ?>
                          <option value="<?= $filterdata['departament_name'] ?>">
                            <?= $filterdata['departament_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="showLocation" class="col-form-label">Show Location </label>
                      <select id="showLocation" name="showLocation">
                        <option value="">Chose Location</option>
                        <option value="Main Office">Main Office</option>
                        <option value="Production">Production</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="showPosition" class="col-form-label">Show Position</label>
                      <select id="showPosition" name="showPosition">
                        <option value="">Chose Position:</option>
                        <?php foreach ($filterdatas2 as $filterdata2): ?>
                          <option value="<?= $filterdata2['position_name'] ?>">
                            <?= $filterdata2['position_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="showEmploymentStatus" class="col-form-label">Show Employment Status</label>
                      <select id="showEmploymentStatus" name="showEmploymentStatus">
                        <option value="">Chose Status:</option>
                        <option value="Casual">Casual</option>
                        <option value="Contract">Contract</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part">Part Time</option>
                        <option value="Unpaid">Unpaid</option>
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Reset Filter</button>
                      <button type="submit" name="applayFilter" class="btn btn-success">Applay Filter</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <form class="serachBar" method="POST">
          <input type="text" name="search-box" class="search-box" placeholder="Search directory...">
          <button type="submit" name='search'>Search</button>
        </form>
        <table class="userTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Position</th>
              <th>Departament</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datas as $data): ?>
              <tr>
                <td>
                  <?= $data['name'] ?>
                  <?= $data['surname'] ?>
                </td>
                <td>
                  <?= $data['email'] ?>
                </td>
                <td>
                  <?= $data['position_name'] ?>
                </td>
                <td>
                  <?= $data['departament_name'] ?>
                </td>
                <td>
                  <?= $data['location'] ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="pagination">
          <ul>
            <li><a href="directory.php?page=1">
                << </a>
            </li>
            <li><a href="directory.php?page=<?php echo $previous == 0 ? 1 : $previous ?>">
                < </a>
            </li>
            <?php for ($i = 1; $i <= $total_page; $i++) {
              $current_page = $page;
              $previous_2 = $current_page - 2;
              $next_2 = $current_page + 2;
              if ($i >= $previous_2 && $i <= $next_2) {
                ?>
                <li><a href="directory.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
              <?php }
            } ?>
            <li><a href="directory.php?page=<?php echo $next > $total_page ? $total_page : $next ?>">></a></li>
            <li><a href="directory.php?page=<?php echo $total_page ?>">>></a></li>
          </ul>
        </div>
      </div>
      <?php include '../template/footer.php'; ?>
    </div>
  <?php } ?>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script>
  $(document).click(function () {
    $('#edit').click(function (e) {
      e.preventDefault();


    })
  });
</script>