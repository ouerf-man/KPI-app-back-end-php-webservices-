<?php
require_once("functions/function.php");
get_header();
get_sidebar();
get_bread();
include_once "includes/connextionBD.php";
$db = connextionBD::getInstance();
$sql = "SELECT AVG(rating) FROM rating";
$stmt = $db->prepare($sql);
$stmt->execute();
$avg = $stmt->fetch()["AVG(rating)"];
$sql = "SELECT gov, COUNT(*) as c FROM govs_clicked GROUP BY gov ORDER BY c DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();
$topGov = $stmt->fetch()["gov"];
$sql = "SELECT elu_id, COUNT(*) as c FROM deps_clicked GROUP BY elu_id ORDER BY c DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();
$topDep = $stmt->fetch()['elu_id'];
$sql = "SELECT gov, COUNT(*) as c FROM govs_clicked GROUP BY gov ORDER BY c DESC";
$stmt = $db->prepare($sql);
$stmt->execute();
$sql = "SELECT elu_id, COUNT(*) as c FROM deps_clicked GROUP BY elu_id ORDER BY c DESC";
$stmt1 = $db->prepare($sql);
$stmt1->execute();

?>
<div class="row-fluid home_text">
    <div style="font-family: railway ; font-size: 40px">
        Average Rating :
        <span style="color: tomato"><?php echo $avg ?></span>
    </div>
    <div class="gov" style="margin-top: 50px;font-family: railway ; font-size: 40px">
        Top Visited Gov :
        <span style="color: tomato"><?php echo $topGov ?></span>
        <button class="btn btn-primary" href="#myModal" role="button" data-toggle="modal">view more</button>
    </div>
    <div class="dep" style="margin-top: 50px;font-family: railway ; font-size: 40px">
        Top Visited deputy :
        <span style="color: tomato"><?php echo $topDep ?></span>
        <button class="btn btn-primary" href="#myModal1" role="button" data-toggle="modal">view more</button>
    </div>
</div>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Govs</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>

                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>govs</th>
                            <th>total clicks</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $stmt->fetch()) {
                            ?>
                                <tr>
                                    <td><?php echo $row["gov"] ?></td>
                                    <td><?php echo $row["c"] ?></td>
                                </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div><!--/span-->

        </div><!--/row-->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Deps</h3>
    </div>
    <div class="modal-body">
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>

                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>Deps</th>
                            <th>total clicks</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $stmt1->fetch()) {
                            ?>
                            <tr>
                                <td><?php echo $row["elu_id"] ?></td>
                                <td><?php echo $row["c"] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div><!--/span-->

        </div><!--/row-->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
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