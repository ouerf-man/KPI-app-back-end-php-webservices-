<?php
/**
 * Created by PhpStorm.
 * User: Raed
 * Date: 06/09/2019
 * Time: 19:34
 */

	require_once("functions/function.php");
	get_header();
	get_sidebar();
	get_bread_two();
?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Deputies</h2>
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
								  <th>ID</th>
                                  <th>Name FR</th>
								  <th>Name Ar</th>
								  <th>Actions</th>
							  </tr>
						  </thead>
						  <tbody>
							<?php
                            require_once('includes/connextionBD.php');

								$sql = "SELECT * FROM elected";
                                $bd = connextionBD::getInstance(); //rs.open sql,con
                                $stmt = $bd->query($sql);
							while ($row=$stmt->fetch())
							{ ?><!--open of while -->
							<tr>
								<td><?php echo $row['elu_id']; ?></td>
								<td><?php echo $row['elu_nom_fr']; ?></td>
								<td><?php echo $row['elu_nom_ar']; ?></td>
								<td class="center">
									<a class="btn btn-info" href="deputie.php?dID=<?php echo"'". $row['elu_id']."'"; ?>">
										Read more
									</a>
									<a class="btn btn-danger" onclick="return confirmDel()" href="actions/delete_data_dep.php?delID=<?php echo "\"".$row['elu_id']."\"";?>">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
							</tr>
							<?php
							   } //close of while
							?>
						  </tbody>
					  </table>
					</div>
				</div><!--/span-->

			</div><!--/row-->
<?php
	get_footer();
?>