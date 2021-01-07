<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/header.php'); ?>

<link href="<?php echo $config['urls']['baseurl'] . '/lib/css/history.css'; ?>" type="text/css" rel="stylesheet" />
<!--[if IE 7]>
<link href="<?php echo $config['urls']['baseurl'] . '/lib/css/history-ie.css'; ?>" type="text/css" rel="stylesheet" />
<![endif]-->
<ul class="double_columns">
	<li>
    	<span class="headline">History</span><br />
        &nbsp;&nbsp;&nbsp;This section will be devoted to the history of the family. And as experiences come along in our ever changing lives, so will this section too grow with our experiences. In this section we will list bunches of quotes, sayings, jokes, and anything that has contributed to what the Family was and still is today.
    </li>
    <li>
    	<img src="/images/site/Duck_and_Bryan_325x250.jpg" />
    </li>
</ul>

<hr class="divider" />

<ul class="double_columns">
	<li>		
	
    <span class="headline">Basement Quotes</span> <a id="quote_switch" class="switch">Show/Hide</a><br /><br />
           
           <div id="quote_wrapper" style="display:none;">
            
                <form id="quote_form" name="quote_form" action="quotes_post.php" method="post">
                    <label>Quote:</label>
                    <textarea name="quote"></textarea>
                    <label>Caption:</label>
                    <input type="text" name="caption">
                    <input type="submit" name="submit" value="Submit">
                </form>
            
            </div>
            
            <?php 
			include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
			$query = "	SELECT strquote, strcaption
						FROM tblBasementQuotes
						WHERE ysnActive = 1 
						ORDER BY quoteID desc";
		
				if ($stmt = mysqli_prepare($conn, $query)) {
					
					mysqli_stmt_execute($stmt); // execute the SQL statement 
					
					mysqli_stmt_bind_result($stmt, $quote, $caption);
					
					$quotes = '';
					while (mysqli_stmt_fetch($stmt)) {
						$quotes .=  '<li>' . $quote;
						$quotes .= $caption == '' ? '</li>' : '<div class="caption"> - ' . $caption . '</div></li>'  ; 
					}
					$quotes = '<ul id="quotes">'.$quotes.'</ul>';
					
					mysqli_stmt_close($stmt); // close SQL statement 
				}
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
			
			echo $quotes;
			
			?>        
	</li>
    <li>
        <span class="headline">Basement Terminology</span> <a id="term_switch" class="switch">Show/Hide</a><br /><br />
                    
           <div id="term_wrapper" style="display:none;">
            
                <form id="term_form" name="term_form" action="term_post.php" method="post">
                    <label>Title:</label><br />
                    <input type="text" name="title">
                     
                    <label>Description:</label><br />
                    <textarea name="description"></textarea>
                    
                    <input type="submit" name="submit" value="Submit">
                </form>
            
            </div>
            
            <?php 
			include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
			$terminology = '';
		
			$query = "	SELECT Title, Description
						FROM tblTerminology
						WHERE Active = 1
						ORDER BY RAND()";
		
				if ($stmt = mysqli_prepare($conn, $query)) {
					
					mysqli_stmt_execute($stmt); // execute the SQL statement 
					
					mysqli_stmt_bind_result($stmt, $title, $description);
					
					while (mysqli_stmt_fetch($stmt)) {
						$terminology .=  '<li><b>' . $title . '</b> - ' . $description . '</li>';
					}
					$terminology = '<ul id="term">'.$terminology.'</ul>';
					
					mysqli_stmt_close($stmt); // close SQL statement 
				}
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
			
			echo $terminology;
			
			?>   
	</li>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT']."/lib/includes/footer.php");  ?>