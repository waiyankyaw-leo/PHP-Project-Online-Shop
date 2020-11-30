<?php 
    require 'backendheader.php';
    require 'db_connect.php';
    $sql="SELECT * FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $orders =$stmt->fetchAll();
?>
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Order </h1>
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
                                  <th>Date</th>
                                  <th>Voucher No</th>
                                  <th>Total</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $i=1;
                                  foreach ($orders as $order) {
                                     $oDate=$order['orderdate'];
                                     $voucherno=$order['voucherno'];
                                     $total=$order['total'];
                                     $status=$order['status'];
                                     $id=$order['id'];
                                  

                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $oDate ?></td>
                                    <td><?= $voucherno ?></td>
                                    <td><?= $total ?></td>
                                    <td><?= $status ?></td>
                                    <td>
                                        <a href="order_detail.php?id=<?= $id  ?>" class="btn btn-outline-info">
                                            <i class="icofont-info"></i>
                                        </a>
                                        <a href="" class="btn btn-outline-success">
                                           <i class="icofont-verification-check"></i>
                                        </a>

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