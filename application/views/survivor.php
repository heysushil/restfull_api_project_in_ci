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
        <div class="row show-message"></div>
        <div class="row">
            <div class="col-md-1">
                <label for="">All Survivours & Locations</label>
                <a href="#allSurvivoursModal" data-bs-toggle="modal" data-bs-target="#allSurvivoursModal">
                <img src="https://cdn.dribbble.com/users/2319552/screenshots/7045247/media/70ceaeedab3ba3d92f7287f21a5cf4b6.gif" height="100" alt="">
                </a>
                <label for="">Inventory</label>
                <a href="#inventoryDataModal" data-bs-toggle="modal" data-bs-target="#inventoryDataModal">
                    <img src="https://i.gifer.com/2oje.gif" height="100" alt="">                
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
                <label for="">Reports</label>
                <a href="#reportsModal" data-bs-toggle="modal" data-bs-target="#reportsModal">
                    <img src="https://i.pinimg.com/originals/da/c7/13/dac71367c46f3f6cb5fb3cefbe305917.gif" height="100" alt="">                
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
                <div class="row">
                    <p class="alert alert-danger">
                        Note: Marked: Click to update survivour as infected or not. |
                        Update: Click to update survivour location. |
                        Delete: Click to delete survivour.
                    </p>
                </div> 
                <div class="row show-modal-message"></div>
                <div class="row update-location-form"></div>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Marketd</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($survivour != null){
                                $i = 1;
                                foreach($survivour->result as $key => $value){
                                
                        ?>
                        <tr id="addNewRow_<?=$value->id?>">
                            <th scope="row"><?=$i;$i++;?></th>
                            <td><?=$value->name?></td>
                            <td><?=$value->age?></td>
                            <td><?=$value->gender?></td>
                            <td><?=$value->latitude?></td>
                            <td><?=$value->longitude?></td>
                            <td><a href="#" onclick="updateSurvivourInfectedReport(<?=$value->id?>,<?=$value->flag?>)"><?=$value->flag == 0 ? '<span class="btn btn-sm btn-success">Not Infected</span>' : '<span class="btn btn-sm btn-danger">Infected</span>'?></a></td>
                            <td><button type="button" data-bs-toggle="modal" data-bs-target="#updateServivalLocationModal" class="btn btn-sm btn-warning location-update-button" onclick="updateSurvivorLocation(<?=$value->id?>)">Location</button></td>
                            <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteSurvivor(<?=$value->id?>)">Delete</button></td>
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

    <!-- #updateServivalLocationModal -->
    <div class="modal fade" id="updateServivalLocationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Update Survivor Location</h5>                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="updateSurvivourLocation" method="post">
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude" required>
                        <input type="hidden" id="get-id-for-location-update" name="id">
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

    <!-- #showInventoryDataModal -->
    <div class="modal fade" id="inventoryDataModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="inventoryDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inventoryDataModalLabel">Show Survivor's Inventroy Report</h5>                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Water</th>
                        <th scope="col">Food</th>
                        <th scope="col">Medication</th>
                        <th scope="col">Ammunition</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($inventory != null){
                                $i = 1;
                                foreach($inventory->result as $key => $value){
                                // echo $value->name;
                                // echo '<pre>';print_r($value);
                        ?>
                        <tr id="addNewRow_<?=$value->id?>">
                            <th scope="row"><?=$i;$i++;?></th>
                            <td><?=$value->name?></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?=$value->water?>%;" aria-valuenow="<?=$value->water?>" aria-valuemin="0" aria-valuemax="100"><?=$value->water?>%</div>
                                </div>    
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?=$value->food?>%;" aria-valuenow="<?=$value->food?>" aria-valuemin="0" aria-valuemax="100"><?=$value->food?>%</div>
                                </div>   
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?=$value->medication?>%;" aria-valuenow="<?=$value->medication?>" aria-valuemin="0" aria-valuemax="100"><?=$value->medication?>%</div>
                                </div>    
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?=$value->ammunition?>%;" aria-valuenow="<?=$value->ammunition?>" aria-valuemin="0" aria-valuemax="100"><?=$value->ammunition?>%</div>
                                </div>
                            </td>
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

    <!-- #reportsModal -->
    <div class="modal fade" id="reportsModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="reportsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title" id="reportsModalLabel">Reports</h5>
                
                <button type="button" data-bs-toggle="modal" data-bs-target="#List-of-infected-survivors" class="btn btn-primary ms-3">List of infected survivors</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#List-of-non-infected-survivors" class="btn btn-primary ms-3">List of non-infected survivors</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row show-modal-message"></div>
                <div class="row update-location-form"></div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="bg-warning">Total Survivours: <b class="btn btn-sm btn-primary"><?=count((array) $infected->result) + count((array) $noninfected->result);?></b></td>
                        </tr>
                        <tr class="bg-danger">
                            <td>Total Infected Survivours: <b class="btn btn-sm btn-primary"><?=count((array) $infected->result);?></b></td>
                        </tr>
                        <tr class="bg-success">
                            <td>Total Non-Infected Survivours: <b class="btn btn-sm btn-primary"><?=count((array) $noninfected->result);?></b></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">                    
                    <tr>
                        <td>
                            <p class="alert alert-danger">Total Infected Survivours Percentage</p>
                            <?php
                                $totalSurvivor = count((array) $infected->result) + count((array) $noninfected->result);
                                $infected = count((array) $infected->result);
                                $infectedPercentage = ($infected / $totalSurvivor) * 100;
                                // echo '<p class="alert alert-primary">'. $infectedPercentage .'</p>';
                            ?>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$infectedPercentage?>%;" aria-valuenow="<?=$infectedPercentage?>" aria-valuemin="0" aria-valuemax="100"><?=$infectedPercentage?>%</div>
                            </div> 
                        </td>
                        <td>
                            <p class="alert alert-success">Total Infected Survivours Percentage</p>
                            <?php
                                $noninfected = count((array) $noninfected->result);
                                $noninfectedPercentage = ($noninfected / $totalSurvivor) * 100;
                                // echo '<p class="alert alert-primary">'. $noninfectedPercentage .'</p>';
                            ?>                            
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?=$noninfectedPercentage?>%;" aria-valuenow="<?=$noninfectedPercentage?>" aria-valuemin="0" aria-valuemax="100"><?=$noninfectedPercentage?>%</div>
                            </div> 
                        </td>
                    </tr>        
                </table>
                <table class="table">  
                    <tr>
                        <td class="bg-info">Total Robots: <b class="btn btn-sm btn-primary"><?=$robots['Land'];?></b></td>                            
                    </tr>       
                </table>
                <table class="table">                    
                    <tr>
                        <td>
                            <p class="alert alert-danger">Flying Robots: <b class="btn btn-sm btn-primary"><?=$robots['Flying'];?></b></p>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$robots['Flying'];?>%;" aria-valuenow="<?=$robots['Flying'];?>" aria-valuemin="0" aria-valuemax="100"><?=$robots['Flying'];?>%</div>
                            </div> 
                        </td>
                        <td>
                            <p class="alert alert-success">Land Robots: <b class="btn btn-sm btn-primary"><?=$robots['Land'];?></b></p>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?=$robots['Land'];?>%;" aria-valuenow="<?=$robots['Land'];?>" aria-valuemin="0" aria-valuemax="100"><?=$robots['Land'];?>%</div>
                            </div> 
                        </td>
                    </tr>        
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- #List-of-infected-survivors -->
    <div class="modal fade" id="List-of-infected-survivors" data-bs-backdrop="static" tabindex="-1" aria-labelledby="List-of-infected-survivorsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title" id="List-of-infected-survivorsModalLabel">List-of-infected-survivors</h5>
                
                <button type="button" data-bs-toggle="modal" data-bs-target="#reportsModal" class="btn btn-primary ms-3">Back to Reposts</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row show-modal-message"></div>
                <div class="row update-location-form"></div>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($survivour != null){
                                $i = 1;
                                
                                foreach($survivour->result as $key => $value){
                                    if($value->flag == 0){
                        ?>
                        <tr id="addNewRow_<?=$value->id?>" class="bg-danger">
                            <th scope="row"><?=$i;$i++;?></th>
                            <td><?=$value->name?></td>
                            <td><?=$value->age?></td>
                            <td><?=$value->gender?></td>
                            <td><?=$value->latitude?></td>
                            <td><?=$value->longitude?></td>
                        </tr>
                        <?php
                                } // end if condtion
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

    <!-- #List-of-non-infected-survivors -->
    <div class="modal fade" id="List-of-non-infected-survivors" data-bs-backdrop="static" tabindex="-1" aria-labelledby="List-of-non-infected-survivorsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title" id="List-of-non-infected-survivorsModalLabel">List-of-non-infected-survivors</h5>
                
                <button type="button" data-bs-toggle="modal" data-bs-target="#reportsModal" class="btn btn-primary ms-3">Back to Reposts</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row show-modal-message"></div>
                <div class="row update-location-form"></div>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($survivour != null){
                                $i = 1;
                                
                                foreach($survivour->result as $key => $value){
                                    if($value->flag == 1){
                        ?>
                        <tr id="addNewRow_<?=$value->id?>" class="bg-success">
                            <th scope="row"><?=$i;$i++;?></th>
                            <td><?=$value->name?></td>
                            <td><?=$value->age?></td>
                            <td><?=$value->gender?></td>
                            <td><?=$value->latitude?></td>
                            <td><?=$value->longitude?></td>
                        </tr>
                        <?php
                                } // end if condtion
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

   


    <!-- Scrip code to send the data -->
    <script>
        var base_url = '<?=base_url();?>';
        var survivour_api_path = 'http://localhost/restfull_api_project_in_ci/survivour_api/';

        // Add new survivour data
        $('#addNewSurvivor').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: survivour_api_path + 'survivour_form_data/',
                type:'post',
                dataType: 'json',
                data:new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response){
                    if(response.success != null){
                        $('.show-message').html('<p class="alert alert-success">'+response.success+'</p>');
                        $('#addNewServivalModal').modal('hide').hide('slow').delay(3000).fadeOut(300);
                    }else{
                        $('.show-message').html('<p class="alert alert-error">'+response.error+'</p>');
                    }
                },
                complete: function(response){
                    $('#allSurvivoursModal').load(' #allSurvivoursModal > *');
                    $('#inventoryDataModal').load(' #inventoryDataModal > *');
                    $('#allSurvivoursModal').modal('show');
                }
            });
        });

        // Delete a survivour
        function deleteSurvivor(id){
            $.ajax({
                url: survivour_api_path + 'survivour_dead/',
                type:'post',
                dataType: 'json',
                data: {id:id},
                success: function(response){
                    if(response.success != null){
                        $('.show-modal-message').html('<p class="alert alert-success">'+response.success+'</p>');
                        // $('#addNewServivalModal').modal('hide').hide('slow').delay(3000).fadeOut(300);
                    }else{
                        $('.show-modal-message').html('<p class="alert alert-error">'+response.error+'</p>');
                    }
                },
                complete: function(response){
                    $('#allSurvivoursModal').load(' #allSurvivoursModal > *');
                    $('#inventoryDataModal').load(' #inventoryDataModal > *');
                }
            });
        }

        function updateSurvivourInfectedReport(id,flag){
            $.ajax({
                url: survivour_api_path + 'survivour_flag_infected/',
                type:'post',
                dataType: 'json',
                data: {id:id, flag: flag},
                success: function(response){
                    if(response.success != null){
                        $('.show-modal-message').html('<p class="alert alert-success">'+response.success+'</p>');
                        // $('#addNewServivalModal').modal('hide').hide('slow').delay(3000).fadeOut(300);
                    }else{
                        $('.show-modal-message').html('<p class="alert alert-error">'+response.error+'</p>');
                    }
                },
                complete: function(response){
                    $('#allSurvivoursModal').load(' #allSurvivoursModal > *');
                    $('#inventoryDataModal').load(' #inventoryDataModal > *');
                }
            });
        }

        // Update surviviour location
        // var count=1;
        // function updateSurvivorLocation(id){
        //     console.log(count);
        //     if(count > 0){
        //         $('.location-update-button').attr('disabled',true);
        //     }
        //     var newTR = '<form class="row g-3" action="" id="updateSurvivourLocation" method="post"> <div class="col-auto"> <input type="text" class="form-control" name="latitude" placeholder="Enter Latitude" required> <input type="hidden" name="id" value="'+id+'"> </div><div class="col-auto"> <input type="text" class="form-control" name="longitude" placeholder="Enter Longitude" required> </div><div class="col-auto"> <input type="submit" class="btn btn-sm btn-primary" value="Update"> </div></form>';
        //     // $('table tbody').append(newTR);
        //     $('.update-location-form').after(newTR);
        //     count++;
        // }
        function updateSurvivorLocation(id){
            $('#get-id-for-location-update').attr('value',id);
        }

        // Send data to api
        $('#updateSurvivourLocation').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: survivour_api_path + 'survivour_location_update/',
                type:'post',
                dataType:'json',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(response){
                    console.log(response);
                    if(response.success != null){
                        $('.show-message').html('<p class="alert alert-success">'+response.success+'</p>');
                        $('#updateServivalLocationModal').modal('hide').hide('slow').delay(3000).fadeOut(300);
                    }else{
                        $('.show-message').html('<p class="alert alert-error">'+response.error+'</p>');
                    }
                },
                complete: function(response){
                    $('#allSurvivoursModal').load(' #allSurvivoursModal > *');
                    $('#inventoryDataModal').load(' #inventoryDataModal > *');
                    $('#allSurvivoursModal').modal('show');
                }            
            })
        })
    </script>
</body>
</html>