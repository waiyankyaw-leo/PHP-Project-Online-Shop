<?php 
    require 'backendheader.php';
    require 'db_connect.php';

    $sqlSub="SELECT * FROM subcategories ORDER BY name";
    $stmt = $conn->prepare($sqlSub);
    $stmt->execute();

    $sqlBrand="SELECT * FROM brands ORDER BY name";
    $stmt1 = $conn->prepare($sqlBrand);
    $stmt1->execute();

    $subcategories =$stmt->fetchAll();
    $brands =$stmt1->fetchAll();
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
                    <form action="item_add.php" method="POST" enctype="multipart/form-data">
        
                        <div class="form-group row">
                            <label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
                            <div class="col-sm-10">
                              <input type="file" id="photo_id" name="photo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Item Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="name">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Item Code </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="code">
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="profile" class="col-sm-2 col-form-label"> Price </label>
                          <div class="col-sm-10">
                            <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Unit Price </a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Discount</a>
                              </div>
                          </nav>
                          <div class="tab-content mt-2" id="nav-tabContent">
                              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <input type="text" class="form-control" id="name_id" name="price">
                              </div>
                              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <input type="text" class="form-control" id="name_id" name="discount" value="0">
                                
                              </div>
                          </div>
                          </div>
                         </div>

                         <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label"> Description </label>
                              <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="description" id="description"></textarea>
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
                                    
                                  ?>
                                  <option value="<?= $id ?>"><?= $name ?></option>
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
                                    
                                  ?>
                                  <option value="<?= $id ?>"><?= $name ?></option>
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