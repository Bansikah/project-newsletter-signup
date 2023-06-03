<?php
include'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    -->
    <!-- Bootstrap offline    -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>News Letter Signup</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Project</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="export.php">Export</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="signup-box">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <form action="ajax.php" method="post" class="form_newsletter">
                        <div class="mb-3">
                            <label for="" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="email" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe Newsletter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.0.min.js"></script>

<script>
(function($){

    "use strict";
    
    $(document).ready(function(){
    
        $(".form_newsletter").on('submit', function(e){
          e.preventDefault();

          let formData = new FormData(this);
          let form = this;
          
          $.ajax({
            url: this.action,
            type: 'POST',
            data: formData,
            success: function(data){
                data = JSON.parse(data);
                if(data.error_message){
                    alert(data.error_message);
                }
                else{
                    form.reset();
                    alert(data.success_message);
                }
            },
            cache:false,
            contentType:false,
            processData:false
          });

        });
    });

})(jQuery);

</script>

    <!-- Script Files -->
    <!-- Script files offline -->
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script> -->
</body>

</html>
this project was built by Tandap Noel Bansikah