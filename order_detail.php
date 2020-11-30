<?php 
    require "backendheader.php";
    require 'db_connect.php';

    $id=$_GET['id'];
    //var_dump($id);
    $sql="SELECT u.name as uname,u.email as uemail,u.address as uaddress,u.phone as uphone,o.orderdate as odate,o.voucherno as ovoucher,o.id as oid,o.total as ototal
      FROM orders as o INNER JOIN users as u ON u.id=o.user_id WHERE o.id=:value1";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':value1',$id);
    $stmt->execute();
    $detail=$stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($detail['odate']);


    $sqlNew="SELECT io.*,u.name as uname,u.email as uemail,u.address as uaddress,u.phone as uphone,o.orderdate as odate,o.voucherno as ovoucher,o.id as oid,i.name as iname,i.codeno as icode,i.description as idesc,i.discount as idiscount,i.price as iprice
      FROM item_order as io INNER JOIN orders as o ON o.id=io.order_id
      INNER JOIN users as u ON u.id=o.user_id INNER JOIN items as i ON i.id=io.item_id WHERE o.id=:value1" ;
    $stmt=$conn->prepare($sqlNew);
    $stmt->bindParam(':value1',$id);
    $stmt->execute();
    $detailNew=$stmt->fetchAll();
?>
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> Shopules</h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right"><?= $detail['odate'] ?></h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong>Shoples</strong><br>518 Than Street<br>Hlaing Township<br>Yangon<br>Email: admin@gmail.com</address>
                </div>
                <div class="col-4">To
                  <address><strong><?= $detail['uname'] ?></strong><br><?= $detail['uaddress'] ?><br>Phone: <?= $detail['uphone'] ?><br>Email: <?= $detail['uemail'] ?></address>
                </div>
                <div class="col-4"><b>Invoice <?= $detail['ovoucher'] ?></b><br><br><b>Order ID:</b> <?= $detail['oid'] ?><br><b>Payment Due:</b> 2/22/2014<br><b>Account:</b> 968-34567</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Product</th>                                         
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $i=1;
                        foreach ($detailNew as $det) {
                          $qty=$det['qty'];
                          $name=$det['iname'];
                          $code=$det['icode'];
                          $description=$det['idesc'];
                          $discount=$det['idiscount'];
                          $price=$det['iprice'];
                          $priceAmt=$price-$discount;
                          $subprice=($price-$discount)*$qty;
                      ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $name ?></td>
                        <td><?= $code ?></td>
                        <td><?= $description ?></td>
                        <td><?= $qty ?></td>
                        <td><?= $priceAmt ?></td>
                        <td><?= $subprice ?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="6" align="center">
                          Total Amount
                        </td>
                        <td  >
                          <?= $detail['ototal']  ?>
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
     <?php require "backendfooter.php" ?>