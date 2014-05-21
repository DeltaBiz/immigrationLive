<?

require_once "formInput.class.php";

class FormInputHidden extends FormInput 
{
	var $width;
	var $visible;
	
	function FormInputHidden($name = "", $value = "", $attributes = "", $visible = false) 
	{
		parent::FormInput("", $name, $value, $datatype, $attributes);
	
		$this->width = $width;
		$this->visible = $visible;
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
		{
			if ( $this->visible )
				return parent::toHtml("text");
			else
				return parent::toHtml("hidden");
		}
		else
			return $value;
	}
}

?>