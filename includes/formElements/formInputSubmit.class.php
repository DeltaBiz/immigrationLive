<?

require_once "formInput.class.php";

class FormInputSubmit extends FormInput 
{
	function FormInputSubmit($name = "", $label = "", $value = "", $datatype = "", $attributes = "") 
	{
		parent::FormInput($name, $label, $value, $datatype, $attributes);
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
			return parent::toHtml("submit" );
		else
			return $value;
	}
}

?>