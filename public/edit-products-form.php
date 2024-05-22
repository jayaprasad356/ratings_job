<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php

if (isset($_GET['id'])) {
	$ID = $db->escapeString($_GET['id']);
} else {
	// $ID = "";
	return false;
	exit(0);
}
if (isset($_POST['btnEdit'])) {

    $name = $db->escapeString(($_POST['name']));
    $image = $db->escapeString(($_POST['image']));
    $review = $db->escapeString(($_POST['review']));
    $plan_id = $db->escapeString(($_POST['plan_id']));
	$error = array();

{

$sql_query = "UPDATE products SET name='$name',image='$image',review='$review',plan_id='$plan_id' WHERE id =  $ID";
$db->sql($sql_query);
$update_result = $db->getResult();
if (!empty($update_result)) {
   $update_result = 0;
} else {
   $update_result = 1;
}

// check update result
if ($update_result == 1) {
   $error['update_jobs'] = " <section class='content-header'><span class='label label-success'>Products updated Successfully</span></section>";
} else {
   $error['update_jobs'] = " <span class='label label-danger'>Failed to Update</span>";
}
}
}


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM products WHERE id = $ID";
$db->sql($sql_query);
$res = $db->getResult();


if (isset($_POST['btnCancel'])) { ?>
<script>
window.location.href = "products.php";
</script>
<?php } ?>

<section class="content-header">
	<h1>
		Edit Products<small><a href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h1>
	<small><?php echo isset($error['update_jobs']) ? $error['update_jobs'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
    <!-- Main row -->
    <div class="row">
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="add_slide_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Name</label><i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" value="<?php echo $res[0]['name']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">image</label><i class="text-danger asterik">*</i><?php echo isset($error['image']) ? $error['image'] : ''; ?>
                                    <input type="text" class="form-control" name="image" value="<?php echo $res[0]['image']?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Review</label><i class="text-danger asterik">*</i><?php echo isset($error['review']) ? $error['review'] : ''; ?>
                                    <input type="text" class="form-control" name="review" value="<?php echo $res[0]['review']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Select Plan</label> <i class="text-danger asterik">*</i>
                                    <select id='plan_id' name="plan_id" class='form-control'>
                                           <option value="">--Select--</option>
                                                <?php
                                                  $sql = "SELECT id, products FROM `plan`";
                                                $db->sql($sql);

                                                $result = $db->getResult();
                                                foreach ($result as $value) {
                                                ?>
                                                    <option value='<?= $value['id'] ?>' <?= $value['id']==$res[0]['plan_id'] ? 'selected="selected"' : '';?>><?= $value['products'] ?></option>
                                                    
                                                <?php } ?>
                                    </select>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnEdit">Update</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>


<div class="separator"> </div>
<?php $db->disconnect(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>