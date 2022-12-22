
<?php
include_once("./database/config.php");

$username = $_SESSION['sittername'];

$sql = "SELECT * FROM babysitter WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image=$row['sitter_image'];

?>


<header class="app-header fixed-top" style="height:60px;">
    <!-- top bar -->
    <div class="app-header-inner">
        <div class="container-fluid py-2">
            <div class="app-header-content">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                role="img">
                                <title>Menu</title>
                                <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="app-utilities col-auto" style="margin-right:60px;margin-top:4px;">
                        <!--profile-->
                        <div class="app-utility-item app-user-dropdown dropdown">
                            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false"><span style="font-size:16px; font-weight:700px;color:black;font-family:poppins;">@<?php echo $username;?> </span><img src="./img/babysitters/<?php echo $image;?>"
                                    alt="user profile" style="border-radius:50%;"></a>
                            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                <li><a class="dropdown-item" href="babysitter_profile.php">My Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top bar -->

    <!--sidebar-->
    <div id="app-sidepanel" class="app-sidepanel">
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <!--Logo-->
            <div class="app-branding">
                <a href="" class="navbar-brand" style="">
                    <h3 class="m-0 text-primary"><span class="text-dark"
                            style="color:black;font-weight:700;font-family:poppins;padding-left:20%">Kid</span>Care
                    </h3>
                </a>

            </div>

            <!--Liks-->
            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">
                        <a class="nav-link" href="babysitter_home.php">
                        <i class="fa-solid fa-house fa-lg"></i> &nbsp;&nbsp;
                            <span class="nav-link-text" style=" font-weight:500;">Dashboard</span>
                        </a>
                    </li>
                    <!--//nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="babysitter_appointments.php">
                        <i class="fa-solid fa-calendar fa-lg"></i> &nbsp;&nbsp;
                            <span class="nav-link-text" style="font-weight:500;">My Appointments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="babysitter_appointment_history.php">
                        <i class="fa-solid fa-calendar-check fa-lg"></i> &nbsp;&nbsp;
                            <span class="nav-link-text" style="font-weight:500;">Appointment History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="babysitter_reviews.php">
                        <i class="fa-solid fa-message fa-lg"></i> &nbsp;&nbsp;
                            <span class="nav-link-text" style=" font-weight:500;">My Reviews</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!--sidebar-->

</header>