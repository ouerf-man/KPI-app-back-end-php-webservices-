<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 19/09/2019
 * Time: 21:04
 */


$table = $_GET['table'];
$id = $_GET['id'];


require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_four();
if(!isset($_GET['txt'])){
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span>Update deputie data</h2>
            <div class="box-icon">
                <a href="users.php" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="actions/valuesTest.php">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">value:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" name="val" id="focusedInput" required type="number"
                                   placeholder="0.0"  step="0.01" min="0" max="100"
                                   value="">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" onclick="return confirmUpdate()" class="btn btn-primary">Save Changes
                        </button>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="table" value="<?php echo $table; ?>">

                </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->
<?php
}else{
    ?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span>Update deputie data</h2>
            <div class="box-icon">
                <a href="users.php" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="post" action="actions/add_value_confirmation.php">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">month:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" name="month" id="focusedInput" required type="text"
                                   placeholder="month" pattern="[0-9]{4}-[0-9]{2}"
                            >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">value:</label>
                        <div class="controls">
                            <input class="input-xlarge focused" name="val" id="focusedInput" required type="text"
                                   placeholder="Parti politique"
                                   value="">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" onclick="return confirmUpdate()" class="btn btn-primary">Save Changes
                        </button>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="table" value="<?php echo $table; ?>">

                </fieldset>
            </form>

        </div>
    </div><!--/span-->
<?php
}
get_footer();
?>
