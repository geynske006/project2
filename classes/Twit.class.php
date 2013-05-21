<?php
require_once('twitterConn.class.php');
class Twit
{
	// PRIVATE MEMBER VARIABLES
	private $m_sText;
	private $m_iUserId;

	public function __set($p_sProperty, $p_vValue)
	{
		switch($p_sProperty)
		{
			case "Text":
				if(strlen($p_vValue) > 140)
				{
					throw new Exception("A tweet can be no longer than 50 characters.");
				}
				else
				{
					$this->m_sText = $p_vValue;
				}
			break;

			case "UserId":
				$this->m_iUserId = $p_vValue;
			break;

			default: echo "can't find property named " . $p_sProperty;
		}
	}

	public function Save()
	{
		$db = twitterConn::getInstance();
		$table = "tweets";
		$cols = array("text", "fk_user_id", "date_posted");
		$values = array($this->m_sText, $this->m_iUserId, "NOW()");
		$db->insert($table, $cols, $values);
	}

	public function GetAll()
	{
		$db = twitterConn::getInstance();
		$cols = array("*");
		$result = $db->select($cols, "tweets", null, "id", "DESC");
		return($result);
	}

}
?>