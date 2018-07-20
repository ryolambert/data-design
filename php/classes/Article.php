<?php

namespace Edu\Cnm\DataDesign;
require_once("autoloader.php");
require_once(dirname(__DIR__, 2) . "../vendor/autoload.php");

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
class Article implements \JsonSeriablizable {
	use ValidateDate;
	use ValidateUuid;

	/**
	 * id for this Article; this is the primary key
	 * @var Uuid $articleId
	 **/
	private $articleId;

	/** id for the Article Poster's Profile; this is a foreign key
	 * @var Uuid $articleProfileId
	 **/
	private $articleProfileId;

	/**
	 * the actual written text conten of this Article
	 * @var string $articleContent
	 */
	private $articleContent;

	/**
	 * date and time this Article was posted, in a PHP DataTime object
	 * @var \DateTime $articleDate
	 */
	private $articleDate;

	/**
	 * constructor for this Article
	 *
	 * @param string|Uuid $newArticleId id of this Article or null if a new Article
	 * @param string|Uuid $newArticleProfileId id of the Profile that sent this Article
	 * @param string $newArticleContent string containing actual Article data
	 * @param \DateTime|string|null $newArticleDate date and time Article was sent or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newArticleId, $newArticleProfileId, string $newArticleContent, $newArticleDate = null) {
		try {
			$this->setArticleId($newArticleId);
			$this->setArticleProfileId($newArticleProfileId);
			$this->setArticleContent($newArticleContent);
			$this->setArticleDate($newArticleDate);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for Article id
	 * @return Uuid value of Article id
	 */
	public function getArticleId(): Uuid {
		return ($this->articleId);
	}

	/**
	 * mutator method for Article id
	 *
	 * @param  Uuid| string $newArticleId value of new Article id
	 * @throws \RangeException if $newArticleId is not positive
	 * @throws \TypeError if the Article Id is not
	 **/
	public function setArticleId($newArticleId): void {
		try {
			$uuid = self::validateUuid($newArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the Article id
		$this->articleId = $uuid;
	}

	/**
	 * accessor method for Article profile id
	 *
	 * @return Uuid value of Article profile id
	 **/
	public function getArticleProfileId(): Uuid {
		return ($this->articleProfileId);
	}

	/**
	 * mutator method for Article profile id
	 *
	 * @param string | Uuid $newArticleProfileId new value of Article profile id
	 * @throws \RangeException if $newArticleProfileId is not positive
	 * @throws \TypeError if $newArticleProfileId is not an integer
	 **/
	public function setArticleProfileId($newArticleProfileId): void {
		try {
			$uuid = self::validateUuid($newArticleProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the profile id
		$this->articleProfileId = $uuid;
	}

	/**
	 * accessor method for Article content
	 *
	 * @return string value of Article content
	 **/
	public function getArticleContent(): string {
		return ($this->articleContent);
	}

	/**
	 * mutator method for Article content
	 *
	 * @param string $newArticleContent new value of Article content
	 * @throws \InvalidArgumentException if $newArticleContent is not a string or insecure
	 * @throws \RangeException if $newArticleContent is > 8192 characters
	 * @throws \TypeError if $newArticleContent is not a string
	 **/
	public function setArticleContent(string $newArticleContent): void {
		// verify the Article content is secure
		$newArticleContent = trim($newArticleContent);
		$newArticleContent = filter_var($newArticleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleContent) === true) {
			throw(new \InvalidArgumentException("Article content is empty or insecure"));
		}

		// verify the Article content will fit in the database
		if(strlen($newArticleContent) > 8192) {
			throw(new \RangeException("Article content too large"));
		}

		// store the Article content
		$this->articleContent = $newArticleContent;
	}

	/**
	 * accessor method for Article date
	 *
	 * @return \DateTime value of Article date
	 **/
	public function getArticleDate(): \DateTime {
		return ($this->articleDate);
	}

	/**
	 * mutator method for Article date
	 *
	 * @param \DateTime|string|null $newArticleDate Article date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newArticleDate is not a valid object or string
	 * @throws \RangeException if $newArticleDate is a date that does not exist
	 **/
	public function setArticleDate($newArticleDate = null): void {
		// base case: if the date is null, use the current date and time
		if($newArticleDate === null) {
			$this->articleDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newArticleDate = self::validateDateTime($newArticleDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->articleDate = $newArticleDate;
	}

	/**
	 * inserts this Article into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// create query template
		$query = "INSERT INTO article(articleId,articleProfileId, articleContent, articleDate) VALUES(:articleId, :articleProfileId, :articleContent, :articleDate)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->articleDate->format("Y-m-d H:i:s.u");
		$parameters = ["articleId" => $this->articleId->getBytes(), "articleProfileId" => $this->articleProfileId->getBytes(), "articleContent" => $this->articleContent, "articleDate" => $formattedDate];
		$statement->execute($parameters);
	}


	/**
	 * deletes this Article from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM article WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["articleId" => $this->articleId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Article in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {

		// create query template
		$query = "UPDATE article SET articleProfileId = :articleProfileId, articleContent = :articleContent, articleDate = :articleDate WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);


		$formattedDate = $this->articleDate->format("Y-m-d H:i:s.u");
		$parameters = ["articleId" => $this->articleId->getBytes(), "articleProfileId" => $this->articleProfileId->getBytes(), "articleContent" => $this->articleContent, "articleDate" => $formattedDate];
		$statement->execute($parameters);
	}

	/**
	 * gets the Article by articleId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $articleId Article id to search for
	 * @return Article|null Article found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getArticleByArticleId(\PDO $pdo, $articleId): ?Article {
		// sanitize the articleId before searching
		try {
			$articleId = self::validateUuid($articleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleDate FROM Article WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);

		// bind the Article id to the place holder in the template
		$parameters = ["articleId" => $articleId->getBytes()];
		$statement->execute($parameters);

		// grab the Article from mySQL
		try {
			$article = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleDate"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($article);
	}

	/**
	 * gets the Article by profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $articleProfileId profile id to search by
	 * @return \SplFixedArray SplFixedArray of Articles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getArticleByArticleProfileId(\PDO $pdo, $articleProfileId): \SplFixedArray {

		try {
			$articleProfileId = self::validateUuid($articleProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleDate FROM Article WHERE articleProfileId = :articleProfileId";
		$statement = $pdo->prepare($query);
		// bind the Article profile id to the place holder in the template
		$parameters = ["articleProfileId" => $articleProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of Articles
		$Articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleDate"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($Articles);
	}

	/**
	 * gets the Article by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $articleContent Article content to search for
	 * @return \SplFixedArray SplFixedArray of Articles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getArticleByArticleContent(\PDO $pdo, string $articleContent): \SplFixedArray {
		// sanitize the description before searching
		$articleContent = trim($articleContent);
		$articleContent = filter_var($articleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($articleContent) === true) {
			throw(new \PDOException("Article content is invalid"));
		}

		// escape any mySQL wild cards
		$articleContent = str_replace("_", "\\_", str_replace("%", "\\%", $articleContent));

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleDate FROM Article WHERE articleContent LIKE :articleContent";
		$statement = $pdo->prepare($query);

		// bind the Article content to the place holder in the template
		$articleContent = "%$articleContent%";
		$parameters = ["articleContent" => $articleContent];
		$statement->execute($parameters);

		// build an array of Articles
		$articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleDate"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($articles);
	}

	/**
	 * gets all Articles
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Articles found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllArticles(\PDO $pdo): \SPLFixedArray {
		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleDate FROM article";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of Articles
		$articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleDate"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($articles);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["articleId"] = $this->articleId->toString();
		$fields["articleProfileId"] = $this->articleProfileId->toString();

		//format the date so that the front end can consume it
		$fields["articleDate"] = round(floatval($this->articleDate->format("U.u")) * 1000);
		return ($fields);
	}
}
