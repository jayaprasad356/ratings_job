
<section class="content-header">
    <h1>Products /<small><a href="home.php"><i class="fa fa-home"></i> Home</a></small></h1>
            <ol class="breadcrumb">
                <a class="btn btn-block btn-default" href="add-products.php"><i class="fa fa-plus-square"></i> Add New Products</a>
</ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <div class="row">
                   <div class="col-md-3">
                            <h4 class="box-title">Filter by Plan</h4>
                            <select id='products' name="products" class='form-control'>
                          <option value=''>Select All</option>
                            <?php
                            $sql = "SELECT products FROM `plan` GROUP BY products ORDER BY id"; // Modified to group by 'products' column
                             $db->sql($sql);
                            $result = $db->getResult();
                              foreach ($result as $value) {
                                  ?>
                                 <option value='<?= $value['products'] ?>'><?= $value['products'] ?></option>
                               <?php } ?>
                             </select>
                        </div>
                    </div>
                    <div  class="box-body table-responsive">
                    <table id='users_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=products" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-search="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc" data-show-export="true" data-export-types='["txt","csv"]' data-export-options='{
                            "fileName": "users-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                        <thead>
                                <tr>
                                    <th  data-field="operate" data-events="actionEvents">Action</th>
                                    <th  data-field="id" data-sortable="true">ID</th>
                                    <th  data-field="name" data-sortable="true">Name</th>
                                    <th  data-field="image" data-sortable="true">Image</th>
                                    <th  data-field="review" data-sortable="true">Review</th>
                                    <th  data-field="plan_products" data-sortable="true">Plan Name </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="separator"> </div>
        </div>
    </section>

<script>

    $('#seller_id').on('change', function() {
        $('#products_table').bootstrapTable('refresh');
    });
    $('#community').on('change', function() {
        $('#users_table').bootstrapTable('refresh');
    });
    $('#category').on('change', function() {
    $('#users_table').bootstrapTable('refresh');
});
$('#products').on('change', function() {
        $('#users_table').bootstrapTable('refresh');
    });
  
    function queryParams(p) {
        return {
            "date": $('#date').val(),
            "seller_id": $('#seller_id').val(),
            "community": $('#community').val(),
            "category": $('#category').val(), 
            "products": $('#products').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
    
</script>
