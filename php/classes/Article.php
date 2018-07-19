<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoloader.php");
require_once (dirname(__DIR__,2) . "../vendor/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 * Cross Section of a Medium Article
 *
 * This is a cross section of what is probably stored about a Medium user. This entity is a top level entity that
 * holds the keys to the other entities in this example (i.e., Favorite and Article).
 *
 * @author James Ryotaro Lambert <ryolambert@gmail.com>
 * @version 4.0.0
 **/
class Article {
	use ValidateUuid;
	/**
	 * id for this Article; this is the primary key
	 * @var Uuid $ArticleId
	 **/

	/**
	 * id for this Article; this is the primary key
	 * @var Uuid $ArticleId
	 **/
	private $ArticleId;

	/**
	 *  first name for the Article that wrote the article or clapped one
	 * @var string $ArticleFirstName
	 **/
	private $ArticleFirstName;

	/**
	 *  last name for the Article that wrote the article or clapped one
	 * @var string $ArticleLastName
	 **/
	private $ArticleLastName;

	/** activation token unique to user for verification
	 * @var $ArticleActivationToken
	 **/
	private $ArticleActivationToken;

	/**
	 * email for Article user
	 * @var string $ArticleEmail
	 **/
	private $ArticleEmail;

	/**
	 * hash for Article
	 * @var $ArticleHash
	 */
	private $ArticleHash;

	/**
	 * salt for Article password
	 *
	 * @var $ArticleSalt
	 */
	private $ArticleSalt;

	/**
	 * accessor method for Article id
	 *
	 * @ return Uuid value of Article id (or null if new Article)
	 **/
	public function getArticleId(): Uuid {
		return ($this->ArticleId);
	}
	/**
	 * mutator method for Article id
	 *
	 * @param  Uuid| string $newArticleId value of new Article id
	 * @throws \RangeException if $newArticleId is not positive
	 * @throws \TypeError if the Article Id is not
	 **/
	public function setArticleId( $newArticleId): void {
		try {
			$uuid = self::validateUuid($newArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the Article id
		$this->ArticleId = $uuid;
	}
	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token
	 */
	public function getArticleActivationToken() : ?string {
		return ($this->ArticleActivationToken);
	}
	/**
	 * mutator method for account activation token
	 *
	 * @param string $newArticleActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setArticleActivationToken(?string $newArticleActivationToken): void {
		if($newArticleActivationToken === null) {
			$this->ArticleActivationToken = null;
			return;
		}
		$newArticleActivationToken = strtolower(trim($newArticleActivationToken));
		if(ctype_xdigit($newArticleActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newArticleActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->ArticleActivationToken = $newArticleActivationToken;
	}

	/**
	 * accessor method for at first name
	 *
	 * @return string value of at first name
	 **/
	public function getArticleFirstName(): string {
		return ($this->ArticleFirstName);
	}

	/**
	 * mutator method for at first name
	 *
	 * @param string $newArticleFirstName new value of at first name
	 * @throws \InvalidArgumentException if $newFirstName is not a string or insecure
	 * @throws \RangeException if $newFirstName is > 32 characters
	 * @throws \TypeError if $newFirstName is not a string
	 **/
	public function setArticleFirstName(string $newArticleFirstName) : void {
		// verify the at first name is secure
		$newArticleFirstName = trim($newArticleFirstName);
		$newArticleFirstName = filter_var($newArticleFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleFirstName) === true) {
			throw(new \InvalidArgumentException("Article at first name is empty or insecure"));
		}
		// verify the at first name will fit in the database
		if(strlen($newArticleFirstName) > 32) {
			throw(new \RangeException("Article at first name is too large"));
		}
		// store the at first name
		$this->ArticleFirstName = $newArticleFirstName;
	}

	/**
	 * accessor method for at last name
	 *
	 * @return string value of at last name
	 **/
	public function getArticleLastName(): string {
		return ($this->ArticleLastName);
	}

	/**
	 * mutator method for at last name
	 *
	 * @param string $newArticleLastName new value of at last name
	 * @throws \InvalidArgumentException if $newLastName is not a string or insecure
	 * @throws \RangeException if $newLastName is > 32 characters
	 * @throws \TypeError if $newLastName is not a string
	 **/
	public function setArticleLastName(string $newArticleLastName) : void {
		// verify the at last name is secure
		$newArticleLastName = trim($newArticleLastName);
		$newArticleLastName = filter_var($newArticleLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleLastName) === true) {
			throw(new \InvalidArgumentException("Article at last name is empty or insecure"));
		}
		// verify the at last name will fit in the database
		if(strlen($newArticleLastName) > 32) {
			throw(new \RangeException("Article at last name is too large"));
		}
		// store the at last name
		$this->ArticleLastName = $newArticleLastName;
	}

	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getArticleEmail(): string {
		return $this->ArticleEmail;
	}

	/**
	 * mutator method for email
	 *
	 * @param string $newArticleEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setArticleEmail(string $newArticleEmail): void {
		// verify the email is secure
		$newArticleEmail = trim($newArticleEmail);
		$newArticleEmail = filter_var($newArticleEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newArticleEmail) === true) {
			throw(new \InvalidArgumentException("Article email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newArticleEmail) > 128) {
			throw(new \RangeException("Article email is too large"));
		}
		// store the email
		$this->articleEmail = $newArticleEmail;
	}

	/**
	 * accessor method for ArticleHash
	 *
	 * @return string value of hash
	 */
	public function getArticleHash(): string {
		return $this->ArticleHash;
	}

	/**
	 * mutator method for Article hash password
	 *
	 * @param string $newArticleHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if Article hash is not a string
	 */
	public function setArticleHash(string $newArticleHash): void {
		//enforce that the hash is properly formatted
		$newArticleHash = trim($newArticleHash);
		if(empty($newArticleHash) === true) {
			throw(new \InvalidArgumentException("Article password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		$ArticleHashInfo = password_get_info($newArticleHash);
		if($ArticleHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("Article hash is not a valid hash"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newArticleHash) !== 97) {
			throw(new \RangeException("Article hash must be 97 characters"));
		}
		//store the hash
		$this->ArticleHash = $newArticleHash;
	}


}