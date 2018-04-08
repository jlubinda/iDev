<p><strong>Car within town</strong> | Paid to Car Owner/day</p>
            	<?php 
				
				$countries = listCountries("AFRICA");
				for($b=0; $b<$countries[0]["num"]; $b++)
				{
					?>
					<p>
						<strong><u><?php echo strtoupper($countries[$b]["name"]);?></u></strong>
						<?php 
							$cats = listVehicleCategories();
							for($a=0; $a<$cats[0]["num"]; $a++)
							{
								?>
								<p>
									<strong><u><?php echo strtoupper($cats[$a]["name"]);?></u></strong>
									
									<br>
									<?php 
									$towns = listTowns($countries[$b]["name"]);
									for($c=0; $c<$towns[0]["num"]; $c++)
									{
										?>
										Within <?php echo $towns[$c]["name"];?> | K<?php echo number_format((getCategoryPrice($cats[$a]["id"],$location,"WITHIN")-getCommision($cats[$a]["id"],$location,"WITHIN")),2);?><br>                           
										Outside <?php echo $towns[$c]["name"];?> | K<?php echo number_format((getCategoryPrice($cats[$a]["id"],$location,"OUT OF TOWN")-getCommision($cats[$a]["id"],$location,"OUT OF TOWN")),2);?><br><br>
										<?php
									}
									?>
								</p>
								<?php
							}
						?>
					</p><h2></h2>
					<?php
				}
				?>
            </article>
            <br class="clear"/> 