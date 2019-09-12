<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 06/09/2019
 * Time: 19:49
 */

include_once 'includes/connextionBD.php';
include_once 'api/objects/Deputie.php';
require_once("functions/function.php");
get_header();
get_sidebar();
get_bread_two();

$db = connextionBD::getInstance();
$dep = new Deputie($db);
$dep->id = $_GET['dID'];

$stmt = $dep->getOne();
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $dep->nomFr = $row['elu_nom_fr'];
    $dep->img = $row['img'];
    $dep->bio = $row['bio'];
}

?>

<div class="row">

    <div class="span5 dep-img" style="padding: 4%!important;">
        <img class="img-rounded" src="<?php echo $dep->img?>" alt=<?php echo $dep->nomFr ?>/>
    </div>
    <div class="span7" style="padding-top:5% ">
        <?php echo $dep->bio ?>
    </div>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>PLE</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Month</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once('includes/connextionBD.php');

                $sql = "SELECT attributes FROM ple where elu_id=" . $dep->id;
                $bd = connextionBD::getInstance(); //rs.open sql,con
                $stmt = $bd->query($sql);
                $values = json_decode($stmt->fetch()['attributes'], true);
                foreach ($values as $key => $value)
                { ?><!--open of while -->
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value; ?></td>
                    <td class="center">
                        <a class="btn btn-info" href="">
                            Modify
                        </a>

                    </td>
                </tr>
                <?php
                } //close of while
                ?>
                <tr>
                    <td>
                        <a class="btn btn-info" href="add_value.php?table=ple&id=<?php echo $dep->id?>">
                            Add values
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div>

<!-- PERM -->

<!--/row-->
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>com_perm</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Month</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once('includes/connextionBD.php');

                $sql = "SELECT attributes FROM com_perm where elu_id=" . $dep->id;
                $bd = connextionBD::getInstance(); //rs.open sql,con
                $stmt = $bd->query($sql);
                $values = json_decode($stmt->fetch()['attributes'], true);
                foreach ($values as $key => $value)
                { ?><!--open of while -->
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value; ?></td>
                    <td class="center">
                        <a class="btn btn-info" href="">
                            Modify
                        </a>

                    </td>
                </tr>
                <?php
                } //close of while
                ?>
                <tr>
                    <td>
                        <a class="btn btn-info" href="">
                            Add values
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

<!-- SPEC -->

<!--/row-->
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>com_spec</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Month</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once('includes/connextionBD.php');

                $sql = "SELECT attributes FROM com_spec where elu_id=" . $dep->id;
                $bd = connextionBD::getInstance(); //rs.open sql,con
                $stmt = $bd->query($sql);
                $values = json_decode($stmt->fetch()['attributes'], true);
                foreach ($values as $key => $value)
                { ?><!--open of while -->
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value; ?></td>
                    <td class="center">
                        <a class="btn btn-info" href="">
                            Modify
                        </a>

                    </td>
                </tr>
                <?php
                } //close of while
                ?>
                <tr>
                    <td>
                        <a class="btn btn-info" href="">
                            Add values
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

<!-- votes -->

<!--/row-->
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white user"></i><span class="break"></span>votes</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Month</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once('includes/connextionBD.php');

                $sql = "SELECT attributes FROM votes where elu_id=" . $dep->id;
                $bd = connextionBD::getInstance(); //rs.open sql,con
                $stmt = $bd->query($sql);
                $values = json_decode($stmt->fetch()['attributes'], true);
                foreach ($values as $key => $value)
                { ?><!--open of while -->
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $value; ?></td>
                    <td class="center">
                        <a class="btn btn-info" href="">
                            Modify
                        </a>

                    </td>
                </tr>
                <?php
                } //close of while
                ?>
                <tr>
                    <td>
                        <a class="btn btn-info" href="">
                            Add values
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->


<?php
get_footer();
?>


<!-- 	<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-content">
			<ul class="list-inline item-details">
				<li><a href="http://themifycloud.com">Admin templates</a></li>
				<li><a href="http://themescloud.org">Bootstrap themes</a></li>
			</ul>
		</div>
	</div> -->