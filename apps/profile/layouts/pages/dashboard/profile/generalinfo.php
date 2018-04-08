<?php
router(array("HEADER","profile"),"","",'','','file','');
	if(chkSes()=="Active")
	{
		$user = userData();
		
		//('userID'=>$userID,'AccountType'=>$AccountType,'UserCode'=>$UserCode,'org'=>$org,'Branch'=>$Branch,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'Country'=>$userCountry,'ProfilePic'=>$ProfilePic,'sex'=>$sex,'DOB'=>$DOB,
		//'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
		?>		

  

            	
      <div class="section scrollspy" id="startPosts">
    <div class="container">
	<hr>


  
  <H3 class="header text_b">Welcome <?php echo getNames();?></H3>
  
  
  
 <div class="row">
    <div class="col s12">
      <ul class="tabs">

        <li class="tab col s3"><a class="active" href="#test1">Statement</a></li>
        <li class="tab col s3"><a class="active"href="#test2">Deal of The Week</a></li>
        <li class="tab col s3"><a class="active" href="#test3">General Info</a></li>
	    <li class="tab col s3"><a class="active" href="#test4">STO Rates</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">Hire History</div>
    <div id="test2" class="col s12"></div>
    <div id="test3" class="col s12"></div>
    <div id="test4" class="col s12"> <table>
        <thead>
          <tr>
              <th data-field="id">Vehicle Class</th>
              <th data-field="name">Vehicle Type</th>
              <th data-field="price">Market Rate</th>
			  <th data-field="price">Travel Agent Rate</th>
			  <th data-field="price">Drivers Allowance</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>4 X 4 SUV</td>
            <td>Toyota Prado/Similar</td>
            <td>K910.00 Within/DISTANCE LEARNING</td>
			<td>K800.00 within & DISTANCE LEARNING</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING</td>
          </tr>
          <tr>
         <td>4 X 4 Double Cab</td>
            <td>Ford Ranger/Similar</td>
            <td>1500.00 Within/DISTANCE LEARNING</td>
			<td>1300.00  within & DISTANCE LEARNING</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING</td>
          </tr>
		   <td>Full Size Sedan</td>
            <td>Toyota Allion/Similar</td>
            <td>K400.00 within town/K500.00 DISTANCE LEARNING</td>
			<td>K350.00  within  town/K400.00 DISTANCE LEARNING</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING</td>
		    </tr>
		   <td>Compact Sedan</td>
            <td>Honda Civic/Similar</td>
            <td>350.00 (within Lusaka/400 Outside</td>
			<td>300.00 within/K350.00 out</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING</td>
		    </tr>
		   <td>People Carrier 8 seater Bus</td>
            <td>Toyota REGIUS /Similar</td>
            <td>Request for quote</td>
			<td>Request for quote</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING</td>
		    </tr>
		   <td>People Carrier 26-30 Seater Bus</td>
            <td>Toyota Quantum /Similar</td>
            <td>Request for quote</td>
			<td>Request for quote</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING
			 </tr>
		   <td>4X4 SUV Safari Camper</td>
            <td>Toyota Prado /Similar</td>
            <td>1400.00</td>
			<td>1200.00</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING
			 </tr>
			<td>4X4 Double Safari Camper</td>
            <td>Ford Ranger /Similar</td>
            <td>2000.00</td>
			<td>1500.00</td>
			<td>K200.00 Within K500.00 DISTANCE LEARNING
			
		  
          <tr>
         
          </tr>
        </tbody>
      </table>
	  
	  
	  <H3 class="header text_b">Airport Transfers</H3>
	  
	  <table>
	   <thead>
          <tr>
              <th data-field="id">Vehicle Class</th>
              <th data-field="name">Vehicle Type</th>
              <th data-field="price">Market Rate</th>
			  <th data-field="price">Travel Agent Rate</th>
		
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Luxury </td>
            <td>Benz/Ford Ranger</td>
            <td>K1300.00</td>
			<td>1000.00 Standard Rate within </td>
		
          </tr>
          <tr>
         <td>Saloon Cars </td>
            <td>Toyota Allion/Similar</td>
            <td>K300.00 </td>
			<td>K250.00 per trip</td>
	
          </tr>
		  
		  <td> Buses</td>
		  <td>Ragius/Granvia/Quantum</td>
            <td>K150.00/person</td>
			<td>K100.00</td>
		
          </tr>
	
	  </div>
   </tr>
        </tbody>
      </table>

		
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