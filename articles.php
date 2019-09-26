<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 20/09/2019
 * Time: 17:37
 */

require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_six();

include_once 'includes/connextionBD.php';
include_once 'api/objects/Category.php';


$db = connextionBD::getInstance();
$cat = new Category($db);
if(isset($_GET['delID'])){
    $cat->id=$_GET['delID'];
    $cat->delete();
}
if (isset($_POST['cat'])) {
    $cat->cat = $_POST['cat'];
    $cat->addOne();
}
$stmt = $cat->getAll();

?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($stmt->rowCount() === 0) {
        ?>
        <tr>
            <td>no data available
        </tr>
        <?php
    } else {
        while ($row = $stmt->fetch()) {
            $cat->id = $row['id'];
            $cat->cat = $row['cat'];
            ?>
            <tr>
                <td><?php echo $cat->id ?></td>
                <td><?php echo $cat->cat ?></td>
                <td>
                    <a class="btn btn-info"
                       href="article.php?idC=<?php echo $cat->id?>">
                        Articles
                    </a>
                    <a class="btn btn-danger" onclick="return confirmDel()" href="articles.php?delID=<?php echo $cat->id;?>">
                        <i class="halflings-icon white trash"></i>
                    </a>
                </td>
            </tr>

            <?php
        }
    }
    ?>
    <tr>
        <td>
            <a class="btn btn-info" href="#myModal" role="button" data-toggle="modal">
                Add category
            </a>
        </td>
    </tr>
    </tbody>
</table>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">add category</h3>
    </div>
    <form action="" method="post">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="focusedInput">category</label>
                <div class="controls">
                    <input class="input-xlarge focused" name="cat" id="focusedInput" required type="text"
                           placeholder="category"
                    >
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-primary">add category</button>
        </div>
    </form>
</div>
<?php
get_footer();
?>
