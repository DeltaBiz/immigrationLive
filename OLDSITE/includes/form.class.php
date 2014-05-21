<?

require_once "formElements/formInputText.class.php";
require_once "formElements/formInputPassword.class.php";
require_once "formElements/formInputHidden.class.php";
require_once "formElements/formInputFile.class.php";
require_once "formElements/formInputSubmit.class.php";
require_once "formElements/formTextarea.class.php";
require_once "formElements/formCalendar.class.php";
require_once "formElements/formSelect.class.php";
require_once "formElements/formLabel.class.php";
require_once "formElements/formChecklist.class.php";
require_once "formElements/formPlain.class.php";


class Form
{
	var $name;
	var $method;
	var $action;
	var $attributes;
	var $ajax;
	var $hideAfter;
	var $hideable;
	var $validate;
	var $submit;
	var $elements;
	var $hasImage;
	var $validationFunction;
	
	function Form( $action = "", $method = "post", $name = "", $attributes = "", $ajax = false, $hideAfter = false )
	{
		$this->name = $name;
		$this->method = $method;
		$this->action = $action;
		$this->attributes = $attributes;
		$this->ajax = $ajax;
		$this->hideAfter = $hideAfter;
		$this->hideable = $hideAfter;
		$this->validate = true;
		$this->elements = array();
		$this->hasImage = false;
		$this->validationFunction = "";
		$this->submit = true;
	}
	
	function add( $element )
	{
		$this->elements[] = $element;
		
		if ( $element->isImage )
			$this->hasImage = true;	
	}
	
	function toHTML( $padding = "", $tableMargin = "", $edit = true )
	{
		$output = "";
		
		if ( empty( $padding ) )
			$padding = "1px 5px 2px 5px";

		if ( !empty ( $this->hideable ) )
		{
			if ( !empty( $this->name ) )
			{
				$title = implode(" ", array_slice( explode( " ", fieldToTitle( $this->name ) ), 1 ) );
				$output .= "<a href='javascript: Element.show(\"" . $this->name . "Holder\");' class='link'>Add " . $title . "</a><br />" . "\n";
			}
		}


		$output .= "<div " . ( empty( $this->name ) ? "" : "id='" . $this->name . "Holder' " ) . " " . ( empty( $this->hideable ) ? "" : "style='display: none;'" ) . ">" . "\n";
		
		$output .= "<form " . ( empty( $this->action ) ? "" : "action='" . $this->action . "'" ) . " " . ( empty( $this->method ) ? "" : "method='" . $this->method . "'" ) . " " . ( empty( $this->name ) ? "" : "id='" . $this->name . "Form'" ) . " " . ( empty( $this->attributes ) ? "" : $this->attributes ) . " " . ( $this->hasImage ? "enctype='multipart/form-data'" : "" ) . " onsubmit='return formHandler(this, " . ( $this->validate ? "true" : "false" ) . ", " . ( $this->ajax ? "true" : "false" ) . ") && " . ( empty( $this->validationFunction ) ? ( $this->submit ? "true" : "false" ) : $this->validationFunction ) . ";'>" . "\n";

		if ( !empty ( $this->hideable ) )
		{
			$output .= "<input type='hidden' name='keyId' value='' />" . "\n";
			$output .= "<input type='hidden' name='table' value='' />" . "\n";
			
			if ( !empty ( $this->hideAfter ) )
				$output .= "<input type='hidden' name='hideAfter' value='1' />" . "\n";
			
			if ( !empty( $this->name ) )
				$output .= "<a class='closeButton' id='" . $this->name . "CloseButton' href='javascript: Element.hide(\"" . $this->name . "Holder\"); $(\"" . $this->name . "Form\").reset();'>Close</a>";
		}
			
		$output .= "<table cellspacing='0' cellpadding='0' border='0' " . ( empty( $tableMargin ) ? "" : "style='margin:" . $tableMargin . "'" ) . ">" . "\n";
		
		foreach( $this->elements as $element )
		{
			$valueExtra = "";
			
			if ( !is_array( $element ) && $element->expand )
				$output .= "<tr><td style='text-align: left;" . ( empty( $padding ) ? "" : " padding: " . $padding . ";" ) . "' colspan='2'>" . $element->label . "</td></tr>" . "\n";
			else
			{
				$output .= "<tr>";
				
				$masterElement = $elementContents = "";
				
				if ( is_array( $element ) )
				{
					foreach( $element as $innerElement )
					{
						if ( empty( $masterElement ) )
							$masterElement = $innerElement;
						
						$elementContents .= $innerElement->toHTML($edit);
					}
				}
				else
				{
					$masterElement = $element;
					$elementContents = $element->toHTML($edit);
				}
				
				if ( $masterElement->label != "-" )
				 	$output .= "<td style='" . ( empty( $masterElement->valignLabel ) ? "" : "vertical-align: " . $masterElement->valignLabel . "; " ) . "text-align: right;" . ( empty( $padding ) ? "" : " padding: " . $padding . ";" ) . "'>" . $masterElement->label . "</td>";
				else
					$valueExtra = "colspan='2'";
					
				$output .= "<td " . ( empty( $padding ) ? "" : "style='padding: " . $padding . ";'" ) . " " . $valueExtra . ">" . $elementContents . "</td></tr>" . "\n";
			}
		}
		
		$output .= "</table>" . "\n";
		$output .= "</form>" . "\n";
		$output .= "</div>" . "\n";
		
		return $output;
	}
}