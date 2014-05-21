// JavaScript Document


function scrollVertical(value, element, slider) {

	element.scrollTop = Math.round(value/slider.maximum*(element.scrollHeight-element.offsetHeight));

}

function showAddress(zip, address, title) {

  geocoder.getLatLng(

    zip,

    function(point) {

      if (!point) {

        alert(address + " not found");

      } else {

        map.setCenter(point, 13);

        var marker = new GMarker(point);

        map.addOverlay(marker);

        marker.openInfoWindowHtml(title+'<p>'+address+'</p>');

      }

    }

  );

}


function showAddress2(zip, address, title) {

  geocoder.getLatLng(

    zip,

    function(point) {

      if (!point) {

        alert(address + " not found");

      } else {

        map.setCenter(point, 13);

        var marker = new GMarker(point);

        map.addOverlay(marker);

        //marker.openInfoWindowHtml(title+'<p>'+address+'</p>');

      }

    }

  );

}
function getTerm() {
	if($('term_0') == null || $('term_0') == 'undefined' || $('term_0').innerHTML == '') {
		$('livesearch').innerHTML = 'It appears your location is not in our system. Perhaps try a larger town or city nearby. Once you see an acceptable location in this list click enter to see lawyers in your area.';
		$('livesearch').show();
		return false;
	}
	else {
		$('liveTerm').value=$('term_0').innerHTML;
		location.href="/Impaired_Driving_Lawyers/"+$('prov_0').innerHTML+"/"+escape($('term_0').innerHTML)+"/";
		return false;
		}
		return false;
}
function getTerm2() {
	if($('term_0') == null || $('term_0') == 'undefined' || $('term_0').innerHTML == '') {
		$('livesearch2').innerHTML = 'It appears your location is not in our system. Perhaps try a larger town or city nearby. Once you see an acceptable location in this list click enter to see lawyers in your area.';
		$('livesearch2').show();
		return false;
	}
	else {
		$('liveTerm2').value=$('term_0').innerHTML;
		
		location.href="/Divorce_Family_Law_Lawyers/"+$('prov_0').innerHTML+"/"+escape($('term_0').innerHTML)+"/";
		return false;
		}
		return false;
}


function getTerm3() {
	if($('term_0') == null || $('term_0') == 'undefined' || $('term_0').innerHTML == '') {
		$('livesearch3').innerHTML = 'It appears your location is not in our system. Perhaps try a larger town or city nearby. Once you see an acceptable location in this list click enter to see lawyers in your area.';
		$('livesearch3').show();
		return false;
	}
	else {
		$('liveTerm3').value=$('term_0').innerHTML;
		location.href="/Divorce_Family_Law_Lawyers/"+$('prov_0').innerHTML+"/"+escape($('term_0').innerHTML)+"/";
		return false;
		}
		return false;
}

function showResult(searchTerm) {

	$('livesearch').show();
	new Ajax.Updater('livesearch', '/getCity.php?searchTerm='+searchTerm, { method: 'get' });		

}

function showResult2(searchTerm) {

	$('livesearch2').show();
	new Ajax.Updater('livesearch2', '/getCity.php?searchTerm='+searchTerm, { method: 'get' });		
}

function showResult3(searchTerm) {

	$('livesearch3').show();
	new Ajax.Updater('livesearch3', '/getCity.php?searchTerm='+searchTerm, { method: 'get' });		
}


function bookmark() {
	
	if (window.sidebar) { // firefox
		window.sidebar.addPanel(document.title, location.href,"");
	} 
	else if( document.all ) { //MSIE
		window.external.AddFavorite( location.href, document.title);
	} 
	else {
		alert("Sorry, your browser doesn't support this");
	}
}


