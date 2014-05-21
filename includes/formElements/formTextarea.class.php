<?

require_once "formInput.class.php";

class FormTextarea extends FormInput 
{
	var $width;
	var $height;
	var $valignLabel;
	
	function FormTextarea($label = "", $name = "", $value = "", $datatype = "", $width = 300, $height = 40, $attributes = "") 
	{
		parent::FormInput($label, $name, $value, $datatype, $attributes);
	
		$this->width = $width;
		$this->height = $height;
		$this->valignLabel = "top";
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
		{
			$output .= "<textarea class='formInput'";
			
			if ( !empty( $this->width ) && !empty( $this->height ))
				$output .= " style='width: " . $this->width . "px; height: " . $this->height . "px;'";
			if ( !empty( $this->attributes ))
				$output .= " " . $this->attributes;
			if ( !empty( $this->datatype ))
				$output .= " datatype='" . $this->datatype . "'";
			
			$output .= " name='" . $this->name . "'";
			$output .= " id='" . $this->name . "'";
			$output .= ">";
			$output .= $this->value;
			$output .= "</textarea>";
			
			return $output;
		}
		else
			return nl2br($value);
	}
}

?>