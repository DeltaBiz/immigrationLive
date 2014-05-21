<?

require_once "formInput.class.php";

class FormSelect extends FormInput 
{
	var $options;
	
	function FormSelect($label = "", $name = "", $options = array(), $value = "", $datatype = "", $attributes = "" ) 
	{
		parent::FormInput($label, $name, $value, $datatype, $attributes);
	
		$this->options = $options;
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
		{
			$output = "<select class='formInput'";
			
			if ( !empty( $this->attributes ))
				$output .= " " . $this->attributes;
			if ( !empty( $this->datatype ))
				$output .= " datatype='" . $this->datatype . "'";
			
			$output .= " name='" . $this->name . "'";
			$output .= " id='" . $this->name . "'";
			$output .= ">";
			
			foreach( $this->options as $key => $option )
			{
				if ( is_array( $option ) )
				{
					$key = $option['key'];
					$option = $option['value'];
				}
				
				$output .= "<option value='" . $key . "' " . ( !empty( $this->value ) && $key == $this->value ? "SELECTED" : "" ) . ">" . $option . "</option>";
			}
			$output .= "</select>";
			
			return $output;
		}
		else
			return $value;
	}
}

?>