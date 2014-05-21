<div class="menu" id="menu">

	<ul>
    
        <li <? if ($page == 'home') echo 'class="active"'; ?> id="homeMenu"><a href="<?=( !empty($_SESSION['homeLink']) ? $_SESSION['homeLink'] : "/" );?>"><br />Home</a></li>
       
		<li <? if ($page == 'how-can-a-family-lawyer-help') echo 'class="active"'; ?> id="imp">
        <ul id="submenu_2">
        <li><a href="/can-i-do-it-myself/"><span>Can I do it myself?</a></li>
        <li><a href="/how-much-will-a-lawyer-cost/"><span>Legal Fees?</a></li>
        </ul>
        <a href="<?=BASE_URL;?>/how-can-a-family-lawyer-help/" title="How can a lawyer help?">How can <br />a lawyer help?</a>
        </li>
        
        <li <? if ($page == 'splitting-up') echo 'class="active"'; ?> id="imp">
        <ul id="submenu_3">
        <li><a href="/splitting-up-common-law/">Common Law</a></li>
        <li><a href="/splitting-up-same-sex-relationships/"><span>Same-Sex</a></li>
        </ul>
         <a href="<?=BASE_URL;?>/splitting-up/" title="Divorce"><br />Divorce</a>
        </li>
        
        <li <? if ($page == 'children') echo 'class="active"'; ?> id="imp">
        <ul id="submenu_4">
        <li><a href="/custody-and-access/">Custody and Access</a></li>
        <li><a href="/child-support/">Child Support</a></li>
		</ul>
		  <a href="<?=BASE_URL;?>/children/" title="Children"><br />Children</a>
        </li>
        
        <li <? if ($page == 'property-division') echo 'class="active"'; ?> id="imp">
        <ul id="submenu_5">
        <li><a href="/property-division-common-law/">Common Law</a></li>
        <li><a href="/separation-agreement/">Separation Agreement</a></li>
        <li><a href="/spousal-support/">Spousal Support</a></li>
        </ul>
        <a href="<?=BASE_URL;?>/property-division/" title="Property Division">Property <br />Division</a>
        </li>
        
        <li <? if ($page == 'domestic-contracts') echo 'class="active"'; ?> id="imp">
        <ul id="submenu_6">
        <li><a href="/why-have-a-contract/">Why have a domestic contract?</a></li>
        <li><a href="/making-a-valid-contract/">Making a Valid Contract</a></li>
        <li><a href="/independent-legal-advice/">Independent Legal Advice</a></li>
        </ul>
        <a href="<?=BASE_URL;?>/domestic-contracts/" title="Domaestic Contracts">Domestic<br />Contracts</a>
        </li>
        
        <li <? if ($page == 'alternatives-to-court') echo 'class="active"'; ?> id="imp">
        <ul id="submenu_7">
        <li><a href="/collaborative-law/">Collaborative Law</a></li>
        </ul>
        <a href="<?=BASE_URL;?>/alternatives-to-court/" title="Mediation"><br />Mediation</a>
        </li> 
	</ul>
</div>
<div class="clear"></div>

