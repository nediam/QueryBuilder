<?php namespace QueryBuilder;

/**
 * Kohana exception class. Translates exceptions using the [I18n] class.
 *
 * @package    Kohana
 * @category   Exceptions
 * @author     Kohana Team
 * @copyright  (c) 2008-2010 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Database_Exception extends \Exception {

	/**
	 * Creates a new translated exception.
	 *
	 *     throw new Kohana_Exception('Something went terrible wrong, :user',
	 *         array(':user' => $user));
	 *
	 * @param   string          error message
	 * @param   array           translation variables
	 * @param   integer|string  the exception code
	 * @return  void
	 */
	public function __construct($message, array $variables = NULL, $code = 0)
	{
		// Set the message
		//$message = __($message, $variables);
		$message = $message . ' '. print_r($variables, true);

		// Pass the message and integer code to the parent
		parent::__construct($message, (int) $code);

		// Save the unmodified code
		// @link http://bugs.php.net/39615
		$this->code = $code;
	}

	/**
	 * Magic object-to-string method.
	 *
	 *     echo $exception;
	 *
	 * @uses    Kohana::exception_text
	 * @return  string
	 */
	public function __toString()
	{
		return exception_text($this);
	}

} // End Kohana_Exception


function exception_text(\Exception $e)
{
	return sprintf('%s [ %s ]: %s ~ %s [ %d ]',
		get_class($e), $e->getCode(), strip_tags($e->getMessage()), $e->getFile(), $e->getLine());
}