<header class="app-header fixed-top">	   	            
    <div class="app-header-inner">  
        <div class="container-fluid py-2">
            <div class="app-header-content"> 
                <div class="row justify-content-between align-items-center">
                
                <div class="col-auto">
                    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>เมนู</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
                    </a>
				</div>
                <!--//col-->
                <!-- <div class="search-mobile-trigger d-sm-none col">
                    <i class="search-mobile-trigger-icon fas fa-search"></i>
                </div>
                <div class="app-search-box col">
                    <form class="app-search-form">   
                        <input type="text" placeholder="Search..." name="search" class="form-control search-input">
                        <button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fas fa-search"></i></button> 
                    </form>
                </div> -->
                
                <!--//app-search-box-->
                
                <div class="app-utilities col-auto">
                    <div class="app-utility-item app-notifications-dropdown dropdown">   
                    </div><!--//app-utility-item-->
                    <div class="app-utility-item">
                    </div><!--//app-utility-item-->
                    
                    <div class="app-utility-item app-user-dropdown dropdown">
                        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <?=$_SESSION['user_login']?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                            <li><a class="dropdown-item" href="?page=profile">บัญชีแอดมิน</a></li>
                            <!-- <li><a class="dropdown-item" href="settings.html">Settings</a></li> -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?page=logout">ออกจากระบบ</a></li>
                        </ul>
                    </div><!--//app-user-dropdown--> 
                </div><!--//app-utilities-->
            </div><!--//row-->
            </div><!--//app-header-content-->
        </div><!--//container-fluid-->
    </div><!--//app-header-inner-->
    <div id="app-sidepanel" class="app-sidepanel"> 
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding">
                <a class="app-logo" href="../admin"><img class="logo-icon me-2" src="upload/custom/5.png" alt="logo"> <span class="logo-text">Green Growing</span></a>

            </div><!--//app-branding-->  
            
            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo !isset($_GET['page']) && empty($_GET['page']) ? 'active' : '' ?> " href="../admin">
                            <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 
                                0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            </svg>
                                </span>
                                <span class="nav-link-text">หน้าหลัก</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'report' ? 'active' : '' ?> " href="?page=report">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                    <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v6zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">รายงาน</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'about' ? 'active' : '' ?> " href="?page=about">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                    <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">จัดการข้อมูลเกี่ยวกับเรา</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'user' ? 'active' : '' ?> " href="?page=user">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video2" viewBox="0 0 16 16">
                                    <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" fill="#000"/>
                                    <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2ZM1 3a1 1 0 0 1 1-1h2v2H1V3Zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3H5Zm-4-2h3v2H2a1 1 0 0 1-1-1v-1Zm3-1H1V8h3v2Zm0-3H1V5h3v2Z" fill="#000"/>
                                </svg>
                            </span>
                                <span class="nav-link-text">จัดการข้อมูลสมาชิก</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <?php if($_SESSION['level_login'] == 'super admin' && !empty($_SESSION['level_login'])): ?>
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'admin' ? 'active' : '' ?> " href="?page=admin">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                                    <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                                    <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                                </span>
                                <span class="nav-link-text">จัดการข้อมูลแอดมิน</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <?php endif; ?>
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'bank' ? 'active' : '' ?> " href="?page=bank">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                    <path d="M8 .95 14.61 4h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.379l.5 2A.5.5 0 0 1 15.5 17H.5a.5.5 0 0 1-.485-.621l.5-2A.5.5 0 0 1 1 14V7H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 4h.89L8 .95zM3.776 4h8.447L8 2.05 3.776 4zM2 7v7h1V7H2zm2 0v7h2.5V7H4zm3.5 0v7h1V7h-1zm2 0v7H12V7H9.5zM13 7v7h1V7h-1zm2-1V5H1v1h14zm-.39 9H1.39l-.25 1h13.72l-.25-1z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">จัดการข้อมูลบัญชีธนาคาร</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'producttype' ? 'active' : '' ?> " href="?page=producttype">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tree-fill" viewBox="0 0 16 16">
                                    <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5z"/>
                                </svg>
                                </span>
                                <span class="nav-link-text">จัดการข้อมูลประเภทต้นไม้</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'product' ? 'active' : '' ?> " href="?page=product">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tree" viewBox="0 0 16 16">
                                    <path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5zM6.437 4.758A.5.5 0 0 0 6 4.5h-.066L8 1.401 10.066 4.5H10a.5.5 0 0 0-.424.765L11.598 8.5H11.5a.5.5 0 0 0-.447.724L12.69 12.5H3.309l1.638-3.276A.5.5 0 0 0 4.5 8.5h-.098l2.022-3.235a.5.5 0 0 0 .013-.507z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">จัดการข้อมูลต้นไม้</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'product_size' ? 'active' : '' ?> " href="?page=product_size">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
                                    <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">จัดการข้อมูลขนาดต้นไม้</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'article_type' ? 'active' : '' ?> " href="?page=article_type">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                    <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">จัดการข้อมูลประเภทบทความ</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'article' ? 'active' : '' ?> " href="?page=article">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">จัดการข้อมูลบทความ</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'information' ? 'active' : '' ?> " href="?page=information">
                            <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                                </span>
                                <span class="nav-link-text">จัดการข้อมูลข่าวสาร</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'contact' ? 'active' : '' ?> " href="?page=contact">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">ข้อมูลการติดต่อ</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'order' ? 'active' : '' ?> " href="?page=order">
                            <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
                                <circle cx="3.5" cy="5.5" r=".5"/>
                                <circle cx="3.5" cy="8" r=".5"/>
                                <circle cx="3.5" cy="10.5" r=".5"/>
                            </svg>
                                </span>
                                <span class="nav-link-text">จัดการข้อมูลการสั่งต้นไม้</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link <?php echo isset($_GET['page']) && ($_GET['page']) == 'payment' ? 'active' : '' ?> " href="?page=payment">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                    <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">จัดการข้อมูลการแจ้งชำระ</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
					    
                </ul><!--//app-menu-->
            </nav><!--//app-nav-->
            <div class="app-sidepanel-footer">
                <nav class="app-nav app-nav-footer">
                </nav>
            </div><!--//app-sidepanel-footer-->
            
        </div><!--//sidepanel-inner-->
    </div><!--//app-sidepanel-->
</header><!--//app-header-->