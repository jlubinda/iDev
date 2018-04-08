<?php

router(array("HEADER","profile"),"","",'','','file','');

if(chkSes()=="Inactive")
{
	include find_file("login.php");
}
else
{
	//include find_file("apps/blog/layouts/pages/nav.php");
	$userData = userData();
	$priv = priv();
	?>
    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<?php 
			
			$numAPIKeys = getAPIKeyForUser($userData["userID"],"NUM");
			
			if($numAPIKeys==0)
			{
				
			}
			elseif($numAPIKeys==1)
			{
				
			}
			elseif($numAPIKeys>=2)
			{
				$APIsx = getAPIKeyForUser($userData["userID"]);
				//var_dump($APIsx);
				?>
				<div class="row">
					<div class="col-lg-12">
						<h3 class="page-header">Your Schools/Organizations</h3>
						<?php 
						for($z=0; $z<$APIsx[0]["num"]; $z++)
						{
							?>
							<li><a href="./?func=SETORG&id=<?php echo $APIsx[$z]["org_id"];?>"><?php echo $APIsx[$z]["name"];?></a></li>
							<?php
						}
						?>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<?php 
			}
			?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php if($_REQUEST["programme"]==""){?>Available Programmes<?php } else { echo "Current Programme";} ?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
										<?php 
										if($_REQUEST["programme"]=="")
										{
											?>
											Enrolled Programmes
											<?php						
										}
										else
										{
											?>
											Other Enrolled Programmes
											<?php	
										}
										?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
										<?php 
										if($_REQUEST["programme"]=="")
										{
											$cats = listEnrolledProgrammes($userData["userID"],$_SESSION["APIKey"]);
											
											for($a=0; $a<$cats[0]['num']; $a++)
											{
												?>
											  <li>
												   <a href="?ref=&programme=<?php echo getProgrammeID($_SESSION["APIKey"],$cats[$a]['code']);?>&course=<?php echo $_REQUEST["course"];?>&func=<?php echo $_REQUEST["func"];?>" style="font-size:12px;"><i class="fa fa-graduation-cap fa-fw"></i>&nbsp;<?php echo getProgramme(getProgrammeID($_SESSION["APIKey"],$cats[$a]['code']));?> <?php echo $cats[$a]["code"];?></a>
											  </li>
												<?php
											}									
										}
										else
										{
											$cats = listEnrolledProgrammes($userData["userID"],$_SESSION["APIKey"]);
											
											for($a=0; $a<$cats[0]['num']; $a++)
											{
												if($_REQUEST["programme"]==getProgrammeID($_SESSION["APIKey"],$cats[$a]['code']))
												{
													
												}
												else
												{
												?>
												  <li>
													   <a href="?ref=&programme=<?php echo getProgrammeID($_SESSION["APIKey"],$cats[$a]['code']);?>&course=<?php echo $_REQUEST["course"];?>&func=<?php echo $_REQUEST["func"];?>" style="font-size:12px;"><i class="fa fa-graduation-cap fa-fw"></i>&nbsp;<?php echo getProgramme(getProgrammeID($_SESSION["APIKey"],$cats[$a]['code']));?> <?php echo $cats[$a]["code"];?></a>
												  </li>
												<?php
												}
											}	
											?>
											<li class="divider"></li>
											<li><a href="#">Separated link</a></li>
											<?php	
										}
										?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
						<div class="panel-body">
								<?php 
								$userData = userData();
								if($_REQUEST["programme"]=="")
								{
									?>
									List of available programmes and short courses for your to enroll in:
									<?php
									$cats = listProgrammes($_SESSION["APIKey"]);
									for($a=0; $a<$cats[0]['num']; $a++)
									{
										if(checkProgrammeEnrollment($_SESSION["APIKey"],$userData["userID"],$cats[$a]['id'])>=1)
										{
											
										}
										else
										{
										?>
										<p><a href="?ref=enroll.php&programme=<?php echo $cats[$a]['id'];?>"><?php echo $cats[$a]['name'];?></a></p>
										<?php
										}
									}
								}
								else
								{
									echo getProgramme(getProgrammeID($_SESSION["APIKey"],$_REQUEST["programme"]));
								}
								?>
						</div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="?ref=course_materials.php&programme=<?php echo $_REQUEST['programme'];?>&course=<?php echo $_REQUEST["course"];?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Course Materials</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer">
							<span class="pull-left">Get Materials</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="?ref=webinars.php&programme=<?php echo $_REQUEST['programme'];?>&course=<?php echo $_REQUEST["course"];?>">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-video-camera fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Webinars</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer">
							<span class="pull-left">Attend Webinars</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="?ref=assignment.php&programme=<?php echo $_REQUEST['programme'];?>&course=<?php echo $_REQUEST["course"];?>">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Assignments</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="?ref=discussions.php&programme=<?php echo $_REQUEST['programme'];?>&course=<?php echo $_REQUEST["course"];?>">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Discussions</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="?ref=examinations.php&programme=<?php echo $_REQUEST['programme'];?>&course=<?php echo $_REQUEST["course"];?>">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-graduation-cap fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Examinations</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="?ref=research.php&programme=<?php echo $_REQUEST['programme'];?>&course=<?php echo $_REQUEST["course"];?>">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-search fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Research</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-certificate fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Results</div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="panel-footer">
                                <span class="pull-left">Get Results</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Finance</div>
                                </div>
                            </div>
                        </div>
						<div class="panel-footer">
							<span class="pull-left">View Accounts</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
                    </div>
                    </a>
                </div>
            </div>
			
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Performance Analysis (Area Chart)
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Payment Received
                                    <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
    </div>
    <!--=========== END COURSE BANNER SECTION ================-->
	<?php
}
router(array("FOOTER","profile"),"","",'','','file','');
?>