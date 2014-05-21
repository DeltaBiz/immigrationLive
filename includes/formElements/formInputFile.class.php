<?

require_once "formInput.class.php";

class FormInputFile extends FormInput 
{
	var $width;
	var $isImage;
	
	function FormInputFile($label = "", $name = "", $value = "", $datatype = "", $width = 224, $attributes = "") 
	{
		parent::FormInput($label, $name, $value, $datatype, $attributes);
		
		$this->width = $width;
		$this->isImage = true;
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
			return parent::toHtml("file", $this->width );
		else
			return $value;
	}
}

?>