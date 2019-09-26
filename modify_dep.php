<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 17/09/2019
 * Time: 17:21
 */


include_once 'includes/connextionBD.php';
include_once 'api/objects/Deputie.php';


$db = connextionBD::getInstance();
$dep = new Deputie($db);
$dep->id = $_GET['ID'];

$stmt = $dep->getOne();
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $dep->nomFr = $row['elu_nom_fr'];
    $dep->nomAr = $row['elu_nom_ar'];
    $dep->img = $row['img'];
    $dep->bio = $row['bio'];
    $dep->gov = $row['gov'];
}

require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_four();
?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon white edit"></i><span class="break"></span>Update <?php echo $dep->nomFr ?>
                    's Data</h2>
                <div class="box-icon">
                    <a href="users.php" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="actions/update_dep.php" enctype="multipart/form-data">
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="focusedInput">nom fr</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="nomFr" id="focusedInput" type="text"
                                       placeholder="nom fr"
                                       value="<?php echo $dep->nomFr ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="focusedInput">nom ar</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="nomAr" id="focusedInput" type="text"
                                       placeholder="nom ar"
                                       value="<?php echo $dep->nomAr ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="focusedInput">bio</label>
                            <div class="controls">
                                <textarea name="bio" class="input-xlarge focused" cols="50" rows="15">
                                    <?php echo $dep->bio ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="focusedInput">gov</label>
                            <div class="controls">
                                <select name="gov" class="input-xlarge focused" id="focusedInput">
                                    <option value="<?php echo $dep->gov ?>" selected><?php echo $dep->gov ?></option>
                                    <option value="Ariana">Ariana</option>
                                    <option value="Beja">Beja</option>
                                    <option value="Ben Arous">Ben Arous</option>
                                    <option value="Bizerte">Bizerte</option>
                                    <option value="Gabes">Gabes</option>
                                    <option value="Jendouba">Jendouba</option>
                                    <option value="Kairouan">Kairouan</option>
                                    <option value="Kasserine">Kasserine</option>
                                    <option value="Gafsa">Gafsa</option>
                                    <option value="Kebili">Kebili</option>
                                    <option value="Kef">Kef</option>
                                    <option value="Mahdeya">Mahdeya</option>
                                    <option value="Manouba">Manouba</option>
                                    <option value="Medenine">Medenine</option>
                                    <option value="Monastir">Monastir</option>
                                    <option value="Nabeul1">Nabeul1</option>
                                    <option value="Nabeul2">Nabeul2</option>
                                    <option value="Sfax1">Sfax1</option>
                                    <option value="Sfax2">Sfax2</option>
                                    <option value="Sidi Bouzid">Sidi Bouzid</option>
                                    <option value="Siliana">Siliana</option>
                                    <option value="Sousse">Sousse</option>
                                    <option value="Tataouine">Tataouine</option>
                                    <option value="Tozeur">Tozeur</option>
                                    <option value="Tunis1">Tunis1</option>
                                    <option value="Tunis2">Tunis2</option>
                                    <option value="Zaghouan">Zaghouan</option>
                                    <option value="France1">France1</option>
                                    <option value="France2">France2</option>
                                    <option value="Allemagne">Allemagne</option>
                                    <option value="Amerique">Amerique</option>
                                    <option value="Italie">Italie</option>
                                    <option value="Arabe">Arabe</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="focusedInput">image</label>

                            <div class="controls">
                                <img src="<?php echo $dep->img ?>" alt="no image available" width="50" height="50">
                                <input class="input-xlarge focused" name="img" id="focusedInput" type="file">
                            </div>
                        </div>
                        <input type="hidden" name="autoid" value="<?php echo $dep->id?>">
                        <input type="hidden" name="imgLink" value="<?php echo $dep->img?>">
                        <div class="form-actions">

                            <button type="submit" onclick="return confirmUpdate()" class="btn btn-primary">Save Changes
                            </button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
<?php
get_footer();
?>