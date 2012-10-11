<?php
namespace Embed\Services;

use Embed\Url;
use Embed\Providers\Provider;
use Embed\Providers\OpenGraph;

class Generic extends Service {
	static public function create (Url $Url) {
		return new static(new OpenGraph($Url->getUrl()));
	}

	public function __construct (Provider $Provider) {
		parent::__construct($Provider);

		//Fix type
		$this->Provider->set('type', 'link');

		//Fix provider name
		if (!$this->Provider->has('site_name')) {
			$this->Provider->set('site_name', parse_url($this->getUrl(), PHP_URL_HOST));
		}
	}

	public function getImage () {
		return $this->Provider->get('image');
	}

	public function getProviderName () {
		return $this->Provider->get('site_name');
	}
}
