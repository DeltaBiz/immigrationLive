<?

class FormLabel
{
	var $label;
	var $expand;

	function FormLabel($label = "", $expand = true )
	{
		$this->label = $label;
		$this->expand = $expand;
	}

	function toHtml($type, $width = "")
	{
		return "";
	}
}

?>