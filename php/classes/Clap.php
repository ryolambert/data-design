<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoloader.php");
require_once (dirname(__DIR__,2) . "../vendor/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 * Cross Section of a Medium clap
 *
 * This is a cross section of what is probably stored about a Medium user. This entity is a top level entity that
 * holds the keys to the other entities in this example (i.e., Favorite and clap).
 *
 * @author James Ryotaro Lambert <ryolambert@gmail.com>
 * @version 4.0.0
 **/
class clap implements \JsonSeriablizable {
	use ValidateDate;
	use ValidateUuid;

	/**
	 * id for this clap; this is the primary key
	 * @var Uuid $clapId
	 **/
	private $clapId;

	/** id for the clapper's Profile; this is a foreign key
	 * @var Uuid $clapProfileId
	 **/
	private $clapProfileId;

	/** id for the clap's Article; this is a foreign key
	 * @var Uuid $articleProfileId
	 **/
	private $clapArticleId;

	/**
	 * date and time this clap was posted, in a PHP DataTime object
	 * @var \DateTime $clapDate
	 */
	private $clapDate;

	/**
	 * number of claps user has applauded Article
	 * @var int $clapArticleId
	 */
	private $clapNumber;

	/**
	 * constructor for this clap
	 *
	 * @param string|Uuid $newClapId id of this clap or null if a new Clap
	 * @param string|Uuid $newClapProfileId id of the Profile that sent this clap
	 * @param string $newClapArticleId string containing actual clap data
	 * @param \DateTime|string|null $newClapDate date and time clap was sent or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newClapId, $newClapProfileId, string $newClapArticleId, $newClapDate = null) {
		try {
			$this->setClapId($newClapId);
			$this->setClapProfileId($newClapProfileId);
			$this->setClapArticleId($newClapArticleId);
			$this->setClapDate($newClapDate);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for clap id
	 * @return Uuid value of clap id
	 */
	public function getClapId(): Uuid {
		return ($this->clapId);
	}

	/**
	 * mutator method for clap id
	 *
	 * @param  Uuid| string $newClapId value of new Clap id
	 * @throws \RangeException if $newClapId is not positive
	 * @throws \TypeError if the clap Id is not
	 **/
	public function setClapId($newClapId): void {
		try {
			$uuid = self::validateUuid($newClapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the clap id
		$this->clapId = $uuid;
	}

	/**
	 * accessor method for clap profile id
	 *
	 * @return Uuid value of clap profile id
	 **/
	public function getClapProfileId(): Uuid {
		return ($this->clapProfileId);
	}

	/**
	 * mutator method for clap profile id
	 *
	 * @param string | Uuid $newClapProfileId new value of clap profile id
	 * @throws \RangeException if $newClapProfileId is not positive
	 * @throws \TypeError if $newClapProfileId is not an integer
	 **/
	public function setClapProfileId($newClapProfileId): void {
		try {
			$uuid = self::validateUuid($newClapProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the profile id
		$this->clapProfileId = $uuid;
	}

	/**
	 * accessor method for clap Article id
	 *
	 * @return Uuid value of clap Article id
	 **/
	public function getClapArticleId(): Uuid {
		return ($this->clapArticleId);
	}

	/**
	 * mutator method for clap Article id
	 *
	 * @param string | Uuid $newClapArticleId new value of clap Article id
	 * @throws \RangeException if $newClapArticleId is not positive
	 * @throws \TypeError if $newClapArticleId is not an integer
	 **/
	public function setClapArticleId($newClapArticleId): void {
		try {
			$uuid = self::validateUuid($newClapArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

// convert and store the Article id
		$this->clapArticleId = $uuid;
	}

	/**
	 * accessor method for clap date
	 *
	 * @return \DateTime value of clap date
	 **/
	public function getClapDate(): \DateTime {
		return ($this->clapDate);
	}

	/**
	 * mutator method for clap date
	 *
	 * @param \DateTime|string|null $newClapDate clap date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newClapDate is not a valid object or string
	 * @throws \RangeException if $newClapDate is a date that does not exist
	 **/
	public function setClapDate($newClapDate = null): void {
		// base case: if the date is null, use the current date and time
		if($newClapDate === null) {
			$this->clapDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newClapDate = self::validateDateTime($newClapDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->clapDate = $newClapDate;
	}

	/**
	 * accessor method for clap Number
	 *
	 * @return string value of clap Number
	 **/
	public function getClapNumber(): int {
		return ($this->clapNumber);
	}

	/**
	 * mutator method for clap Number
	 *
	 * @param int $newClapNumber new value of clap Number
	 * @throws \InvalidArgumentException if $newClapNumber is not an int or insecure
	 * @throws \RangeException if $newClapNumber is > 51 claps
	 * @throws \TypeError if $newClapNumber is not an int
	 **/
	public function setClapNumber(int $newClapNumber): void {
// verify the clap Number is secure
		$newClapNumber = trim($newClapNumber);
		$newClapNumber = filter_var($newClapNumber, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newClapNumber) === true) {
			throw(new \InvalidArgumentException("clap Number is empty or insecure"));
		}

// verify the clap Number will fit in the database
		if(strlen($newClapNumber) > 51) {
			throw(new \RangeException("clap Number too large"));
		}

// store the clap Number
		$this->clapNumber = $newClapNumber;
	}

	/**
	 * inserts this clap into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// create query template
		$query = "INSERT INTO clap(clapId,clapProfileId, clapArticleId, clapDate, clapNumber, clapNumber) VALUES(:clapId, :clapProfileId, :clapArticleId, :clapDate, :clapNumber)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->clapDate->format("Y-m-d H:i:s.u");
		$parameters = ["clapId" => $this->clapId->getBytes(), "clapProfileId" => $this->clapProfileId->getBytes(), "clapArticleId" => $this->clapArticleId, "clapDate" => $formattedDate, "clapNumber" => $this->clapNumber];
		$statement->execute($parameters);
	}


	/**
	 * deletes this clap from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM clap WHERE clapId = :clapId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["clapId" => $this->clapId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this clap in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {

		// create query template
		$query = "UPDATE clap SET clapProfileId = :clapProfileId, clapArticleId = :clapArticleId, clapDate, clapNumber = :clapDate, clapNumber = :clapNumber WHERE clapId = :clapId";
		$statement = $pdo->prepare($query);


		$formattedDate = $this->clapDate->format("Y-m-d H:i:s.u");
		$parameters = ["clapId" => $this->clapId->getBytes(), "clapProfileId" => $this->clapProfileId->getBytes(), "clapArticleId" => $this->clapArticleId, "clapDate" => $formattedDate, "clapNumber" => $this->clapNumber];
		$statement->execute($parameters);
	}

	/**
	 * gets the clap by clapId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $clapId clap id to search for
	 * @return clap|null clap found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getClapByClapId(\PDO $pdo, $clapId): ?clap {
		// sanitize the clapId before searching
		try {
			$clapId = self::validateUuid($clapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT clapId, clapProfileId, clapArticleId, clapDate, clapNumber, clapNumber FROM clap WHERE clapId = :clapId";
		$statement = $pdo->prepare($query);

		// bind the clap id to the place holder in the template
		$parameters = ["clapId" => $clapId->getBytes()];
		$statement->execute($parameters);

		// grab the clap from mySQL
		try {
			$clap = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$clap = new Clap($row["clapId"], $row["clapProfileId"], $row["clapArticleId"], $row["clapDate"], $row["clapNumber"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($clap);
	}

	/**
	 * gets the clap by profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $clapProfileId profile id to search by
	 * @return \SplFixedArray SplFixedArray of claps found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getClapByClapProfileId(\PDO $pdo, $clapProfileId): \SplFixedArray {

		try {
			$clapProfileId = self::validateUuid($clapProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT clapId, clapProfileId, clapArticleId, clapDate, clapNumber FROM clap WHERE clapProfileId = :clapProfileId";
		$statement = $pdo->prepare($query);
		// bind the clap profile id to the place holder in the template
		$parameters = ["clapProfileId" => $clapProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of claps
		$claps = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$clap = new Clap($row["clapId"], $row["clapProfileId"], $row["clapArticleId"], $row["clapDate"], $row["clapNumber"]);
				$claps[$claps->key()] = $clap;
				$claps->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($claps);
	}

	/**
	 * gets the clap by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $clapArticleId clap content to search for
	 * @return \SplFixedArray SplFixedArray of claps found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getClapByClapArticleId(\PDO $pdo, string $clapArticleId): \SplFixedArray {
		// sanitize the description before searching
		$clapArticleId = trim($clapArticleId);
		$clapArticleId = filter_var($clapArticleId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($clapArticleId) === true) {
			throw(new \PDOException("clap content is invalid"));
		}

		// escape any mySQL wild cards
		$clapArticleId = str_replace("_", "\\_", str_replace("%", "\\%", $clapArticleId));

		// create query template
		$query = "SELECT clapId, clapProfileId, clapArticleId, clapDate, clapNumber FROM clap WHERE clapArticleId LIKE :clapArticleId";
		$statement = $pdo->prepare($query);

		// bind the clap content to the place holder in the template
		$clapArticleId = "%$clapArticleId%";
		$parameters = ["clapArticleId" => $clapArticleId];
		$statement->execute($parameters);

		// build an array of claps
		$claps = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$clap = new Clap($row["clapId"], $row["clapProfileId"], $row["clapArticleId"], $row["clapDate"], $row["clapNumber"]);
				$claps[$claps->key()] = $clap;
				$claps->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($claps);
	}

	/**
	 * gets all claps
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of claps found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllClaps(\PDO $pdo): \SPLFixedArray {
		// create query template
		$query = "SELECT clapId, clapProfileId, clapArticleId, clapDate, clapNumber FROM clap";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of claps
		$claps = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$clap = new Clap($row["clapId"], $row["clapProfileId"], $row["clapArticleId"], $row["clapDate"], $row["clapNumber"]);
				$claps[$claps->key()] = $clap;
				$claps->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($claps);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["clapId"] = $this->clapId->toString();
		$fields["clapProfileId"] = $this->clapProfileId->toString();
		$fields["clapArticleId"] = $this->clapArticleId->toString();
		//format the date so that the front end can consume it
		$fields["clapDate"] = round(floatval($this->clapDate->format("U.u")) * 1000);
		$fields["clapNumber"] = $this->clapNumber->toInt();
		return ($fields);
	}
}