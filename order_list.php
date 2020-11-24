<?php 
    require 'backendheader.php';
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
                                
                                <tr>
                                    <td>1</td>
                                    <td>2015-02-12</td>
                                    <td>1921313</td>
                                    <td>150000</td>
                                    <td>Order</td>
                                    <td>
                                        <a href="" class="btn btn-outline-info">
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