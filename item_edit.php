<?php 
    require 'backendheader.php';
    require 'db_connect.php';

    $id=$_GET['id'];
    // var_dump($id);
    $sql="SELECT * FROM items WHERE id = :value1";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':value1',$id);
    $stmt->execute();
    $items = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($items);

    $sqlBrand = 'SELECT * FROM brands ORDER BY name';
    $stmtBrand = $conn->prepare($sqlBrand);
    $stmtBrand->execute();
    $brands = $stmtBrand->fetchAll();

    $sqlSub = 'SELECT * FROM subcategories ORDER BY name';
    $stmtSub = $conn->prepare($sqlSub);
    $stmtSub->execute();
    $subcategories = $stmtSub->fetchAll();
    ?>
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Item Form </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="item_list.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="item_update.php" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?= $items['id']?>">
                      <input type="hidden" name="oldprofile" value="<?= $items['photo']?>">
        
                        <div class="form-group row">
                            <label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
                            <div class="col-sm-10">
                                <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Old Photo</a>
                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New Photo</a>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><img src="<?= $items['photo'] ?>" id="showOldphoto" class="img-fluid" style="width: 300px; height:200px"></div>
                          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><input type="file"  id="profile" name="newprofile"></div>
                          
                        </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Item Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="name" value="<?= $items['name'] ?>">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Item Code </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="code" value="<?= $items['codeno'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="profile" class="col-sm-2 col-form-label"> Price </label>
                          <div class="col-sm-10">
                            <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home1" role="tab" aria-controls="nav-home" aria-selected="true">Unit Price </a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile1" role="tab" aria-controls="nav-profile" aria-selected="false">Discount</a>
                              </div>
                          </nav>
                          <div class="tab-content mt-2" id="nav-tabContent">
                              <div class="tab-pane fade show active" id="nav-home1" role="tabpanel" aria-labelledby="nav-home-tab">
                                <input type="text" class="form-control" id="name_id" name="price" value="<?= $items['price'] ?>">
                              </div>
                              <div class="tab-pane fade" id="nav-profile1" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <input type="text" class="form-control" id="name_id" name="discount" value="<?= $items['discount'] ?>">
                                
                              </div>
                          </div>
                          </div>
                         </div>

                         <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label"> Description </label>
                              <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="description" id="description" ><?= $items['description']?></textarea>
                              </div>
                          </div>

                          <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label"> Brand </label>
                              <div class="col-sm-10">
                                <select class="form-control" name="brandid">
                                  <option disabled="">Choose Brand</option>
                                  <?php
                                  foreach ($brands as $brand ) {
                                       $id=$brand['id'];
                                       $name=$brand['name'];
                                       if ($items['brand_id']==$id) {        
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
                            <label for="address" class="col-sm-2 col-form-label"> Subcategory </label>
                              <div class="col-sm-10">
                                <select class="form-control" name="subcategoryid">
                                  <option disabled="">Choose Subcategory</option>
                                   <?php
                                  foreach ($subcategories as $subcategory ) {
                                       $id=$subcategory['id'];
                                       $name=$subcategory['name'];
                                       if ($items['subcategory_id']==$id) {        
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