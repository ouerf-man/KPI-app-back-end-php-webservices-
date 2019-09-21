<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 20/09/2019
 * Time: 21:41
 */
require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_six();

include_once 'includes/connextionBD.php';
include_once 'api/objects/Article.php';


$db = connextionBD::getInstance();
$art = new Article($db);

$art->cat = $_GET['idC'];
$stmt = $art->getAll();

?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
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
            $art->id = $row['id'];
            $art->title = $row['title'];
            ?>
            <tr>
                <td><?php echo $art->id ?></td>
                <td><?php echo $art->title ?></td>
                <td>
                    <a class="btn btn-info"
                       href="">
                        Votes
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
                Add Article
            </a>
        </td>
    </tr>
    </tbody>
</table>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">add Article</h3>
    </div>
    <form action="actions/add_article.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="focusedInput">Title</label>
                <div class="controls">
                    <input class="input-xlarge focused" name="title" id="focusedInput" required type="text"
                           placeholder="Title"
                    >
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">File</label>
                <div class="controls">
                    <input class="input-xlarge focused" name="file" id="focusedInput" required type="file"
                    >
                </div>
            </div>
        </div>
        <input type="hidden" name="cat" value="<?php echo $art->cat?>">
        <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-primary">add Article</button>
        </div>
    </form>
</div>
<?php
get_footer();
?>
