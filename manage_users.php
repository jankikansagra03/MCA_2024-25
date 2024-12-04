<?php
include_once("header.php");
include_once("admin_authentication.php");
?>
<div class="container">

    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Manage Users</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="row mb-3 justify-content-center">
            <!-- Wrapper for Search and Add User Button with Offset on Large Screens -->
            <div class="col-lg-6 offset-lg-6 col-12">
                <div class="row">
                    <!-- Search Bar -->
                    <div class="col-md-8 col-12 mb-2 mb-md-0">
                        <form method="GET" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Add User Button -->
                    <div class="col-md-4 col-12 text-md-right text-center">
                        <a href="admin_add_user.php" class="btn btn-dark form-control form-control-md">
                            <i class="fas fa-user-plus"></i> Add User
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
               
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <?php
                    // Get the search query if it exists
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Modify the SQL query to include the search condition
                    $search_query = '';
                    if (!empty($search)) {
                        $search_query = "WHERE fullname LIKE '%$search%' OR email LIKE '%$search%' OR mobile_number LIKE '%$search%' OR status LIKE '%$search%'";
                    }

                    // Get the total number of records matching the search query
                    $query = "SELECT * FROM registration $search_query";
                    $result = mysqli_query($con, $query);
                    $total_records = mysqli_num_rows($result);

                    // Pagination logic
                    $records_per_page = 10;
                    $total_pages = ceil($total_records / $records_per_page);
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start_from = ($page - 1) * $records_per_page;

                    // Fetch the records for the current page and search query
                    $query = "SELECT * FROM registration $search_query LIMIT $start_from, $records_per_page";
                    $result = mysqli_query($con, $query);
                    ?>

                    <tbody id="myTable">
                        <?php

                        // Display the filtered and paginated records
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['id'] . "</th>";
                            echo "<td>" . $row['fullname'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['mobile_number'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>";
                            echo "<a href='admin_edit_user.php?id=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>&nbsp&nbsp;";
                            echo "<a href='admin_delete_user.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fas fa-trash'></i> Delete</a>&nbsp&nbsp;";
                            echo "<a href='admin_view_user.php?id=" . $row['id'] . "' class='btn btn-info'><i class='fas fa-eye'></i> View</a>&nbsp&nbsp;";

                            echo "<a href='admin_view_user_cart.php?id=" . $row['id'] . "' class='btn btn-primary'><i class='fas fa-shopping-cart'></i> Cart</a>&nbsp&nbsp;";
                            if ($row['status'] == 'Active') {
                                echo "<a href='admin_toggle_user_status.php?id=" . $row['id'] . "&status=Inactive' class='btn btn-success'><i class='fas fa-toggle-on'></i> Deactivate</a>&nbsp&nbsp;";
                            } else if ($row['status'] == 'Inactive') {
                                echo "<a href='admin_toggle_user_status.php?id=" . $row['id'] . "&status=Active' class='btn btn-dark'><i class='fas fa-toggle-off'></i> Activate</a>&nbsp&nbsp;";
                            } else {
                                echo "<a class='btn btn-secondary'><i class='fa-solid fa-user-xmark'></i> Deleted</a>&nbsp&nbsp;";
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                    <nav>
                        <ul class="pagination">


                            <style>
                                .pagination li.page-item a.page-link {
                                    color: black;
                                    border: 1px solid black;
                                }

                                .pagination li.page-item a.page-link:hover {
                                    background-color: white;
                                    color: black;
                                }

                                .pagination li.page-item.active a.page-link {
                                    background-color: black;
                                    color: white;
                                }
                            </style>
                            &nbsp;&nbsp;&nbsp;
                            <?php
                            if ($page > 1) {
                                echo "<li class='page-item'><a class='page-link btn-dark' href='?page=" . ($page - 1) . "&search=" . $search . "'>Previous</a></li>";
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "&search=" . $search . "'>" . $i . "</a></li>";
                            }
                            if ($page < $total_pages) {
                                echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "&search=" . $search . "'>Next</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once("admin_footer.php");
