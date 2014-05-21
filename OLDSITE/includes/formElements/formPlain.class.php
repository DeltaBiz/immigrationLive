<?

class FormPlain
{
	var $label;
	var $value;

	function FormPlain($label = "", $value = "" )
	{
		$this->label = $label;
		$this->value = $value;
	}

	function toHtml($type, $width = "")
	{
		return $this->value;
	}
}

?>