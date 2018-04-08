<?php
router(array("HEADER","website"),"","",'','','file','');
?>
    <style type="text/css">
        #cover {
            display:        none;
            position:       absolute;
            left:           0px;
            top:            0px;
            width:          100%;
            height:         130%;
            background:     gray;
            filter:         alpha(Opacity = 50);
            opacity:        0.7;
            -moz-opacity:   0.7;
            -khtml-opacity: 0.7;
			z-index:    100;
        }

        #dialog {
            display:    none;
           position:absolute;
			top:65%;
			left:50%;
			width:100px;  /* adjust as per your needs */
			height:100px;   /* adjust as per your needs */
			margin-left:-50px;   /* negative half of width above */
			margin-top:-50px;   /* negative half of height above */
            z-index:    101;
            padding:    2px;
            font:       10pt tahoma;
        }

        #dialog2 {
            display:    none;
           position:absolute;
			top:65%;
			left:50%;
			width:100px;  /* adjust as per your needs */
			height:100px;   /* adjust as per your needs */
			margin-left:-50px;   /* negative half of width above */
			margin-top:-50px;   /* negative half of height above */
            z-index:    101;
            padding:    2px;
            font:       10pt tahoma;
        }
    </style>
	<br>
<div id="cover"></div>
<div id="dialog"><img src="apps/website/resources/images/uploading3.gif" width="100"></div>
<div id="dialog2"><img src="apps/website/resources/images/cloud_ok.png" width="100"></div>