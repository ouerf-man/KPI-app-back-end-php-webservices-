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
$test = false;
$db = connextionBD::getInstance();
$art = new Article($db);
$dep = new Deputie($db);
$art->id = $_GET['id'];

$stmt = $dep->readAll();
$sql1 = "SELECT attributes FROM votes_articles WHERE elu_id='Karim_Helali'";
if ($db->query($sql1)->rowCount() > 0) {
    $test = true;
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
<style>
    #myInput {
        background-position: 10px 12px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }
</style>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
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
            if (!$test) {
                while ($row = $stmt->fetch()) {
                    $dep->id = $row['elu_id'];
                    ?>
                    <tr>
                        <td class="filter-dep"><?php echo $dep->id ?></td>
                        <td>
                            <label><input type="radio" name="vote[<?php echo $dep->id ?>]"
                                          value="1">pour</label>

                            <label><input type="radio" name="vote[<?php echo $dep->id ?>]"
                                          value="2">contre</label>

                            <label><input type="radio" name="vote[<?php echo $dep->id ?>]"
                                          value="0">neutre</label>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                $sql1 = "SELECT * FROM votes_articles ORDER BY elu_id";
                $stmt1 = $db->prepare($sql1);
                $stmt1->execute();
                while ($row = $stmt1->fetch()) {
                    $values = json_decode($row['attributes'], true);
                    $vote = $values[$art->id];
                    $depute = $row['elu_id'];
                    ?>
                    <tr>
                        <td class="filter-dep"><?php echo $depute ?></td>
                        <td>
                            <label><input  type="radio" name="vote[<?php echo $depute ?>]"
                                          value="1" <?php if ($vote=="1") echo "checked='checked'"?> >pour</label>

                            <label><input type="radio" name="vote[<?php echo $depute ?>]"
                                          value="2" <?php if ($vote=="2") echo "checked='checked'"?>>contre</label>

                            <label><input  type="radio" name="vote[<?php echo $depute ?>]"
                                          value="0" <?php if ($vote=="0") echo "checked='checked'"?>>neutre</label>
                        </td>
                    </tr>
                    <?php
                }
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
<script>
    function myFunction() {
        var input, filter, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        dep = document.getElementsByClassName("filter-dep");
        for (i = 0; i < dep.length; i++) {
            txtValue = dep[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                dep[i].parentNode.style.display = "";
            } else {
                dep[i].parentNode.style.display = "none";
            }
        }
    }
</script>
<?php
get_footer();
?>
