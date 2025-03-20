<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin.js"></script>

    <style>
        .header, .l-navbar {
            margin-bottom: 20px;
        }

        .container {
            padding-bottom: 0;
        }

        .height-100 {
            height: auto !important;
        }
    </style>
</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="assets/images/bb1_logo.png" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">ResponseSystem</span> </a>
                <div class="nav_list"> 
                   
                   
                    <a href="message_section.php" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span> </a>
                    <a href="received_contact_form.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a>  
                    <a href="about_us.php" class="nav_link active"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> 
                     
                </div>
            </div> 
            <form method="post" action="logout.php" style="display: inline;">
                <button type="submit" name="logout" class="nav_link" style="border: none; background: none;">
                    <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
                </button>
            </form>
        </nav>
    </div>
    
    <br><br><br><br>
    <section class="py-5">
        <div class="container">
            <div class="row gx-4 align-items-center justify-content-between">
                <div class="col-md-5 order-2 order-md-1">
                    <div class="mt-5 mt-md-0">
                        <span class="text-muted">Our Story</span>
                        <h2 class="display-5 fw-bold">Tungkol sa Amin</h2>
                        <p class="lead">Kami ay isang komunidad sa Barangay Bagong Buhay 1, San Jose del Monte, Bulacan. 
                            Sa aming barangay, layunin naming itaguyod ang pagkakaisa, pag-unlad, at kapayapaan sa lahat ng aspeto ng buhay. 
                            Pinagsisikapan naming magbigay ng suporta at serbisyo para sa kapakanan ng bawat miyembro ng komunidad. 
                            Sa aming patuloy na paglago, umaasa kami na makapagtatag ng mas matibay na ugnayan at makapagbigay ng positibong pagbabago sa aming lugar. 
                            Ang aming barangay ay bukas sa lahat ng nais makiisa at makibahagi sa aming mga proyekto at aktibidad.
                            Malugod namin kayong tinatanggap sa aming munting komunidad.</p>
                        
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 order-1 order-md-2">
                    <div class="row gx-2 gx-lg-3">
                        <div class="col-6">
                            <div class="mb-2"><img class="img-fluid rounded-3" src="assets/images/bb1_photo1.jpg" alt="Image"></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2"><img class="img-fluid rounded-3" src="assets/images/bb1_photo2.jpg" alt="Image"></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2"><img class="img-fluid rounded-3" src="assets/images/bb1_photo3.jpg" alt="Image"></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2"><img class="img-fluid rounded-3" src="assets/images/bb1_photo4.jpg" alt="Image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Container Main start-->
    <div class="height-100 bg-light"></div>
    <!--Container Main end-->
</body>
</html>
