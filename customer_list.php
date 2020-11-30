<?php 
    require 'backendheader.php';

    require 'db_connect.php';

    $sql="SELECT * FROM users as u INNER JOIN model_has_roles as m ON m.user_id=u.id WHERE m.role_id=2;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $users =$stmt->fetchAll();
?>
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Customer </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Contact</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 $i=1;
                                 foreach ($users as $user) {
                                     $id=$user['id'];
                                     $name=$user['name'];
                                     $phone=$user['phone'];
                                                                    
                                 ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $phone ?></td>
                                    <td>
                                        <a href="" class="btn btn-outline-danger">
                                            <i class="icofont-close"></i>
                                        </a>
                                    </td>

                                </tr>

                                <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
    require 'backendfooter.php';
?>