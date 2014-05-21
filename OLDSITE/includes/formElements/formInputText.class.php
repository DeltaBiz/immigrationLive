<?

require_once "formInput.class.php";

class FormInputText extends FormInput 
{
	var $width;
	
	function FormInputText($label = "", $name = "", $value = "", $datatype = "", $width = 225, $attributes = "") 
	{
		parent::FormInput($label, $name, $value, $datatype, $attributes);
	
		$this->width = $width;
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
			return parent::toHtml("text", $this->width );
		else
			return $value;
	}
}

?>