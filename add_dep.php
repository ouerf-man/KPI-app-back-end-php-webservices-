<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 14/09/2019
 * Time: 13:11
 */


require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_four();
?>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon white edit"></i><span class="break"></span>Add deputie </h2>
                <div class="box-icon">
                    <a href="users.php" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="actions/add_dep_confirmation.php" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">elu_id</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="id" id="focusedInput" required type="text"
                                       placeholder="Karim_Helali"
                                >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">elu_nom_fr</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="nomFr" id="focusedInput" required type="text"
                                       placeholder="Karim Helali"
                                >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">elu_nom_ar</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="nomAr" id="focusedInput" required type="text"
                                       placeholder="كريم الهلالي"
                                >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">gov</label>
                            <div class="controls">
                                <select name="gov" class="input-xlarge focused"  id="focusedInput" required
                                        type="text" placeholder="كريم الهلالي">
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
                            <label class="control-label" for="focusedInput">bio</label>
                            <div class="controls">
                                <textarea class="input-xlarge focused" name="bio" id="focusedInput"
                                          placeholder="text">

                                </textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="focusedInput">image</label>
                            <div class="controls">
                                <input class="input-xlarge focused" name="img" id="focusedInput"  type="file"
                                >
                            </div>
                        </div>

                        <div class="form-actions">
                            <input name="submit" type="submit" onclick="return confirmUpdate()" class="btn btn-primary" value="Save Changes">
                            </input>
                        </div>


                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
<?php

get_footer();
?>