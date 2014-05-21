<?

class FormInput
{
	var $label;
	var $name;
	var $value;
	var $datatype;
	var $attributes;
	var $extraCol;

	function FormInput($label = "", $name = "", $value = "", $datatype = "", $attributes = "" )
	{
		$this->name 		= $name;
		$this->label		= $label;
		$this->value 		= $value;
		$this->datatype 	= $datatype;
		$this->attributes = $attributes;
		$this->extraCol   = "";
	}

	function toHtml($type, $width = "")
	{
		$output .= "<input type='" . $type . "' class='formInput'";
		
		if ( !empty( $width ))
			$output .= " style='width: " . $width . "px;'";
		if ( !empty( $this->attributes ))
			$output .= " " . $this->attributes;
		if ( !empty( $this->datatype ))
			$output .= " datatype='" . $this->datatype . "'";
		if ( !empty( $this->name ))
		{
			$output .= " name='" . $this->name . "'";
			$output .= " id='" . $this->name . "'";
		}

		$output .= " value='" . htmlentities( $this->value, ENT_QUOTES ) . "'";
		$output .= " />";
		
		return $output;
	}
}

?>