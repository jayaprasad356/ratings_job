<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php
if (isset($_POST['btnAdd'])) {

        $name = $db->escapeString(($_POST['name']));
        $image = $db->escapeString(($_POST['image']));
        $review = $db->escapeString(($_POST['review']));
        $category = $db->escapeString(($_POST['category']));
        $error = array();
       
        if (empty($name)) {
            $error['name'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($image)) {
            $error['image'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($review)) {
            $error['review'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($category)) {
            $error['category'] = " <span class='label label-danger'>Required!</span>";
        }
       
       
       if (!empty($name) && !empty($image) && !empty($review) && !empty($category)) 
       {
           
            $sql_query = "INSERT INTO products (name,image,review,category)VALUES('$name','$image','$review','$category')";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                
                $error['add_languages'] = "<section class='content-header'>
                                                <span class='label label-success'>Products Added Successfully</span> </section>";
            } else {
                $error['add_languages'] = " <span class='label label-danger'>Failed</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add New Products<small><a href='products.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h1>

    <?php echo isset($error['add_languages']) ? $error['add_languages'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-10">
           
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form url="add-languages-form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                       <div class="row">
                            <div class="form-group">
                                <div class='col-md-6'>
                                    <label for="exampleInputtitle">Name</label> <i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class='col-md-6'>
                                    <label for="exampleInputtitle">Image</label> <i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="image" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-6'>
                                    <label for="exampleInputtitle">Review</label> <i class="text-danger asterik">*</i>
                                    <input type="text" class="form-control" name="review" required>
                                </div>
                                <div class='col-md-6'>
                                    <label for="exampleInputtitle">category</label> <i class="text-danger asterik">*</i>
                                    <select id='correct_option' name="category" class='form-control'>
                                    <option value=''>--select--</option>
                                    <option value='products'>products</option>
                                      <option value='companies'>companies</option>
                                      <option value='sarees'>sarees</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Submit</button>
                        <input type="reset" onClick="refreshPage()" class="btn-warning btn" value="Clear" />
                    </div>

                </form>
                <div id="result"></div>

            </div><!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_leave_form').validate({

        ignore: [],
        debug: false,
        rules: {
        reason: "required",
            date: "required",
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#user_id').select2({
        width: 'element',
        placeholder: 'Type in name to search',

    });
    });

    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>

<!--code for page clear-->
<script>
    function refreshPage(){
    window.location.reload();
} 
</script>

<?php $db->disconnect(); ?>
