<?php
/**
 * Class to extract information from a user agent string.
 *
 * @author Timo Tijhof, 2012
 * @since 1.0.0
 * @package TestSwarm
 */
class BrowserInfo {

	/**
	 * @var $context TestSwarmContext
	 */
	private $context;

	/**
	 * @var $rawUserAgent string
	 */
	protected $rawUserAgent = "";

	/**
	 * @var $browscapData stdClass object: Object returned by Browscap::getBrowser.
	 */
	protected $browscapData;

	/**
	 * @var $swarmUaItem stdClass object
	 */
	protected $swarmUaItem;

	/**
	 * @var $swarmUaIndex stdClass object: Cached object of parsed useragents.ini
	 */
	protected static $swarmUaIndex;

	/** @return object */
	public static function getSwarmUAIndex() {

		// Lazy-init and cache
		if ( self::$swarmUaIndex === null ) {
			global $swarmInstallDir;

			// Convert from array with string values
			// to an object with boolean values
			$swarmUaIndex = new stdClass;
			$rawIndex = parse_ini_file( "$swarmInstallDir/config/useragents.ini", true );
			foreach ( $rawIndex as $uaID => $uaItem ) {
				if ( is_array( $uaItem ) ) {
					$uaItem2 = $uaItem;
					foreach ( $uaItem2 as $uaDataKey => $uaDataVal ) {
						if ( $uaDataKey !== "displaytitle" && $uaDataKey !== "displayicon" ) {
							$uaItem[$uaDataKey] = (bool)trim( $uaDataVal );
						} else {
							$uaItem[$uaDataKey] = trim( $uaDataVal );
						}
					}
					if ( !isset( $uaItem["displaytitle"] ) || !$uaItem["displaytitle"] ) {
						throw new SwarmException( "User agent `$uaID` is missing a displaytitle property." );
					}
					if ( !isset( $uaItem["displayicon"] ) || !$uaItem["displayicon"] ) {
						throw new SwarmException( "User agent `$uaID` is missing a displayicon property." );
					}
					$swarmUaIndex->$uaID = (object)$uaItem;
				}
			}
			self::$swarmUaIndex = $swarmUaIndex;
		}

		return self::$swarmUaIndex;
	}

	/**
	 * @param $context TestSwarmContext
	 * @param $userAgent string
	 * @return BrowserInfo
	 */
	public static function newFromContext( TestSwarmContext $context, $userAgent ) {
		$bi = new self();
		$bi->context = $context;
		$bi->parseUserAgent( $userAgent );
		return $bi;
	}

	/**
	 * Create a new BrowserInfo object for the given user agent string.
	 *
	 * Instances may not be created directly, use the static newFromUA method instead
	 * @param $userAgent string
	 */
	protected function parseUserAgent( $userAgent ) {
		$browscapCacheDir = $this->context->getConf()->storage->cacheDir . '/phpbrowscap';
		if ( !is_dir( $browscapCacheDir ) ) {
			if ( !mkdir( $browscapCacheDir, 755 ) ) {
				throw new SwarmException( "Cache directory must be writable." );
			}
		}

		/**
		 * A Browscap object looks like this (simplified version of the actual object)
		 * @source https://github.com/GaretJax/phpbrowscap/wiki/QuickStart
		 *
		 * stdClass Object (
		 *     [Platform] => MacOSX
		 *     [Browser] => Chrome
		 *     [Version] => 19.0
		 *     [MajorVer] => 19
		 *     [MinorVer] => 0
		 *     [Beta] => true
		 * )
		 */
		$browscapInstance = new Browscap( $browscapCacheDir );
		// Default cache is 5 days...
		$browscapInstance->updateInterval = 3600; // 1 hour

		$browscapData = $browscapInstance->getBrowser( $userAgent );

		$this->rawUserAgent = $userAgent;
		$this->browscapData = $browscapData;

		return $this;
	}

	/** @return string */
	public function getRawUA() {
		return $this->rawUserAgent;
	}

	/** @return Selective array with Browscap results */
	public function getBrowscap() {
		return array_intersect_key(
			(array)$this->browscapData,
			array_flip(array( "Platform", "Browser", "Version", "MajorVer", "MinorVer" ))
		);
	}

	/** @return object|false */
	public function getSwarmUaItem() {

		// Lazy-init and cache
		if ( $this->swarmUaItem === null ) {
			$uaItems = self::getSwarmUAIndex();
			$browscap = $this->browscapData;
			$found = false;
			foreach ( $uaItems as $uaID => $uaItem ) {
				if ( $uaID === "{$browscap->Browser}|{$browscap->Platform}" ) {
					$found = $uaItem;
					$found->id = $uaID;
				} else if ( $uaID === "{$browscap->Browser}|{$browscap->MajorVer}|{$browscap->Platform}" ) {
					$found = $uaItem;
					$found->id = $uaID;
				}
			}

			$this->swarmUaItem = $found;
		}

		return $this->swarmUaItem;
	}

	/** @return bool */
	public function isInSwarmUaIndex() {
		return (bool)$this->getSwarmUaItem();
	}

	/** @return string|null */
	public function getSwarmUaID() {
		return $this->getSwarmUaItem() ? $this->getSwarmUaItem()->id : null;
	}

	/** Don't allow direct instantiations of this class, use newFromContext instead */
	private function __construct() {}
}
