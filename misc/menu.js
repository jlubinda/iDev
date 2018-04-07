menunum=0;
menus=new Array();
_d=document;
function addmenu(){
menunum++;
menus[menunum]=menu;}
function dumpmenus(){
mt="<script language=javascript>";for(a=1;a<menus.length;a++){mt+=" menu"+a+"=menus["+a+"];"}mt+="<\/script>";_d.write(mt)}
if(navigator.appVersion.indexOf("MSIE 6.0")>0)
{
	effect = "Fade(duration=0.2);Alpha(style=0,opacity=88);Shadow(color='#FFFFFF', Direction=135, Strength=2)"
}
else
{
	effect = "Shadow(color='#FFFFFFF', Direction=135, Strength=2)" // Stop IE5.5 bug when using more than one filter
}


timegap=500			// The time delay for menus to remain visible
followspeed=1			// Follow Scrolling speed
followrate=40			// Follow Scrolling Rate
suboffset_top=0;		// Sub menu offset Top position 
suboffset_left=10;		// Sub menu offset Left position

style1=[			// style1 is an array of properties. You can have as many property arrays as you need. This means that menus can have their own style.
"000000",			// Mouse Off Font Color
"FFFFFF",			// Mouse Off Background Color
"000000",			// Mouse On Font Color
"CCCC99",			// Mouse On Background Color
"FFFFFF",			// Menu Border Color 
11,				// Font Size in pixels
"normal",			// Font Style (italic or normal)
"bold",			// Font Weight (bold or normal)
"Verdana",		// Font Name
4,				// Menu Item Padding
"",				// Sub Menu Image (Leave this blank if not needed)
,				// 3D Border & Separator bar
"FFFFFF",			// 3D High Color
"FFFFFF",			// 3D Low Color
"",	 			// Current Page Item Font Color (leave this blank to disable)
"",				// Current Page Item Background Color (leave this blank to disable)
"",				// Top Bar image (Leave this blank to disable)
"FFFFFF",			// Menu Header Font Color (Leave blank if headers are not needed)
"FFFFFF",			// Menu Header Background Color (Leave blank if headers are not needed)
]

style2=[			// style2 is an array of properties. You can have as many property arrays as you need. This means that menus can have their own style.
"000000",			// Mouse Off Font Color
"CCCC99",			// Mouse Off Background Color
"000000",			// Mouse On Font Color
"FFFFCC",			// Mouse On Background Color
"CCCC99",	
11,				// Font Size in pixels
"normal",			// Font Style (italic or normal)
"bold",			// Font Weight (bold or normal)
"Verdana",		// Font Name
4,				// Menu Item Padding
"",				// Sub Menu Image (Leave this blank if not needed)
,				// 3D Border & Separator bar
,			// 3D High Color
,			// 3D Low Color
"",				// Current Page Item Font Color (leave this blank to disable)
"",				// Current Page Item Background Color (leave this blank to disable)
"",				// Top Bar image (Leave this blank to disable)
"FFFFFF",			// Menu Header Font Color (Leave blank if headers are not needed)
"FFFFFF", 			// Menu Header Background Color (Leave blank if headers are not needed)
]

addmenu(menu=[			// This is the array that contains your menu properties and details
"mainmenu",			// Menu Name - This is needed in order for the menu to be called
150,				// Menu Top - The Top position of the menu in pixels
10,				// Menu Left - The Left position of the menu in pixels
,				// Menu Width - Menus width in pixels
1,				// Menu Border Width 
,				// Screen Position - here you can use "center;left;right;middle;top;bottom" or a combination of "center:middle"
style1,				// Properties Array - this is set higher up, as above
1,				// Always Visible - allows the menu item to be visible at all time (1=on/0=off)
"left",				// Alignment - sets the menu elements text alignment, values valid here are: left, right or center
effect,				// Filter - Text variable for setting transitional effects on menu activation - see above for more info
,				// Follow Scrolling - Tells the menu item to follow the user down the screen (visible at all times) (1=on/0=off)
1, 				// Horizontal Menu - Tells the menu to become horizontal instead of top to bottom style (1=on/0=off)
0,				// Keep Alive - Keeps the menu visible until the user moves over another menu or clicks elsewhere on the page (1=on/0=off)
,				// Position of TOP sub image left:center:right
,				// Set the Overall Width of Horizontal Menu to 100% and height to the specified amount (Leave blank to disable)
,				// Right To Left - Used in Hebrew for example. (1=on/0=off)
,				// Open the Menus OnClick - leave blank for OnMouseover (1=on/0=off)
,				// ID of the div you want to hide on MouseOver (useful for hiding form elements)
,				// Reserved for future use
,				// Reserved for future use
,				// Reserved for future use

//"Description Text", "URL", "Alternate URL", "Status", "Separator Bar"
,"CARDS&nbsp;&nbsp;","show-menu=carnets","#","Monitor Carnet Stocks, Issues & Cancellations",1
,"REGISTER&nbsp;&nbsp;","show-menu=register","#","Register Accidents & Claims",1
,"ADVICES&nbsp;&nbsp;","l_advs_ovr10k_nbilist.php?cmd=resetall","#","Advices for Payments",1
,"PAYMENTS&nbsp;&nbsp;","show-menu=payments","#","Payments and Reimbursements",1
,"REPORTS&nbsp;&nbsp;","/mis_/rpts2/rindex.php","#","Reports",1
,"<img src=/mis_/images/spacer.gif border=0 width=150 height=1>SETTINGS&nbsp;&nbsp;&nbsp;","show-menu=settings","","Settings",1
,"HELP&nbsp;&nbsp;","#","#","Help",1
,"LOGOUT&nbsp;&nbsp;","logout.php","","Logout",1
]) 

addmenu(menu=["carnets",
,,300,1,"",style2,,"left",effect,,,,,,,,,,,,
,"Supplies to National Bureaux","a_rcpts_nblist.php?cmd=resetall",,"Supplies to National Bureaus" ,1
,"Requests by Primary Insurance Companies", "b_rqsts_piclist.php?cmd=resetall",,"Requests by Primary Insurance Companies" ,1
,"Supplies to Primary Insurance Companies By National Bureaus","c_rcpts_piclist.php?cmd=resetall",,"Supplies to Primary Insurance Companies By National Bureaus" ,1
,"Issues to Motorists by Primary Insurance Companies", "d_issues_piclist.php?cmd=resetall",,"Issues to Motorists by Primary Insurance Companies" ,1
,"Cancellations by Primary Insurance Company", "e_cncltns_less_30_piclist.php?cmd=resetall",,"Cancellations by Primary Insurance Company" ,1
])

addmenu(menu=["register",
,,300,1,"",style2,,"left",effect,,,,,,,,,,,,
,"Accident Registrations by Handling National Bureaus","g_acdnt_reports_nbhlist.php?cmd=resetall",,"Accident Registrations by Handling National Bureaus" ,1
,"Investigation Documents","h_invstgn_docs_nbhlist.php?cmd=resetall",,"Investigation Documents" ,1
,"Claims Registration by Handling National Bureau (Under COM$ 10,000)","j_claims_undr_10k_nbhlist.php?cmd=resetall",,"Claims Registration by Handling National Bureau (Under COM$ 10,000)" ,1
,"Claims Registration By Handling Bureau (Over COM$ 10,000)","m_claims_ovr_10k_nbhlist.php?cmd=resetall",,"Claims Registration By Handling Bureau (Over COM$ 10,000)" ,1
])

addmenu(menu=["payments",
,,300,1,"",style2,,"left",effect,,,,,,,,,,,,
,"Payments for Claims by Handling National Bureau (Under COM $10, 000)","k_pymnts_undr_10k_nbhlist.php?cmd=resetall",,"Payments for Claims by Handling National Bureau (Under COM $10, 000)" ,1
,"Payments for Claims by Handling Bureau (Over COM$ 10, 000)","n_pymnts_ovr_10k_nbhlist.php?cmd=resetall",,"Payments for Claims by Handling Bureau (Over COM$ 10, 000)" ,1
,"Reimbursements by the Pool to Handling National Bureaus","o_rmbsmnt_poollist.php?cmd=resetall",,"Reimbursements by the Pool to Handling National Bureaus" ,1
,"Reimbursements to the Pool by National Bureaus Of Insured's Country","p_rmbsmnt_nbhlist.php?cmd=resetall",,"Reimbursements to the Pool by National Bureaus Of Insured's Country" ,1
])

addmenu(menu=["reports",
,,300,1,"",style2,,"left",effect,,,,,,,,,,,,
])

addmenu(menu=["settings",
,,300,1,"",style2,,"left",effect,,,,,,,,,,,,
,"Types of Investigation Documents","i_invstgn_doc_types_nbhlist.php?cmd=resetall",,"Types of Investigation Documents" ,1
,"Types of Claims","z_claim_typeslist.php?cmd=resetall",,"Types of Claims",1
,"Countries","z_countrieslist.php?cmd=resetall",,"Countries",1
,"Currencies","z_currencieslist.php?cmd=resetall",,"Currencies",1
,"Types of Payments","z_payment_typeslist.php?cmd=resetall",,"Types of Payments" ,1
,"User Account Management","z_user_levelslist.php?cmd=resetall",,"User Account Management",1
])

dumpmenus()