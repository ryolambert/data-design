<?php
namespace Ryolambert\Datadesign\Classes;
require_once ("autoloader.php");
require_once (dirname(__DIR__,2) . "../vendor/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 * Cross Section of a Medium Profile
 *
 * This is a cross section of what is probably stored about a Medium user. This entity is a top level entity that
 * holds the keys to the other entities in this example (i.e., Favorite and Profile).
 *
 * @author James Ryotaro Lambert <ryolambert@gmail.com>
 * @version 4.0.0
 **/
class Profile {
	use ValidateUuid;
	/**
	 * id for this Profile; this is the primary key
	 * @var Uuid $profileId
	 **/

	/**
	 * id for this Profile; this is the primary key
	 * @var Uuid $profileId
	 **/
	private $profileId;

	/** activation token unique to user for verification
	 * @var $profileActivationToken
	 **/
	private $profileActivationToken;

	/**
	 *  first name for the Profile that wrote the article or clapped one
	 * @var string $profileFirstName
	 **/
	private $profileFirstName;

	/**
	 *  last name for the Profile that wrote the article or clapped one
	 * @var string $profileLastName
	 **/
	private $profileLastName;

	/**
	 * email for Profile user
	 * @var string $profileEmail
	 **/
	private $profileEmail;

	/**
	 * hash for Profile
	 * @var $profileHash
	 */
	private $profileHash;

	/**
	 * salt for profile password
	 *
	 * @var $profileSalt
	 */
	private $profileSalt;

	public function __construct($newProfileId, ?string $newProfileActivationToken, string $newProfileFirstName, string $newProfileLastName, string $newProfileEmail, string $newProfileHash, string $newProfileSalt) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileFirstName($newProfileFirstName);
			$this->setProfileLastName($newProfileLastName);
			$this->setProfileHash($newProfileHash);
			$this->setProfileSalt($newProfileSalt);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @ return Uuid value of profile id (or null if new Profile)
	 **/
	public function getProfileId(): Uuid {
		return ($this->profileId);
	}
	/**
	 * mutator method for profile id
	 *
	 * @param  Uuid| string $newProfileId value of new profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if the profile Id is not
	 **/
	public function setProfileId( $newProfileId): void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileId = $uuid;
	}
	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token
	 */
	public function getProfileActivationToken() : ?string {
		return ($this->profileActivationToken);
	}
	/**
	 * mutator method for account activation token
	 *
	 * @param string $newProfileActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setProfileActivationToken(?string $newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}
		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->profileActivationToken = $newProfileActivationToken;
	}

	/**
	 * accessor method for at first name
	 *
	 * @return string value of at first name
	 **/
	public function getProfileFirstName(): string {
		return ($this->profileFirstName);
	}

	/**
	 * mutator method for at first name
	 *
	 * @param string $newProfileFirstName new value of at first name
	 * @throws \InvalidArgumentException if $newFirstName is not a string or insecure
	 * @throws \RangeException if $newFirstName is > 32 characters
	 * @throws \TypeError if $newFirstName is not a string
	 **/
	public function setProfileFirstName(string $newProfileFirstName) : void {
		// verify the at first name is secure
		$newProfileFirstName = trim($newProfileFirstName);
		$newProfileFirstName = filter_var($newProfileFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileFirstName) === true) {
			throw(new \InvalidArgumentException("profile at first name is empty or insecure"));
		}
		// verify the at first name will fit in the database
		if(strlen($newProfileFirstName) > 32) {
			throw(new \RangeException("profile at first name is too large"));
		}
		// store the at first name
		$this->profileFirstName = $newProfileFirstName;
	}

	/**
	 * accessor method for at last name
	 *
	 * @return string value of at last name
	 **/
	public function getProfileLastName(): string {
		return ($this->profileLastName);
	}

	/**
	 * mutator method for at last name
	 *
	 * @param string $newProfileLastName new value of at last name
	 * @throws \InvalidArgumentException if $newLastName is not a string or insecure
	 * @throws \RangeException if $newLastName is > 32 characters
	 * @throws \TypeError if $newLastName is not a string
	 **/
	public function setProfileLastName(string $newProfileLastName) : void {
		// verify the at last name is secure
		$newProfileLastName = trim($newProfileLastName);
		$newProfileLastName = filter_var($newProfileLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileLastName) === true) {
			throw(new \InvalidArgumentException("profile at last name is empty or insecure"));
		}
		// verify the at last name will fit in the database
		if(strlen($newProfileLastName) > 32) {
			throw(new \RangeException("profile last name is too large"));
		}
		// store the at last name
		$this->profileLastName = $newProfileLastName;
	}

	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getProfileEmail(): string {
		return $this->profileEmail;
	}

	/**
	 * mutator method for email
	 *
	 * @param string $newProfileEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setProfileEmail(string $newProfileEmail): void {
		// verify the email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("profile email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}
		// store the email
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * accessor method for profileHash
	 *
	 * @return string value of hash
	 */
	public function getProfileHash(): string {
		return $this->profileHash;
	}

	/**
	 * mutator method for profile hash password
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setProfileHash(string $newProfileHash): void {
		//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		$profileHashInfo = password_get_info($newProfileHash);
		if($profileHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("profile hash is not a valid hash"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newProfileHash) !== 97) {
			throw(new \RangeException("profile hash must be 97 characters"));
		}
		//store the hash
		$this->profileHash = $newProfileHash;
	}

	/**
	 *accessor method for profile salt
	 *
	 * @return string representation of the salt hexadecimal
	 */
	public function getProfileSalt(): string {
		return $this->profileSalt;
	}

	/**
	 * mutator method for profile salt
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if the salt is not secure
	 * @throws \RangeException if the salt is not 64 characters
	 * @throws \TypeError if the profile salt is not a string
	 **/
	public function setProfileSalt(string $newProfileSalt): void {
		//enforce that the salt is properly formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);
		//enforce that the salt is the string representation of a hexadecimal
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		if(strlen($newProfileSalt) !== 64) {
			throw(new \RangeException("profile salt must be 128 characters"));
		}
		//stores the hash
		$this->profileSalt = $newProfileSalt;
	}
	/**
	 * inserts this Profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {
		//create query template
		$query = "INSERT INTO profile(profileId, profileActivationToken, profileFirstName, profileLastName, profileEmail, profileHash, profileSalt) VALUES (:profileId, :profileActivationToken, :profileFirstName, :profileLastName, :profileEmail, :profileHash, :profileSalt)";
		$statement = $pdo->prepare($query);
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileFirstName" => $this->profileFirstName, "profileLastName" => $this->profileLastName, "profileEmail" => $this->profileEmail, "profileHash" => $this->profileHash, "profileSalt" => $this->profileSalt];
		$statement->execute($parameters);
	}

	public function delete(\PDO $pdo): void {
		//create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);
		//binds the member variables to the place holders in the template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}

/*
 * TODO
 * 1. setProfileSalt
 * 2. insert
 * 3. delete
 * 4. update
 * 5. getProfileByProfileId
 * 6. getProfileByProfileEmail
 * 7. getProfileByProfileFirstName
 * 8. getProfileByProfileLastName
 * 9. getProfileByProfileActivationToken
 * 10. jsonSerialize
 */

 
}