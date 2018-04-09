<div class="container" style="margin-top:90px;">
	<div class="card-panel z-depth-5">
		<div class="row">
			<div class="col s12 m6">
				<h3 class="header center grey-text text-darken-3"> Send us A quick Message</h3>
				<br>
				<br>
				<br>
				<form action="" method="post" class="col s12 m12">
					<div class="row">
					<?php  
					if(isset($_POST['submit'])){
					$to = "info@yourdomain.com"; // this is your Email address
					$from = $_POST['email']; // this is the sender's Email address
					$first_name = $_POST['first_name'];
					$subject = $_POST['subject'];
					$subject2 = $_POST['subject'];;
					$message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
					$message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

					$headers = "From:" . $from;
					$headers2 = "From:" . $to;
					mail($to,$subject,$message,$headers);
					mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
					echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
					// You can also use header('Location: thank_you.php'); to redirect to another page.
					}
				?>
						<div class="row">
							<div class="input-field col s12 m12">
								<i class="mdi-action-subject-circle prefix"></i>
								<input id="icon_email" input type="text" name="subject" class="validate" value="<?php
								if($_REQUEST["type"] && $_REQUEST["make"])
								{
									echo "Equiry on ".$_REQUEST["make"]." - ".$_REQUEST["type"];
								}
								elseif($_REQUEST["type"] && !($_REQUEST["make"]))
								{
									echo "Equiry on ".$_REQUEST["type"];
								}
								else
								{
									echo "Equiry";
								}
								?>">
								<br />
								<label for="icon_prefix">Subject</label>
							</div>
							<br />
							<div class="input-field col s12 m12">
								<i class="mdi-communication-email prefix"></i>
								<input id="icon_email" input type="text" name="first_name" class="validate">
								<br />
								<label for="icon_prefix">Name</label>
							</div>
							<br />
							<div class="input-field col s12 m12">
								<i class="mdi-action-account-circle prefix"></i>
								<input  placeholder="Email" id="icon_prefix" name="email"  class="validate">
								<br />
								<label for="icon_email"></label>
							</div>
							<br />
							<br />
							<br />
							<div class="input-field col s12 m12">
								<i class="mdi-editor-mode-edit prefix"></i>
								<textarea id="icon_prefix2" name="message" class="materialize-textarea"></textarea>
								<br />
								<label for="icon_prefix2">Message</label>
							</div>
						</div><!--row-->
						<button class="btn waves-effect waves-light center" type="submit" name="submit" value="Submit" >Send your message&nbsp;<i class="mdi-content-send"></i></button>
					</div><!--row-->
				</form>
			</div><!--col-->
			<div class="col s12 m5 offset-m1">
				<h3 class="header center grey-text text-darken-3">Address</h3>
				<br>
				<br>
				<div class="row center">
					<h5>Phone: +111-00112233</h5>
					<p>Email: info@yourdomain.com</p>
					<p>Address:Aliquam id cursus nisi, a feugiat magna, Duis eu pulvinar libero,P O Box 38132,Etiam</p>
				</div>
			</div>
		</div><!--row-->
	</div><!--card-->
</div><!--conatiner-->
