<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php
if (isset($_POST['btnAdd'])) {

        $total_income = $db->escapeString(($_POST['total_income']));
        $plan_id = $db->escapeString(($_POST['plan_id']));
        $total_ratings = $db->escapeString(($_POST['total_ratings']));
        $error = array();
       
        if (empty($total_income)) {
            $error['total_income'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($plan_id)) {
            $error['plan_id'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($total_ratings)) {
            $error['total_ratings'] = " <span class='label label-danger'>Required!</span>";
        }
       
       
       if (!empty($total_income) && !empty($plan_id) && !empty($total_ratings)) 
       {
           
            $sql_query = "INSERT INTO slots (total_income,plan_id,total_ratings)VALUES('$total_income','$plan_id','$total_ratings')";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }

            if ($result == 1) {
                
                $error['add_languages'] = "<section class='content-header'>
                                                <span class='label label-success'>Slots Added Successfully</span> </section>";
            } else {
                $error['add_languages'] = " <span class='label label-danger'>Failed</span>";
            }
            }
        }
?>
<section class="content-header">
    <h1>Add New Slots<small><a href='slots.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Slots</a></small></h1>

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
                            <div class="col-md-6">
                                    <label for="exampleInputEmail1">Select Plan</label><i class="text-danger asterik">*</i><?php echo isset($error['plan_id']) ? $error['plan_id'] : ''; ?>
                                    <select id='plan_id' name="plan_id" class='form-control' required>
                                        <option value="">select</option>
                                        <?php
                                        $sql = "SELECT id,products FROM `plan`";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['id'] ?>'><?= $value['products'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label for="exampleInputtitle">Total Income</label> <i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="total_income" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-6'>
                                    <label for="exampleInputtitle">Total Ratings</label> <i class="text-danger asterik">*</i>
                                    <input type="number" class="form-control" name="total_ratings" required>
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
