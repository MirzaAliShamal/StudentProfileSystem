<nav id="sidebar">
            <div class="sidebar-header text-center">
                <h3><img src="assets/img/sidebarlogo.png"></h3>
            </div>

            <ul class="list-unstyled components text-center">
                <p><h1><i class="icofont-gears"></i></h1>
				<h5>Admin Panel</h5></p>
                
            </ul>

            <ul class="list-unstyled CTAs text-left">
				<li>
                    <a href="admin_dashboard.php">Dashboard</a>
                </li>
				
				<li>
                    <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Students</a>
                    <ul class="collapse list-unstyled" id="studentSubmenu">
						<li>
                            <a href="admin_student_add.php">Student Add</a>
                        </li>
                        <li>
                            <a href="admin_student_list.php">Student List</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#studentScholarshipsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student Scholarships</a>
                    <ul class="collapse list-unstyled" id="studentScholarshipsSubmenu">
                        <li>
                            <a href="admin_student_scholarship_add.php">Student Scholarship Add</a>
                        </li>
                        <li>
                            <a href="admin_student_scholarship_list.php">Student Scholarship List</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#resultsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student Results</a>
                    <ul class="collapse list-unstyled" id="resultsSubmenu">
                        <li>
                            <a href="admin_student_result_add.php">Student Result Add</a>
                        </li>
                        <li>
                            <a href="admin_student_result_list.php">Student Result List</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#accountsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Accounts</a>
                    <ul class="collapse list-unstyled" id="accountsSubmenu">
						<li>
                            <a href="admin_voucher_add.php">Voucher Add</a>
                        </li>
						<li>
                            <a href="admin_voucher_list.php">Voucher Lists</a>
                        </li>
                    </ul>
                </li>
				
				<li>
                    <a href="#librarysubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Library</a>
                    <ul class="collapse list-unstyled" id="librarysubmenu">
                        <li>
                            <a href="admin_book_category_add.php">Book Category Add</a>
                        </li>
						<li>
                            <a href="admin_book_category_list.php">Book Category List</a>
                        </li>
						<li>
                            <a href="admin_book_add.php">Book Add</a>
                        </li>
						<li>
                            <a href="admin_book_list.php">Book List</a>
                        </li>
                        <li>
                            <a href="admin_book_issued.php">Issued Books</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#programsSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Programs</a>
                    <ul class="collapse list-unstyled" id="programsSubMenu">
                        <li>
                            <a href="admin_program_add.php">Program Add</a>
                        </li>
                        <li>
                            <a href="admin_program_list.php">Program List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#scholarshipsSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Scholarships</a>
                    <ul class="collapse list-unstyled" id="scholarshipsSubMenu">
                        <li>
                            <a href="admin_scholarship_add.php">Scholarship Add</a>
                        </li>
                        <li>
                            <a href="admin_scholarship_list.php">Scholarship List</a>
                        </li>
                    </ul>
                </li>
				<li>
                    <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">System Users</a>
                    <ul class="collapse list-unstyled" id="userSubmenu">
                        <li>
                            <a href="admin_user_add.php">Users Add</a>
                        </li>
                        <li>
                            <a href="admin_user_list.php">Users List</a>
                        </li>
                    </ul>
                </li>
				
				<li class="nav-item bg-danger">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>

            </ul>
        </nav>