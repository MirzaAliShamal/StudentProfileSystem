<nav id="sidebar" >
            <div class="sidebar-header text-center">
                <h3><img src="assets/img/sidebarlogo.png"></h3>
            </div>

            <ul class="list-unstyled components text-center">
                <p><h1><i class="icofont-teacher"></i></h1>
				<h5>Clerk Section</h5>
				</p>
            </ul>  
			
			<ul class="list-unstyled CTAs">
                <li>
                    <a href="clerk_dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Students</a>
                    <ul class="collapse list-unstyled" id="studentSubmenu">
                        <li>
                            <a href="clerk_student_add.php">Student Add</a>
                        </li>
                        <li>
                            <a href="clerk_student_list.php">Student List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#studentScholarshipsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student Scholarships</a>
                    <ul class="collapse list-unstyled" id="studentScholarshipsSubmenu">
                        <li>
                            <a href="clerk_student_scholarship_add.php">Student Scholarship Add</a>
                        </li>
                        <li>
                            <a href="clerk_student_scholarship_list.php">Student Scholarship List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#resultsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student Results</a>
                    <ul class="collapse list-unstyled" id="resultsSubmenu">
                        <li>
                            <a href="clerk_student_result_add.php">Student Result Add</a>
                        </li>
                        <li>
                            <a href="clerk_student_result_list.php">Student Result List</a>
                        </li>
                    </ul>
                </li>
				<li class="nav-item bg-danger">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>