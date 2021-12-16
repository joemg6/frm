<?php
/**
 *
 * @package Main SIRED
 * @since 1.0
 */

namespace bootstrap;

class Route
{
	private ?string $_url;
	private array $_profile;
	private ?string $_firstPoint;
	private ?string $_endPoint;

	public function __construct(?string $url, ?array $profile)
	{
		$this->_url = $url;
		$this->_profile = $profile;
	}

	public function splitUrl() : void
	{
		$getUrl = $this->_url;
        if ( substr_count($getUrl, '/') >= 2 && substr($getUrl, -1) == '/' ) {
            echo '<b><h1>Esta página no está disponible</h1></b><hr>Route(0)';
			exit();
        }
        $url = trim($getUrl, '/');
        $url = explode('/', $url);
        $this->_firstPoint = $url[array_key_first($url)]?? NULL;
        $this->_endPoint = $url[array_key_last($url)]?? NULL;
	}

    public function getFirstPoint() : ?string
    {
        return $this->_firstPoint;
    }

    public function getEndpoint() : ?string
    {
        return $this->_endPoint;
    }

	private function getProfileRoute() : bool
	{
		if ( !in_array($this->_firstPoint, $this->_profile) )
			return false;
		return true;
	}

	public function get() : array
	{

		$this->splitUrl();

        if ( (strlen( $this->_firstPoint) === 0 && $this->_firstPoint == "") || count($this->_profile) == 0 ) {			
        	return array('profile' => 'indexLogin', 'endPoint' => NULL);
		} 

        if ( ($this->_firstPoint === 'admin' && $this->_endPoint == "admin") || count($this->_profile) == 0 ) {
        	return array('profile' => 'indexAdminLogin', 'endPoint' => NULL);
		}

		if ( !$this->getProfileRoute() ) {	
			require_once 'routes/public.php';
			if ( !in_array($this->_firstPoint, $public_routes) && $this->_firstPoint != "user" ) {
                echo '<b><h1>Esta página no está disponible</h1></b><hr>Route(3)';
				exit();
			}
			return array('profile' => $this->_firstPoint, 'endPoint' => lcfirst($this->_endPoint) );
		}

		if ( !file_exists('routes/' . lcfirst($this->_firstPoint) . '.php') ) {
            echo '<b><h1>Esta página no está disponible</h1></b><hr>Route(2)';
            exit();
		}
        require_once 'routes/' . lcfirst($this->_firstPoint) . '.php';

		if ( !in_array(lcfirst($this->_endPoint), $routes) && $this->_endPoint != "" ) {
            echo '<b><h1>Esta página no está disponible</h1></b><hr>Route(1)';
			exit();
		}
		return array('profile' => $this->_firstPoint, 'endPoint' => lcfirst($this->_endPoint) );
	}

}

