<?php 	session_start(); 
		include($_SERVER['DOCUMENT_ROOT']."/lib/includes/header.php"); 
?>
<style>
div { 
	padding:3px;
}

#quotes li {
	font-size:12px;
	list-style:none;
	margin:5px;
	margin-left:-40px;
}

.caption { 
	text-indent: 25px;
	font-size:10px;
	font-weight:bold;
	
}

#quote_form {
	padding:2px;	
}

#quote_form textarea {
	height: 100px;
	margin-bottom:5px;
	width:90%;
}

#quote_form input {
	margin-bottom:5px;
	width:90%;
}
</style>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$(".switch").click(function(){
		$("#quote_wrapper").slideToggle("slow");
		$(this).toggleClass("active");
	});
});
</script>


<table id="history_table" cellpadding="0" cellspacing="0" width="100%" style="background:none;border:none;">
	<tr>
    	<td>
    		<table id="history_table" cellpadding="0" cellspacing="0" width="100%" style="background:none;border:none;">
                <tr>
                <td valign="top" align="left" style="padding-right:2px;" width="66%">
        	 		<span class="headline">History</span><br />
             		&nbsp;&nbsp;&nbsp;This section will be devoted to the history of the family. And as experiences come along in our ever changing lives, so will this section too grow with our experiences. In this section we will list bunches of quotes, sayings, jokes, and anything that has contributed to what the Family was and still is today.
        		</td>
        		<td colspan="2" align="center" valign="middle" style="padding-left:2px;" width="33%">
                	<img src="/images/site/Duck_and_Bryan_325x250.jpg" style="border:1px solid #333;" />
                </td>
                </tr>
            </table>
    	</td>
    </tr>
    <tr>
		
		<td colspan="3"><hr class="divider" /></td>
		
	</tr>
	<tr>
    	<td>
        
    	<table id="history_table" cellpadding="0" cellspacing="0" width="100%" style="background:none;border:none;">
        <tr>
        <td width="33%">

	
                                 
           <span class="headline">Basement Quotes</span> <a class="switch">Add</a><br /><br />
           
           <div id="quote_wrapper" style="display:none;">
            
                <form id="quote_form" name="quote_form" action="quotes_post.php" method="post">
                    <textarea name="quote"></textarea>
                    <input type="text" name="caption">
                    <input type="submit" name="submit" value="submit">
                </form>
            
            </div>
            
            <?php 
			include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/opendb.php');
		
			$query = "	SELECT strquote, strcaption
						FROM tblBasementQuotes
						ORDER BY RAND()";
		
				if ($stmt = mysqli_prepare($conn, $query)) {
					
					mysqli_stmt_execute($stmt); // execute the SQL statement 
					
					mysqli_stmt_bind_result($stmt, $quote, $caption);
					
					$quotes = '';
					while (mysqli_stmt_fetch($stmt)) {
						$quotes .=  '<li>&ldquo;' . $quote . '&rdquo;';
						$quotes .= $caption == '' ? '</li>' : '<div class="caption"> - ' . $caption . '</div></li>'  ; 
					}
					$quotes = '<ul id="quotes">'.$quotes.'</ul>';
					
					mysqli_stmt_close($stmt); // close SQL statement 
				}
				include($_SERVER['DOCUMENT_ROOT'].'/lib/includes/closedb.php');
			
			echo $quotes;
			
			?>        
        </td>
        <td colspan="2" style="text-align:left; vertical-align:top;" width="66%">
        	 <span class="headline">Basement Terminology</span><br /><br />
             <div><strong>&ldquo;Walking in a Winter Onesie Weekend&rdquo;</strong> - traditionally the weekend after Thanksgiving, when the Basement returns from break and begins the preliminary Christmas festivities, including: drinking copious amounts of High Life, the procuring of the Yuletide Christmas tree (preferably hewn from "Kelly's Field"), and the decorating of the basement while dressed festivly in the-kind-of-one-piece-underwear-that-has-butt-flaps (hence the name).</div>
             <div><strong>&ldquo;Drop off the (Cosby) kids at the pool.&rdquo;</strong> -  a clever way of insinuating the act of defecation </div>
             <div><strong>Power dump</strong> - an exceptionally foul smelling excretion of considerable size and quantity.  It often ranges over many colors and textures in a single sitting.  Affectionately referred to as P.D. </div>
             <div><strong>Vertical surprise</strong> - a legendary excretion made by Billy Weber in the St. Fran&rsquo;s RM 9 bathroom during the 2000-2001 year.  It consisted of an individual stool which inexplicably rested vertically in the toilet in the open air, a stupendous and enviable feat of raw masculinity </div>
             <div><strong>Cock-blocker</strong> - one who hinders another&rsquo;s attempt at dating a female Christendomite </div>
             <div><strong>&ldquo;Your pissed off poets, your women&rsquo;s groups.&rdquo;</strong> - a frequently used phrase borrowed from the lyrics of the song &ldquo;Wounded&rdquo; by Third Eye Blind.  Hugh O&rsquo;Donnell used this phrase in a comical audio skit made with his brother Niall and since then it has been frequently and spontaneously used for comic relief.  It is said using a lisp common to homosexual males. </div>
             <div><strong>&ldquo;Mingia!&rdquo; / &ldquo;Stugats!&rdquo;</strong> - Italian nouns which refer to the male generative organ.  However it is usually used as an exclamation with an understood meaning closely resembling the English exclamation &ldquo;damn!&rdquo;  It must be noted however that it can also be an expression of joy at meeting or seeing one&rsquo;s friends.  It can be and often is used without any decipherable cause or purpose other than to experience the sheer joy of pronouncing it or simply as a means of relieving stress. </div>
             <div><strong>&ldquo;Mingia fach!&rdquo;</strong> - a stronger version of &ldquo;mingia&rdquo; which translated literally would mean &ldquo;dick face&rdquo; but it rarely carries this connotation.</div>
             <div><strong>&ldquo;Mingia fach est mort!&rdquo;</strong> - originally coined by Mark Streiff during the 2000-2001 year.  It is perhaps the strongest non-English exclamation used in the basement.  It is reserved for extreme perturbation and disgust.  It has the rare and wonderful quality of combining two languages: Italian and Latin these being the two greatest languages in the world.  Its literal meaning would be &ldquo;Dick face is dead,&rdquo; but it rarely if ever carries this connotation.  It is used only as an expression of untold disgust with a meaning difficult if not impossible to express in the vernacular.  Faithful translations of such Italian words and phrases are often impossible to formulate due to limitedness and banality of the English language. </div>
             <div><strong>J.O.</strong> - an acronym for &ldquo;Jerk Off&rdquo; but it only occasionally carries this exact meaning.  Like the terms &ldquo;mingia&rdquo; and &ldquo;stugats&rdquo; is can be used as a pejorative to describe a foolish person (usually only a male however).  It can also be used however to refer to one&rsquo;s friends being synonymous with the term buddy.  It is rumored also to stand for &ldquo;junior officer&rdquo; or &ldquo;Jesu offerimus.&rdquo;  This term originated as far as can be ascertained from the famous Michael Mazzio (a J.O. himself), the mentor of Mark Streiff (also a well known J.O.)  Other notorious J.O.&rsquo;s include Hugh O&rsquo;Donnell (a.k.a &ldquo;J.O&rsquo;Donnell) , Joe O&rsquo;Herron (a.k.a. &ldquo;J O&rsquo;Herron), Billy Weber, and many others.  The greatest of all J.O.&rsquo;s however is almost universally accepted to be Michael Cumo of Long Island, NY</div>
            <div><strong>Dick Tag (DT)</strong> - A game all too frequently engaged in in Room 1 of St. Francis Hall (directly above Lil&rsquo; Calabria.  Some Dick Tag MVP&rsquo;s would be Joshua Peterson and Nicholas Wingate, Steve Storey and Greg Polley </div>
            <div><strong>The Hog call</strong> - this call signals the appearance of a considerably large female (usually at least 300 lbs. unless she is particularly detested)  One form of the call is accomplished by holding one open hand next to the mouth while using a deep voice to forcefully call out a word very similar in sound to the word &ldquo;song&rdquo; preceded by a whistle.  The other form of the hog call called the double hog call is made simply by blowing air out the mouth with the lips tightly pressed together indirectly mimicking the sound of flatulence.  This is yet another contribution by the famous Mike Mazzio</div>
            <div><strong>&ldquo;Twenty pounds of potatoes (shit) in a five pound bag&rdquo;</strong> - a phrase which refers to overweight girls who choose to punish male onlookers by wearing small or tight clothing </div>
            <div><strong>&ldquo;Like stink on a monkey&rdquo; &ldquo;Like white on rice&rdquo;</strong> - A phrase used by Mark Streiff with no apparent meaning but which elicits laughter to those who hear him use it. </div>
            <div><strong>&ldquo;Consider the source&rdquo;</strong> - One of many quotes from the legendary film Gotti staring Armand Asante</div>
            <div><strong>&ldquo;Bust ass&rdquo;</strong> - to emit flatulence.  Contributed by Billy Weber </div>
            <div><strong>The Beer Wall</strong> - A renowned monument to the exploration of the various manifestations of the brewing of barley and hops.  Consisting of over 300 different cardboard beer cases placed around the border of the inner walls of Lil&rsquo; Calabria, it is the single greatest accomplishment in all of Christendom History and is a testimony to the dedication and frequent inebriation of the dwellers of St. Francis Hall Basement </div>
           
        </td>
        </tr>
        </table>
       </td>
        
    </tr>
</table>

<?php 		
		
		include($_SERVER['DOCUMENT_ROOT']."/lib/includes/footer.php"); 
?>
