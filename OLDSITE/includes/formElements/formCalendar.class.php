<?

require_once "formInput.class.php";

class FormCalendar extends FormInput 
{
	function FormCalendar($label = "", $name = "", $value = "") 
	{
		parent::FormInput($label, $name, $value);
	}
	
	function toHtml($edit = true) 
	{
		if ( $edit )
		{
		 	$output = "<table cellspacing='0' border='0' cellpadding='0'>";
			$output .= "<tr>";
				$output .= "<td><span id='calendar_" . $this->name . "'></span></td>";
				$output .= "<td style='padding-left: 3px;'><a href='javascript: GUICalendar(\"" . $this->name . "\");'><img style='border: 0px;' src='http://innoventureconsultants.com/resForm/images/calendar.gif' /></a></td>";
			$output .= "</tr>";
			$output .= "<tr>";
				$output .= "<td><div id='calendar_" . $this->name . "_GUIanchor'><img src='../images/spacer.gif' height='1' width='1' /></div></td>";
			$output .= "</tr>";
			$output .= "</table>";
			
			$output .= "<script>" . "\n";
				$output .= "fillCalendar('" . $this->name . "');" . "\n";
				$output .= "changeNights();" . "\n";
				$output .= "document.write( GUICalendarTemplate() );\n";
			$output .= "</script>" . "\n";

			return $output;
		}
		else
			return nl2br($value);
	}
}

?>