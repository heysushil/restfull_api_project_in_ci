<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$page_title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
                <label for="">All Survivours</label>
                <a href="#allSurvivoursModal" data-bs-toggle="modal" data-bs-target="#allSurvivoursModal">
                <img src="https://cdn.dribbble.com/users/2319552/screenshots/7045247/media/70ceaeedab3ba3d92f7287f21a5cf4b6.gif" height="100" alt="">
                </a>
                <label for="">Location Update</label>
                <a href="#locationUpdateModal" data-bs-toggle="modal" data-bs-target="#locationUpdateModal">
                <img src="https://cliply.co/wp-content/uploads/2019/03/371903340_LOCATION_MARKER_400.gif" height="100" alt="">
                </a>
            </div>
            <div class="col-md-3">
                <img src="https://cdn.gamedevmarket.net/wp-content/uploads/20191203193614/da1ef18bfc525a2118a1a4cd4e5c8ee230245b79.gif" width="400" alt="">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <img src="https://i.gifer.com/Omve.gif" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <label for="">Inventory</label>
                <a href="#inventoryModal" data-bs-toggle="modal" data-bs-target="#inventoryModal">
                <img src="https://i.gifer.com/2oje.gif" height="100" alt="">                
                </a>
                <label for="">Robot Details</label>
                <a href="#robotDetailsModal" data-bs-toggle="modal" data-bs-target="#robotDetailsModal">
                <img src="https://images.squarespace-cdn.com/content/v1/56107ffae4b09e1a44edaa22/1536128958717-02YGE5QSB91P1SUT3PI0/13_Angry_Loop.gif" height="100" alt="">
                </a>
            </div>
            <div class="col-md-3">
                <img src="https://i.pinimg.com/originals/1a/e7/53/1ae75336c051202a09eb2c841c588a20.gif" width="400" alt="">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <img src="https://i.gifer.com/7Bj1.gif" alt="">
            </div>
        </div>
    </div>

    <!-- #allSurvivoursModal -->
    <div class="modal fade" id="allSurvivoursModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">All Servivours List</h5>
                
                <button type="button" data-bs-toggle="modal" data-bs-target="#addNewServivalModal" class="btn btn-primary ms-3">Add New Survivour</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($survivour != null){
                                $i = 1;
                                foreach($survivour->result as $key => $value){
                                
                        ?>
                        <tr>
                            <th scope="row"><?=$i;$i++;?></th>
                            <td><?=$value->name?></td>
                            <td><?=$value->age?></td>
                            <td><?=$value->gender?></td>
                            <td><?=$value->latitude?></td>
                            <td><?=$value->longitude?></td>
                            <td><button type="button" class="btn btn-sm btn-danger">Delete</button></td>
                        </tr>
                        <?php
                            } //end foreach
                        }else{ //end if condition
                            echo '<tr>No data available.</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- #addNewServivalModal -->
    <!-- data-bs-backdrop="static" -->
    <div class="modal fade" id="addNewServivalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Survivor</h5>                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="addNewSurvivor" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" placeholder="Enter Gender" required>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="form-control" value="Submit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <!-- Scrip code to send the data -->
    <script>
        var base_url = '<?=base_url();?>';

        // Add new survivour data
        $('#addNewSurvivor').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: base_url + 'welcome/addNewSurvivor_formData/',
                type:'post',
                dataType: 'json',
                data:new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response){
                    console.log(response);
                }
            });
        });
    </script>
</body>
</html>