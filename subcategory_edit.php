<?php 
    require 'backendheader.php';
    require 'db_connect.php';

    $id1= $_GET['id'];
    
    $sql="SELECT * FROM subcategories WHERE id = :value1";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':value1',$id1);
    $stmt->execute();

    $subcategories = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($subcategories);

    $sql1 = 'SELECT * FROM categories ORDER BY name';
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $subcat1 = $stmt1->fetchAll();       

?>
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Sub Category Edit</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="subcategory_list.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="subcategory_update.php" method="POST"  >
                        <input type="hidden" name="id" value="<?= $subcategories['id']?>">
                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="name" value="<?= $subcategories['name'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo_id" class="col-sm-2 col-form-label"> Category </label>
                            <div class="col-sm-10">
                              <select class="form-control" name="categoryid">
                                  <option disabled="">Choose Category</option>
                                  <?php
                                  foreach ($subcat1 as $subcat ) {
                                       $id=$subcat['id'];
                                       $name=$subcat['name'];
                                       if ($subcategories['category_id']==$id) {        
                                           ?>
                                           <option value="<?= $id ?>" selected><?= $name ?></option>
                                        <?php } else {
                                            ?>
                                           <option value="<?= $id ?>"><?= $name ?></option>
                                       <?php } ?>
                                <?php } ?>                     
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icofont-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
    require 'backendfooter.php';
?>