<nav id="sidebar">
            <div class="sidebar-header text-center">
                <h3><img src="assets/img/sidebarlogo.png"></h3>
            </div>

            <ul class="list-unstyled components text-center">
                <p><h1><i class="icofont-book-alt"></i><i class="icofont-book-alt"></i></h1>
				<h5>Library Section</h5>
				</p>
            </ul>

            <ul class="list-unstyled CTAs">
				<li>
                     <a href="librarian_dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="#librarybook_categorysubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Book Category</a>
                    <ul class="collapse list-unstyled" id="librarybook_categorysubmenu">
                        <li>
                            <a href="librarian_book_category_add.php">Book Category Add</a>
                        </li>
                        <li>
                            <a href="librarian_book_category_list.php">Book Category List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#Book" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Book</a>
                    <ul class="collapse list-unstyled" id="Book">
                        <li>
                            <a href="librarian_book_add.php">Book Add</a>
                        </li>
                        <li>
                            <a href="librarian_book_list.php">Book List</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="librarian_book_issued.php">Issued Books</a>
                </li>
				<li class="nav-item bg-danger">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>