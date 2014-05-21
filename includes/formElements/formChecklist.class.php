<?

require_once "formInput.class.php";

class FormChecklist extends FormInput  
{
	var $width;
	var $height;
	var $valignLabel;
	var $options;
	var $values;
	
	function FormChecklist($label = "", $name = "", $options = array(), $values = "", $datatype = "", $width = 300, $height = 100, $attributes = "")
	{
		parent::FormInput($label, $name, "", $datatype, $attributes);
	
		$this->options = $options;
		$this->values = $values;
		$this->width = $width;
		$this->height = $height;
		$this->valignLabel = "top";
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
		{
			$output = "<div class='formInput frame smaller'";
			
			if ( !empty( $this->width ) && !empty( $this->height ))
				$output .= " style='overflow: auto; padding: 5px; width: " . $this->width . "px; height: " . $this->height . "px;'";
			if ( !empty( $this->attributes ))
				$output .= " " . $this->attributes;
			if ( !empty( $this->datatype ))
				$output .= " datatype='" . $this->datatype . "'";
			
			$output .= " id='" . $this->name . "'";
			$output .= ">";
			
			if ( !is_array( $this->values ) )
				$this->values = array( $this->values . "" );
				
			$valuesAsKeys = array_fill_keys( $this->values, "test" );
			
			$optionsAsKeys = array();
			foreach( $this->options as $option )
				$optionsAsKeys[$option['key']] = $option['value'];
			
			$intersectKeys = array_intersect_key( $optionsAsKeys, $valuesAsKeys );

			$output .= "<div><input id='" . $this->name . "All' name='" . $this->name . "All' type='checkbox' value='0' " . ( count( $intersectKeys ) >= count( $this->options ) ? "checked='checked'" : "" ) . " onclick='_this = this; document.getElementsByClassName(\"" . $this->name . "Class\").each( function(el){ el.checked = _this.checked } );' /> <b>All</b></div>";
			
			foreach( $this->options as $key => $option )
			{
				if ( is_array( $option ) )
				{
					$key = $option['key'];
					$option = $option['value'];
				}
					
				$output .= "<div><input name='" . $this->name . "[]' class='" . $this->name . "Class' type='checkbox' value='" . $key . "' " . ( !empty( $this->values ) && in_array( $key, $this->values ) ? "checked='checked'" : "" ) . " onclick='if ( this.checked ) { var allChecked = true; document.getElementsByClassName(\"" . $this->name . "Class\").each( function(el){ allChecked = allChecked && el.checked } ); } else { var allChecked = this.checked } $(\"" . $this->name . "All\").checked = allChecked;' > "  . $option . "</div>";
			}
			$output .= "</div></div>";
			
			return $output;
		}
		else
			return $value;
	}
}

?>