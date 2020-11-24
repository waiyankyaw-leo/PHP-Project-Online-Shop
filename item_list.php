<?php 
    require 'backendheader.php';
    require 'db_connect.php';
    $sql='SELECT i.*, b.name as brand, s.name as subcategory FROM items as i 
        INNER JOIN brands as b ON i.brand_id=b.id 
        INNER JOIN subcategories  as s ON i.subcategory_id=s.id';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $items = $stmt->fetchAll();   
?>
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Item </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="item_new.php" class="btn btn-outline-primary">
                <i class="icofont-plus"></i>
            </a>
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
                                  <th>Item Code</th>
                                  <th>Brand</th>
                                  <th>Category</th>
                                  <th>Price</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i=1;
                                    foreach ($items as $item) {
                                    $id=$item['id'];
                                    $codeno=$item['codeno'];
                                    $description=$item['description'];
                                    $brand=$item['brand'];
                                    $price=$item['price'];
                                    $photo=$item['photo'];
                                    $name=$item['name'];
                                    $code=$item['codeno'];
                                    $category=$item['subcategory'];
                                    $discount=$item['discount'];
                                    if ($discount< 1 ) {
                                        $oldprice=null;
                                    }
                                    else{
                                        $oldprice=$price;
                                    }
                                    
                                 ?>
                                <tr>
                                    <td> <?= $i++ ?> </td>
                                    <td><div class="d-flex"> 
                                        <img src="<?= $photo; ?>" style="width: 100px; height: 100px;"  >
                                        
                                        <div class="ml-3">
                                            <h5><?= $name ?></h5>
                                            <p><?= $description ?></p>
                                        </div>
                                        </div>
                                    </td>
                                    <td> <?= $code ?> </td>
                                    <td> <?= $brand ?> </td>
                                    <td> <?= $category ?> </td>
                                    <td> <?= $price-$discount ?>MMK <br>
                                    <?php 
                                         if ($discount< 1 ) {
                                        $oldprice=null;
                                    }
                                    else{
                                        $oldprice=$price;
                                        echo "<small><strike>".$oldprice. "MMK</strike></small>";
                                    }
                                    ?>
                                        
                                    </td>
                                    <td>
                                        <a href="item_edit.php?id=<?= $id ?>" class="btn btn-warning">
                                            <i class="icofont-ui-settings"></i>
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