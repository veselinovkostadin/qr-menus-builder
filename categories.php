<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BS icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        #submitBtn {
            position: absolute;
            bottom: 0px;
        }
    </style>
</head>

<body>

    <div class="container-lg mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-12 text-lg-start text-center" style='position:relative'>
                <h2>Enter your primary menu categories:</h2>
                <form action="database.php" method="POST">

                    <label for="category0" class='form-label'>Category:</label>
                    <input type="text" class='form-control' placeholder='Enter category' name='category0' id='category0' required>
                    <button type='submit' class='btn btn-success mx-auto my-2' id='submitBtn'>Submit</button>

                </form>
                <button id='moreBtn' class='btn btn-primary my-5'>Add more</button>
            </div>
        </div>
    </div>


    <div class='modal fade' id='myModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to create this categories?
                    <ul id='modalList'>
                    </ul>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='button' class='btn btn-primary' id='submit'>Submit</button>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</body>

</html>