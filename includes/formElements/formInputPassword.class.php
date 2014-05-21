<?

require_once "formInput.class.php";

class FormInputPassword extends FormInput 
{
	var $width;
	
	function FormInputPassword($label = "", $name = "", $value = "", $datatype = "", $attributes = "") 
	{
		parent::FormInput($label, $name, $value, $datatype, $attributes);
	
		$this->width = $width;
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
			return parent::toHtml("password", $this->width );
		else
			return $value;
	}
}

?>