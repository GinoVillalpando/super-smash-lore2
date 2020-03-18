<?php
namespace SuperSmashLore\SuperSmashLore\Test;
use SuperSmashLore\SuperSmashLore\{Character};
use PHPUnit\DbUnit\DataSet\IDataSet;

//grab the class under scrutiny
require_once (dirname(__DIR__) . "/autoloader.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PhpUnit test for the Character class
 *
 * This is a complete PHPUnit test of the Character class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Character
 * @author Ryan Buchholz
 */
class CharacterTest extends SuperSmashLoreTest {
	/**
	 * valid character description
	 * @var string $validCharacterDescription
	 */
	protected $validCharacterDescription = "This is the King of Thieves";
	/**
	 * valid character music url
	 * @var $validCharacterMusicUrl
	 */
	protected $validCharacterMusicUrl = "https://www.spookymusic.com";
	/**
	 * valid name of the character
	 * @var $validCharacterName
	 */
	protected $validCharacterName = "Ganondorf";
	/**
	 * valid character picture url
	 * @var $validCharacterPictureUrl
	 */
	protected $validCharacterPictureUrl = "https://www.warpig.com";
	/**
	 * valid quotes from the character
	 * @var $validCharacterQuotes
	 */
	protected $validCharacterQuotes = "DORIYAH";
	/**
	 * valid date for when the character was released
	 * @var $validCharacterReleaseDate
	 */
	protected $validCharacterReleaseDate = "02/21/86";
	/**
	 * valid song for the character
	 * @var $validCharacterSong
	 */
	protected $validCharacterSong = "Gerudo Desert Theme";
	/**
	 * valid universe that the character is from
	 * @var $validCharacterUniverse
	 */
	protected $validCharacterUniverse = "The Legend of Zelda";

	/**
	 * test inserting a valid Character and verify that the actual MySQL data matches
	 */
	public function testInsertValidCharacter(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("character");
		//character id
		$characterId = generateUuidV4();
		$character = new Character($characterId, $this->validCharacterDescription, $this->validCharacterMusicUrl, $this->validCharacterName, $this->validCharacterPictureUrl, $this->validCharacterQuotes, $this->validCharacterReleaseDate, $this->validCharacterSong, $this->validCharacterUniverse);
		$character->insert($this->getPDO());
		//grab the data from MySQL and enforce the fields match our expectations
		$pdoCharacter = Character::getCharacterByCharacterId($this->getPDO(), $character->getCharacterId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		$this->assertEquals($pdoCharacter->getCharacterId(), $characterId);
		$this->assertEquals($pdoCharacter->getCharacterDescription(), $this->validCharacterDescription);
		$this->assertEquals($pdoCharacter->getCharacterMusicUrl(), $this->validCharacterMusicUrl);
		$this->assertEquals($pdoCharacter->getCharacterName(), $this->validCharacterName);
		$this->assertEquals($pdoCharacter->getCharacterPictureUrl(), $this->validCharacterPictureUrl);
		$this->assertEquals($pdoCharacter->getCharacterQuotes(), $this->validCharacterQuotes);
		$this->assertEquals($pdoCharacter->getCharacterReleaseDate(), $this->validCharacterReleaseDate);
		$this->assertEquals($pdoCharacter->getCharacterSong(), $this->validCharacterSong);
		$this->assertEquals($pdoCharacter->getCharacterUniverse(), $this->validCharacterUniverse);
	}

	public function testGetValidCharacterByCharacterName(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("character");
		//character id
		$characterId = generateUuidV4();
		$character = new Character($characterId, $this->validCharacterDescription, $this->validCharacterMusicUrl, $this->validCharacterName, $this->validCharacterPictureUrl, $this->validCharacterQuotes, $this->validCharacterReleaseDate, $this->validCharacterSong, $this->validCharacterUniverse);
		$character->insert($this->getPDO());
		//enforce the results meet expectations
		$pdoCharacter = Character::getCharacterByCharacterName($this->getPDO(), $character->getCharacterName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		$this->assertEquals($pdoCharacter->getCharacterId(), $characterId);
		$this->assertEquals($pdoCharacter->getCharacterDescription(), $this->validCharacterDescription);
		$this->assertEquals($pdoCharacter->getCharacterMusicUrl(), $this->validCharacterMusicUrl);
		$this->assertEquals($pdoCharacter->getCharacterName(), $this->validCharacterName);
		$this->assertEquals($pdoCharacter->getCharacterPictureUrl(), $this->validCharacterPictureUrl);
		$this->assertEquals($pdoCharacter->getCharacterQuotes(), $this->validCharacterQuotes);
		$this->assertEquals($pdoCharacter->getCharacterReleaseDate(), $this->validCharacterReleaseDate);
		$this->assertEquals($pdoCharacter->getCharacterSong(), $this->validCharacterSong);
		$this->assertEquals($pdoCharacter->getCharacterUniverse(), $this->validCharacterUniverse);
	}

	/**
	 * test grabbing characters from character name
	 */
	public function testGetValidCharactersByCharacterName(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCOunt("character");
		//character id
		$characterId = generateUuidV4();
		$character = new Character($characterId, $this->validCharacterDescription, $this->validCharacterMusicUrl, $this->validCharacterName, $this->validCharacterPictureUrl, $this->validCharacterQuotes, $this->validCharacterReleaseDate, $this->validCharacterSong, $this->validCharacterUniverse);
		$character->insert($this->getPDO());
		//grab the data from mySQL
		$results = Character::getCharactersByCharacterName($this->getPDO(), $this->validCharacterName);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		//enforce no other objects are bleeding into the character
		$this->assertContainsOnlyInstancesOf("SuperSmashLore\\SuperSmashLore\\Character", $results);
		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCharacter = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		$this->assertEquals($pdoCharacter->getCharacterId(), $characterId);
		$this->assertEquals($pdoCharacter->getCharacterDescription(), $this->validCharacterDescription);
		$this->assertEquals($pdoCharacter->getCharacterMusicUrl(), $this->validCharacterMusicUrl);
		$this->assertEquals($pdoCharacter->getCharacterName(), $this->validCharacterName);
		$this->assertEquals($pdoCharacter->getCharacterPictureUrl(), $this->validCharacterPictureUrl);
		$this->assertEquals($pdoCharacter->getCharacterQuotes(), $this->validCharacterQuotes);
		$this->assertEquals($pdoCharacter->getCharacterReleaseDate(), $this->validCharacterReleaseDate);
		$this->assertEquals($pdoCharacter->getCharacterSong(), $this->validCharacterSong);
		$this->assertEquals($pdoCharacter->getCharacterUniverse(), $this->validCharacterUniverse);
	}


	/**
	 *test grabbing a character by character's universe
	 */
	public function testGetValidCharacterByCharacterUniverse(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("character");
		//character id
		$characterId = generateUuidV4();
		$character = new Character($characterId, $this->validCharacterDescription, $this->validCharacterMusicUrl, $this->validCharacterName, $this->validCharacterPictureUrl, $this->validCharacterQuotes, $this->validCharacterReleaseDate, $this->validCharacterSong, $this->validCharacterUniverse);
		$character->insert($this->getPDO());
//		grab the data from MySQL
		$results = Character::getCharacterByCharacterUniverse($this->getPDO(), $this->validCharacterUniverse);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		//enforce no other objects are bleeding into the character
		$this->assertContainsOnlyInstancesOf("SuperSmashLore\\SuperSmashLore\\Character", $results);
		//grab the data from MySQL and enforce the fields match our expectations
		$pdoCharacter = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		$this->assertEquals($pdoCharacter->getCharacterId(), $characterId);
		$this->assertEquals($pdoCharacter->getCharacterDescription(), $this->validCharacterDescription);
		$this->assertEquals($pdoCharacter->getCharacterMusicUrl(), $this->validCharacterMusicUrl);
		$this->assertEquals($pdoCharacter->getCharacterName(), $this->validCharacterName);
		$this->assertEquals($pdoCharacter->getCharacterPictureUrl(), $this->validCharacterPictureUrl);
		$this->assertEquals($pdoCharacter->getCharacterQuotes(), $this->validCharacterQuotes);
		$this->assertEquals($pdoCharacter->getCharacterReleaseDate(), $this->validCharacterReleaseDate);
		$this->assertEquals($pdoCharacter->getCharacterSong(), $this->validCharacterSong);
		$this->assertEquals($pdoCharacter->getCharacterUniverse(), $this->validCharacterUniverse);
	}

	/**
	 * test grabbing all of the characters
	 */
	public function testGetAllCharacters(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCOunt("character");
		//character id
		$characterId = generateUuidV4();
		$character = new Character($characterId, $this->validCharacterDescription, $this->validCharacterMusicUrl, $this->validCharacterName, $this->validCharacterPictureUrl, $this->validCharacterQuotes, $this->validCharacterReleaseDate, $this->validCharacterSong, $this->validCharacterUniverse);
		$character->insert($this->getPDO());
		//grab the data from mySQL
		$results = Character::getAllCharacters($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		//enforce no other objects are bleeding into the character
		$this->assertContainsOnlyInstancesOf("SuperSmashLore\\SuperSmashLore\\Character", $results);
		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCharacter = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("character"));
		$this->assertEquals($pdoCharacter->getCharacterId(), $characterId);
		$this->assertEquals($pdoCharacter->getCharacterDescription(), $this->validCharacterDescription);
		$this->assertEquals($pdoCharacter->getCharacterMusicUrl(), $this->validCharacterMusicUrl);
		$this->assertEquals($pdoCharacter->getCharacterName(), $this->validCharacterName);
		$this->assertEquals($pdoCharacter->getCharacterPictureUrl(), $this->validCharacterPictureUrl);
		$this->assertEquals($pdoCharacter->getCharacterQuotes(), $this->validCharacterQuotes);
		$this->assertEquals($pdoCharacter->getCharacterReleaseDate(), $this->validCharacterReleaseDate);
		$this->assertEquals($pdoCharacter->getCharacterSong(), $this->validCharacterSong);
		$this->assertEquals($pdoCharacter->getCharacterUniverse(), $this->validCharacterUniverse);
	}

}


