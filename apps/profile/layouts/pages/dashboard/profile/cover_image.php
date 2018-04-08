<?php
router(array("HEADER","profile"),"","",'','','file','');
	if(chkSes()=="Active")
	{
		$user = userData();
		
		$GLOBALS["croppieSettings"] = 1;
		$GLOBALS["boundaryWidth"] = 800;
		$GLOBALS["boundaryHeight"] = 450;
		$GLOBALS["croppieWidth"] = 800;
		$GLOBALS["croppieHeight"] = 200;
		$GLOBALS["croppieShape"] = "square";
		$GLOBALS["croppieImageName"] = "rand";
		$GLOBALS["croppieTargetFolder"] ="images";
		$GLOBALS["croppieImageUploader"] = "coverImageUploader.php";
		$GLOBALS["croppieCustomOptions"] = "";
		$GLOBALS["croppieCustomData"] = $user["userID"];
		
		?>
			<div class="row">
				<div class="col l12">
					<h5 class="page-header"> &nbsp;&nbsp;&nbsp;YOUR COVER PHOTO</h5>
				</div>
			</div>
			<div class="row">
			  <!-- start course content -->
				<div class="col l12 m12 s12">
							<div class="croppie_buttons z-depth-4">
								<button id="btnx" class="file-btn hoverable z-depth-4">
									<span>Select Image <i class="material-icons">file_upload</i></span>
									<input type="file" id="upload" value="image" />
								</button>
							</div>
				  <div class="col l12 m12 s12">
					<div class="actions col l12 m12 s12">
						<div class="crop col l12 m12 s12">
							<div id="upload-demo" class="col l12 m12 s12"></div>
							<div class="mybuttons">
								<button class="btn vanilla-rotate hoverable z-depth-4" data-deg="90"><i class="material-icons">rotate_left</i></button>
								<button class="btn vanilla-rotate hoverable z-depth-4" data-deg="-90"><i class="material-icons">rotate_right</i></button>
								<button id="btnxx " class="btn upload-result hoverable z-depth-4"><i class="material-icons">save</i></button>
							</div>
						</div>
						<div id="result"></div>
					</div>
				  </div>
				</div>
			</div>
		<?php
	}
	else
	{
		include find_file("login.php");
	}
	router(array("FOOTER","profile"),"","",'','','file','');
?>