<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 21/09/2019
 * Time: 14:16
 */

require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_six();

include_once 'includes/connextionBD.php';
include_once 'api/objects/Article.php';
include_once 'api/objects/Deputie.php';


$db = connextionBD::getInstance();
$art = new Article($db);
$dep = new Deputie($db);
$art->id = $_GET['id'];

$stmt = $dep->readAll();
$sql1 = "SELECT attributes FROM votes_articles WHERE elu_id='Karim_Helali'";
if ($db->query($sql1)->rowCount() > 0) {
    $row = $db->query($sql1)->fetch();
    $values = json_decode($row['attributes'], true);
    if (isset($values[$art->id])) {
        echo('
        <div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Warning!</strong> Values already filled for this article
</div>
        ');
    }
}

?>
<form action="actions/add_article_votes" method="post">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>deputie</th>
            <th>vote</th>
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
                $dep->id = $row['elu_id'];
                ?>
                <tr>
                    <td><?php echo $dep->id ?></td>
                    <td>
                        <label><input type="radio" name="vote[<?php echo $dep->id ?>]" value="1" required>pour</label>

                        <label><input type="radio" name="vote[<?php echo $dep->id ?>]" value="2">contre</label>

                        <label><input type="radio" name="vote[<?php echo $dep->id ?>]" value="0">neutre</label>
                    </td>
                </tr>

                <?php
            }
        }
        ?>
        <tr>
            <td>
                <button type="submit" class="btn btn-info">
                    Submit
                </button>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="id" value="<?php echo $art->id ?>">
</form>

<?php
get_footer();
?>
