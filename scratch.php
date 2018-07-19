public function __construct($newProfileId, string $newProfileHandle, string $newProfileActivationToken, string $newProfileEmail, string  $newProfilePhone, $newProfileHash, $newProfileSalt)
{
try {
$this->setProfileId($newProfileId);
$this->setProfileHandle($newProfileHandle);
$this->setProfileActivationToken($newProfileActivationToken);
$this->setProfileEmail($newProfileEmail);
$this->setProfilePhone($newProfilePhone);
$this->setProfileHash($newProfileHash);
$this->setProfileSalt($newProfileSalt);
} catch (\InvalidArgumentException | \ RangeException | \Exception | \TypeError $exception) {
// determine what exception type was thrown
$exceptionType = get_class($exception);
throw(new $exceptionType($exception->getMessage(), 0, $exception));
}
}
/**
*  accessor method for profile id
*
* @return Uuid value of profile id
**/
public function getProfileId(): Uuid {
return ($this->profileId);
}
/**
* mutator method for profile id
*
* @param Uuid / string $newProfileId new value of post id
* @throws \RangeException if $newProfileId is not positive
* @throws \ TypeError if $newProfileId is not a uuid or string
**/
public function setProfileId($newProfileId): void{
try {
$uuid = self::validateUuid($newProfileId);
} catch (\InvalidArgumentException |\RangeException |\Exception |\TypeError $exception) {
$exceptionType = get_class($exception);
throw(new $exceptionType($exception->getMessage(), 0, $exception));
}
// convert and store the post id
$this->profileId = $uuid;
}
/**
*  accessor method for profile handle
*
* @return string value of profile handle
**/
public function getProfileHandle(): string {
return ($this->profileHandle);
}
/**
* mutator method for profile handle
*
* @param string $newProfileHandle new value of handle
* @throws \InvalidArgumentException if $newProfileHandle is not a string or insecure
* @throws \RangeException if $newProfileHandle is > 128 characters
* @throws \TypeError if $newProfileHandle is not a string
**/
public function setProfileHandle(string $newProfileHandle) : void {
// verify the user name is secure
$newProfileHandle = trim($newProfileHandle);
$newProfileHandle = filter_var($newProfileHandle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($newProfileHandle) === true) {
throw(new \InvalidArgumentException("profile handle is empty or insecure"));
}
// verify the user name will fit in the database
if(strlen($newProfileHandle) > 128) {
throw(new \RangeException("profile handle is too large"));
}
// store the profile handle
$this->profileHandle = $newProfileHandle;
}
/**
*  accessor method for profile activation token
*
* @return string value of profile activation token
**/
public function getProfileActivationToken(): string{
return ($this->profileActivationToken);
}
/**
* mutator method for profile activation token
*
* @param string $newProfileActivationToken new value of      * token
* @throws \InvalidArgumentException if $newProfileActivationToken is not a string or insecure
* @throws \RangeException if $newProfileActivationToken is > 128
*characters
* @throws \TypeError if $newProfileActivationToken is not a string
**/
public function setProfileActivationToken(string $newProfileActivationToken) : void {
// verify the email is secure
$newProfileActivationToken = trim($newProfileActivationToken);
$newProfileActivationToken = filter_var($newProfileActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($newProfileActivationToken) === true) {
throw(new \InvalidArgumentException("profile activation token is empty or insecure"));
}
// verify the activation token will fit in the database
if(strlen($newProfileActivationToken) > 128) {
throw(new \RangeException("profile activation token is too large"));
}
// store the profile activation token
$this->profileActivationToken = $newProfileActivationToken;
}
/**
*  accessor method for profile email
*
* @return string value of profile email
**/
public function getProfileEmail(): string{
return ($this->profileEmail);
}
/**
* mutator method for profile email
*
* @param string $newProfileEmail new value of handle
* @throws \InvalidArgumentException if $newProfileEmail is not a string or insecure
* @throws \RangeException if $newProfileEmail is > 128 characters
* @throws \TypeError if $newProfileEmail is not a string
**/
public function setProfileEmail(string $newProfileEmail) : void {
// verify the email is secure
$newProfileEmail = trim($newProfileEmail);
$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($newProfileEmail) === true) {
throw(new \InvalidArgumentException("profile email is empty or insecure"));
}
// verify the email will fit in the database
if(strlen($newProfileEmail) > 128) {
throw(new \RangeException("profile email is too large"));
}
// store the profile email
$this->profileEmail = $newProfileEmail;
}
/**
*  accessor method for profile phone
*
* @return string value of profile phone
**/
public function getProfilePhone(): string{
return ($this->profilePhone);
}
/**
* mutator method for profile phone
*
* @param string $newProfilePhone new value of handle
* @throws \InvalidArgumentException if $newProfilePhone is not a string or insecure
* @throws \RangeException if $newProfilePhone is > 128 characters
* @throws \TypeError if $newProfilePhone is not a string
**/
public function setProfilePhone(string $newProfilePhone) : void {
// verify the phone is secure
$newProfilePhone = trim($newProfilePhone);
$newProfilePhone = filter_var($newProfilePhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($newProfilePhone) === true) {
throw(new \InvalidArgumentException("profile phone is empty or insecure"));
}
// verify the phone will fit in the database
if(strlen($newProfilePhone) > 128) {
throw(new \RangeException("profile phone is too large"));
}
// store the profile phone
$this->profilePhone = $newProfilePhone;
}
/**
*  accessor method for profile hash
*
* @return string value of profile hash
**/
public function getProfileHash(): string{
return ($this->profileHash);
}
/**
* mutator method for profile hash
*
* @param string $newProfileHash new value of profile hash
* @throws \InvalidArgumentException if $newProfileHash is not a string or insecure
* @throws \RangeException if $newProfileHash is > 128
*characters
* @throws \TypeError if $newProfileHash is not a string
**/
public function setProfileHash(string $newProfileHash) : void {
// verify the hash is secure
$newProfileHash = trim($newProfileHash);
$newProfileHash = filter_var($newProfileHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($newProfileHash) === true) {
throw(new \InvalidArgumentException("profile hash is empty or insecure"));
}
// verify the hash will fit in the database
if(strlen($newProfileHash) > 128) {
throw(new \RangeException("profile hash is too large"));
}
// store the profile hash
$this->profileHash = $newProfileHash;
}
/**
*  accessor method for profile salt
*
* @return string value of profile salt
**/
public function getProfileSalt(): string{
return ($this->profileSalt);
}
/**
* mutator method for profile salt
*
* @param string $newProfileSalt new value of profile salt
* @throws \InvalidArgumentException if $newProfileSalt is not a string or insecure
* @throws \RangeException if $newProfileSalt is > 128
*characters
* @throws \TypeError if $newProfileSalt is not a string
**/
public function setProfileSalt(string $newProfileSalt) : void {
// verify the salt is secure
$newProfileSalt = trim($newProfileSalt);
$newProfileSalt = filter_var($newProfileSalt, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($newProfileSalt) === true) {
throw(new \InvalidArgumentException("profile salt is empty or insecure"));
}
// verify the salt will fit in the database
if(strlen($newProfileSalt) > 128) {
throw(new \RangeException("profile salt is too large"));
}
// store the profile salt
$this->profileSalt = $newProfileSalt;
}
/**
* insert this Profile into mySQL
*
* @param \PDO $pdo PDO connection object
* @throws \ PDOException when mySQL related error occur
* @throws \TypeError if $pdo is not a PDO connection object
**/
public function insert(\PDO $pdo) : void {
// create query template
$query = "INSERT INTO profile(profileId, profileHandle, profileActivationToken, profileEmail, profilePhone,
profileHash, profileSalt) VALUES(:profileId, :profileHandle,  :profileActivationToken, :profileEmail, :profilePhone,
:profileHash, :profileSalt)";
$statement = $pdo->prepare($query);
// bind the member variables to the place holder in the template
$formattedDate = $this->postDate->format("Y-m-d H:i:s.u");
$parameters = ["profileId" => $this->profileId->getBytes(), "profileHandle" => $this->profileHandle,
"profileActivationToken"=> $this->profileActivationToken, "profileEmail" => $this->profileEmail,
"profilePhone" => $this->profilePhone, 'profileHash' => $this->profileHash, 'profileSalt' => $this->profileSalt];
$statement->execute($parameters);
}
/**
* deletes this Profile from mySQL
*
* @param \PDO $pdo PDO connection object
* @throws \PDOException when mySQL related error occur
* @throws \TypeError if $pdo is not a PDO connection object
**/
public function delete(\PDO $pdo) : void {
// create query template
$query = 'DELETE FROM profile WHERE  profileId = :profileId';
$statement = $pdo->prepare($query);
// bind the member variables to the place holders in the template
$parameters = ['profileId' =>$this->profileId->getBytes()];
$statement-> execute($parameters);
}
/**
* updates this Profile into mySQL
*
* @param \PDO $pdo PDO connection object
* @throws \PDOException when mySQL related errors occur
* @throws\TypeError if $pdo is not a PDO connection object
**/
public function update(\PDO $pdo) : void {
//Enforces the profileId is not null (don't update a profile that doesn't exist)
if($this->profileId === null) {
throw(new \PDOException('profile does not exist'));
}
}
/**
* get the Profile by profile id
*
* @param \PDO $pdo PDO connection object
* @param string $profileId profile id to search for
* @return Profile|null Profile or null if not found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when a variable are not the correct data type
**/
public static function getProfileByProfileId(\PDO $pdo, string $profileId) : ?Profile {
// sanitize the profile Id before searching
try{
$profileId = self::validateUuid($profileId);
} catch (\InvalidArgumentException| \RangeException | \Exception | \TypeError $exception) {
throw(new \PDOException($exception->getMessage(),  0, $exception));
}
// create query template
$query = "SELECT profileId, profileHandle, profileActivationHandle, profileEmail, profilePhone, profileHash,
profileSalt FROM profile WHERE profileId = :profileId";
$statement = $pdo->prepare($query);
// bind the profile id to the place holder in the template
$parameters = ["profileId" => $profileId->getBytes()];
$statement->execute($parameters);
// grab the profile from mySQL
try {
$profile = null;
$statement->setFetchMode(\PDO::FETCH_ASSOC);
$row = $statement->fetch();
if($row !== false) {
$profile =new profile($row["profileId"], $row["profileHandle"], $row["profileActivationToken"],
$row["profileEmail"], $row["profilePhone"], $row['profileHash'], $row['profileSalt']);
}
} catch(\Exception $exception) {
// if the row couldn't be converted, rethrow it
throw(new \PDOException($exception->getMessage(), 0, $exception));
}
return($profile);
}
/**
* get the Profile by profile handle
*
* @param \PDO $pdo PDO connection object
* @param string $profileHandle  to search for
* @return \SPLFixedArray of all profiles found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not correct data type
**/
public static function getProfileByProfileHandle(\PDO $pdo, string $profileHandle) : \SPLFixedArray {
// sanitize the profile handle before searching
$profileHandle = trim($profileHandle);
$profileHandle = filter_var($profileHandle, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($profileHandle) === true) {
throw(new \PDOException("not a valid handle"));
}
// create query template
$query = "SELECT profileId, profileHandle, profileActivationToken, profileEmail, profilePhone, profileHash,
profileSalt FROM profile WHERE profileHandle = :profileHandle";
$statement = $pdo->prepare($query);
//bind the profile handle to the place holder in the template
$parameters = ["profileHandle" => $profileHandle];
$statement->execute($parameters);
$profile = new \SPLFixedArray($statement->rowCount());
$statement->setFetchMode(\PDO::FETCH_ASSOC);
while (($row = $statement->fetch()) !== false) {
try {
$profile = new Profile($row["profileId"], $row["profileHandle"], $row["profileActivationToken"],
$row["profileEmail"],$row['profilePhone'], $row["profileHash"], $row["profileSalt"]);
$profile[$profile->key()] = $profile;
$profile->next();
} catch (\Exception $exception) {
// if the row couldn't be converted, rethrow it
throw(new \PDOException($exception->getMessage(), 0, $exception));
}
}
return($profile);
}
/**
* get the Profile by profile activation token
*
* @param string $profileActivationToken
* @param \PDO object $pdo
* @return Profile|null profile or null if not found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not the correct data type
**/
public static function	getProfileByProfileActivationToken(\PDO $pdo, string $profileActivationToken) : ?Profile
{
//make sure activation token is in the right format and that it is a string representation of a hexadecimal
$profileActivationToken = trim($profileActivationToken);
if (ctype_xdigit($profileActivationToken) === false) {
throw(new \InvalidArgumentException("profile activation token is empty or in the wrong format"));
}
//create the query template
$query = "SELECT profileId, profileHandle, profileActivationToken, profileEmail, profilePhone, profileHash,
profileSalt FROM profile WHERE profileActivationToken = :profileActivationToken";
$statement = $pdo->prepare($query);
//bind the profile activation token to the place holder in the template
$parameters = ["profileActivationToken" => $profileActivationToken];
$statement->execute($parameters);
$profile = new \SPLFixedArray($statement->rowCount());
$statement->setFetchMode(\PDO::FETCH_ASSOC);
while (($row = $statement->fetch()) !== false) {
try {
$profile = new Profile($row["profileId"], $row["profileHandle"], $row["profileActivationToken"],
$row["profileEmail"], $row['profilePhone'], $row["profileHash"], $row["profileSalt"]);
$profile[$profile->key()] = $profile;
$profile->next();
} catch (\Exception $exception) {
// if the row couldn't be converted, rethrow it
throw(new \PDOException($exception->getMessage(), 0, $exception));
}
}
return ($profile);
}
/**
* get the Profile by profile email
*
* @param \PDO $pdo PDO connection object
* @param string $profileEmail  to search for
* @return \SPLFixedArray of all profiles found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not correct data type
**/
public static function getProfileByProfileEmail(\PDO $pdo, string $profileEmail) : \SPLFixedArray {
// sanitize the profile email before searching
$profileEmail = trim($profileEmail);
$profileEmail = filter_var($profileEmail, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($profileEmail) === true) {
throw(new \PDOException("not a valid email"));
}
// create query template
$query = "SELECT profileId, profileHandle, profileActivationToken, profileEmail, profilePhone, profileHash,
profileSalt FROM profile WHERE profileEmail = :profileEmail";
$statement = $pdo->prepare($query);
//bind the profile handle to the place holder in the template
$parameters = ["profileEmail" => $profileEmail];
$statement->execute($parameters);
$profile = new \SPLFixedArray($statement->rowCount());
$statement->setFetchMode(\PDO::FETCH_ASSOC);
while (($row = $statement->fetch()) !== false) {
try {
$profile = new Profile($row["profileId"], $row["profileHandle"], $row["profileActivationToken"],
$row["profileEmail"],$row['profilePhone'], $row["profileHash"], $row["profileSalt"]);
$profile[$profile->key()] = $profile;
$profile->next();
} catch (\Exception $exception) {
// if the row couldn't be converted, rethrow it
throw(new \PDOException($exception->getMessage(), 0, $exception));
}
}
return($profile);
}
/**
* get the Profile by profile phone
*
* @param \PDO $pdo PDO connection object
* @param string $profilePhone  to search for
* @return \SPLFixedArray of all profiles found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not correct data type
**/
public static function getProfileByProfilePhone(\PDO $pdo, string $profilePhone) : \SPLFixedArray {
// sanitize the profile phone before searching
$profilePhone = trim($profilePhone);
$profilePhone = filter_var($profilePhone, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
if(empty($profilePhone) === true) {
throw(new \PDOException("not a valid phone"));
}
// create query template
$query = "SELECT profileId, profileHandle, profileActivationToken, profileEmail, profilePhone, profileHash,
profileSalt FROM profile WHERE profilePhone = :profilePhone";
$statement = $pdo->prepare($query);
//bind the profile handle to the place holder in the template
$parameters = ["profilePhone" => $profilePhone];
$statement->execute($parameters);
$profile = new \SPLFixedArray($statement->rowCount());
$statement->setFetchMode(\PDO::FETCH_ASSOC);
while (($row = $statement->fetch()) !== false) {
try {
$profile = new Profile($row["profileId"], $row["profileHandle"], $row["profileActivationToken"],
$row["profileEmail"],$row['profilePhone'], $row["profileHash"], $row["profileSalt"]);
$profile[$profile->key()] = $profile;
$profile->next();
} catch (\Exception $exception) {
// if the row couldn't be converted, rethrow it
throw(new \PDOException($exception->getMessage(), 0, $exception));
}
}
return($profile);
}
public function jsonSerialize() {
$fields = get_object_vars($this);
$fields["profileId"] = $this->profileId;
$fields["profileUserName"] = $this->profileHandle;
$fields["profileActivationToken"] = $this->profileActivationToken;
$fields["profileEmail"] = $this->profileEmail;
$fields["profileHash"] = $this->profileHash;
$fields["profileSalt"] = $this->profileSalt;
}
}