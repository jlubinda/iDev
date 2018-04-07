










CREATE TABLE rssfeed
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(250),
description VARCHAR(250),
description VARCHAR(250),
img LONGBLOB NOT NULL,
PRIMARY KEY(id)
);

<?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
 
    DEFINE ('DB_USER', '');   
    DEFINE ('DB_PASSWORD', '');   
    DEFINE ('DB_HOST', '');   
    DEFINE ('DB_NAME', ''); 
 
    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>My RSS feed</title>';
    $rssfeed .= '<link>http://www.website.com</link>';
    $rssfeed .= '<description>This is  a RSS feed</description>';
	 $rssfeed .= '<images> </images>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>Copyright website </copyright>';
 
    $connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die('Could not connect to database');
    mysql_select_db(DB_NAME)
        or die ('Could not select database');
 
    $query = "SELECT * FROM rssfeed ORDER BY date DESC";
    $result = mysqli_query($db,$query) or die ("Could not execute query");
 
    while($row = mysqli_fetch_array($result)) {
        extract($row);
 
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $title . '</title>';
        $rssfeed .= '<description>' . $description . '</description>';
        $rssfeed .= '<link>' . $link . '</link>';
        $rssfeed .= '<link>' . $image . '</link>';
	   $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($date)) . '</pubDate>';
        $rssfeed .= '</item>';
    }
 
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
 
    echo $rssfeed;
?>