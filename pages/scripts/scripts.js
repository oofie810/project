	function validate(evt) {
	    var theEvent = evt || window.event;
	    var key = theEvent.keyCode || theEvent.which;
	    key = String.fromCharCode( key );			
	    var regex = /[0-9]|\./;
	
	    if( !regex.test(key) ) {
    		theEvent.returnValue = false;								
		if(theEvent.preventDefault) theEvent.preventDefault();				
		} 
	}

  function newRowForImages(list){
    var nli = document.createElement('li');
    var nliChild  = document.createElement('input');
    nliChild.type = 'file';
    nliChild.name = 'picture[]';

    var nliChild2 = document.createElement('input');
    nliChild2.type = 'text';
    nliChild2.size = '44';
    nliChild2.name = 'caption[]';

    nli.appendChild(nliChild);
    nli.appendChild(nliChild2);

    document.getElementById(list).appendChild(nli);
  }

	function newRow(list, js_array, idArray){
	    var nli = document.createElement('li');
	    var nliChild  = document.createElement('input');
	    nliChild.type = 'text';
	    nliChild.size = '5';
	    nliChild.name = 'amount[]';
	    nliChild.id   = 'amount';
	    nliChild.onkeypress = function() {validate(event)};
	    
	    var nliChild2  = document.createElement('select');
	    nliChild2.name = 'unit[]';
	    nliChild2.id   = 'unit';

	    for (var i=0; i < js_array.length; i++){
        var options_i = document.createElement('option');
        options_i.label = js_array[i];
        options_i.value = idArray[i];
        nliChild2.appendChild(options_i);
      }	

	    var nliChild3  = document.createElement('input');
	    nliChild3.type = 'text';
	    nliChild3.size = '44';
	    nliChild3.name = 'ingredients[]';
      nliChild3.className = 'ing';

	    nli.appendChild(nliChild);
	    nli.appendChild(nliChild2);
	    nli.appendChild(nliChild3);
	    
	    document.getElementById(list).appendChild(nli);	
  } 

  function validateNonEmpty(inputField, helpText){
    if (inputField.value.length == 0){
      if (helpText != null)
        helpText.innerHTML = "Can not be blank.";
      return false;
    } else{
      if (helpText != null)
        helpText.innerHTML = "";
      return true;
    }

  }




