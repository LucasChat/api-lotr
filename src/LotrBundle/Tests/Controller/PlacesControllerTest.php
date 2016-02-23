<?php

namespace LotrBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlacesControllerTest extends WebTestCase
{
	public function testGetPlaces()
	{
		$client = static::createClient();

		$client->request('GET', '/places');

		$json = '[{"id":1,"slug":"hobbitebourg","name":"Hobbitebourg","coordx":13,"coordy":24},{"id":2,"slug":"bree","name":"Bree","coordx":26,"coordy":26},{"id":3,"slug":"mont-venteux","name":"Mont Venteux","coordx":32,"coordy":26},{"id":4,"slug":"fondcombe","name":"Fondcombe","coordx":41,"coordy":26},{"id":5,"slug":"moria","name":"Moria","coordx":41,"coordy":35},{"id":6,"slug":"lothlorien","name":"L\u00f3thlorien","coordx":48,"coordy":37},{"id":7,"slug":"isengard","name":"Isengard","coordx":37,"coordy":46},{"id":8,"slug":"edoras","name":"Edoras","coordx":42,"coordy":53},{"id":9,"slug":"gouffre-de-helm","name":"Gouffre de Helm","coordx":38,"coordy":52},{"id":10,"slug":"osgiliath","name":"Osgiliath","coordx":62,"coordy":61},{"id":11,"slug":"henneth-annun","name":"Henneth Ann\u00fbn","coordx":63,"coordy":55},{"id":12,"slug":"minas-tirith","name":"Minas Tirith","coordx":59,"coordy":60},{"id":13,"slug":"minas-morgul","name":"Minas Morgul","coordx":66,"coordy":62},{"id":14,"slug":"la-porte-noire","name":"La Porte Noire","coordx":69,"coordy":52},{"id":15,"slug":"barad-dur","name":"Barad D\u00fbr","coordx":80,"coordy":57},{"id":16,"slug":"montagne-du-destin","name":"Montagne du Destin","coordx":75,"coordy":58},{"id":17,"slug":"emyn-muil","name":"Emyn Muil","coordx":59,"coordy":47},{"id":18,"slug":"derunant","name":"Derunant","coordx":43,"coordy":44},{"id":19,"slug":"dol-Guldur","name":"Dol Guldur","coordx":58,"coordy":37},{"id":20,"slug":"dale","name":"Dale","coordx":69,"coordy":25},{"id":21,"slug":"chez-jawad","name":"Chez Jawad","coordx":-1,"coordy":-1},{"id":22,"slug":"dunharrow","name":"Dunharrow","coordx":42,"coordy":56},{"id":23,"slug":"amon-hen","name":"Amon Hen","coordx":54,"coordy":49},{"id":24,"slug":"marais-des-morts","name":"Marais des morts","coordx":64,"coordy":49},{"id":25,"slug":"argonath","name":"Argonath","coordx":56,"coordy":46},{"id":26,"slug":"erech","name":"Erech","coordx":57,"coordy":40},{"id":27,"slug":"calembel","name":"Calembel","coordx":43,"coordy":62},{"id":28,"slug":"pelagir","name":"Pelagir","coordx":54,"coordy":69},{"id":29,"slug":"antre-arachne","name":"Antre Arakne","coordx":70,"coordy":60},{"id":30,"slug":"champs-cormallen","name":"Champs de Cormallen","coordx":62,"coordy":57},{"id":31,"slug":"gues-isen","name":"Gu\u00e9s de Isen","coordx":38,"coordy":48},{"id":32,"slug":"caradhras","name":"Caradhras","coordx":42,"coordy":33}]';

		$this->assertEquals($json, $client->getResponse()->getContent());
		$this->assertJson($client->getResponse()->getContent());
	}

	public function testGetEvent()
	{
		$client = static::createClient();

		$client->request('GET', '/place/emyn-muil');

		$json = '[{"id":17,"slug":"emyn-muil","name":"Emyn Muil","coordx":59,"coordy":47}]';

		$this->assertEquals($json, $client->getResponse()->getContent());
		$this->assertJson($client->getResponse()->getContent());
	}

	public function testgetPlaceAllCharacters()
	{
		$client = static::createClient();

		$client->request('GET', '/place/emyn-muil/characters');

		$json = '[[{"id":17,"slug":"emyn-muil","name":"Emyn Muil","coordx":59,"coordy":47}],[{"id":526,"character":{"id":3,"slug":"frodon","name":"Frodon Sacquet","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-02-27T00:00:00+0100","coordx":59,"coordy":47,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":527,"character":{"id":3,"slug":"frodon","name":"Frodon Sacquet","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-02-28T00:00:00+0100","coordx":59,"coordy":47,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1630,"character":{"id":9,"slug":"sam","name":"Samsagace Gamegie, dit Sam","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-02-27T00:00:00+0100","coordx":59,"coordy":47,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1631,"character":{"id":9,"slug":"sam","name":"Samsagace Gamegie, dit Sam","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-02-28T00:00:00+0100","coordx":59,"coordy":47,"status":{"id":1,"slug":"Bonne sant\u00e9"}}]]';

		$this->assertEquals($json, $client->getResponse()->getContent());
		$this->assertJson($client->getResponse()->getContent());
	}

	public function testgetPlaceAllCharactersByDate()
	{
		$client = static::createClient();

		$client->request('GET', '/place/moria/characters/date/3018-09-09');
		$json = '[[{"id":5,"slug":"moria","name":"Moria","coordx":41,"coordy":35}],"error : nobody here at this date"]';
		$this->assertEquals($json, $client->getResponse()->getContent());
		$this->assertJson($client->getResponse()->getContent());

		$client->request('GET', '/place/moria/characters/date/3019-01-14');
		$json = '[[{"id":5,"slug":"moria","name":"Moria","coordx":41,"coordy":35}],[{"id":114,"character":{"id":1,"slug":"aragorn","name":"Aragorn, dit Grands-Pas","race":{"id":1,"slug":"homme","description":"L\'humanit\u00e9, race jeune en opposition aux autres races humano\u00efdes telles les Elfes, les Nains ou les Orques."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":298,"character":{"id":2,"slug":"boromir","name":"Boromir, fils de Denethor","race":{"id":1,"slug":"homme","description":"L\'humanit\u00e9, race jeune en opposition aux autres races humano\u00efdes telles les Elfes, les Nains ou les Orques."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":482,"character":{"id":3,"slug":"frodon","name":"Frodon Sacquet","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":666,"character":{"id":4,"slug":"gandalf","name":"Gandalf le gris, puis Gandalf le blanc","race":{"id":4,"slug":"maia","description":"Ils font partie des Ainur, les divinit\u00e9s issues de l\'esprit d\'Il\u00favatar, le dieu cr\u00e9ateur."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":850,"character":{"id":5,"slug":"gimli","name":"Gimli, fils de Gl\u00f3in","race":{"id":2,"slug":"elfe","description":"Les a\u00een\u00e9s des Enfants d\'Il\u00favatar, les cadets \u00e9tant les Hommes."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1034,"character":{"id":6,"slug":"legolas","name":"Legolas Vertefeuille, fils de Thranduil","race":{"id":2,"slug":"elfe","description":"Les a\u00een\u00e9s des Enfants d\'Il\u00favatar, les cadets \u00e9tant les Hommes."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1218,"character":{"id":7,"slug":"merry","name":"Meriadoc Brandebouc, dit Merry","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1402,"character":{"id":8,"slug":"pippin","name":"Peregrin Touque, dit Pippin","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1586,"character":{"id":9,"slug":"sam","name":"Samsagace Gamegie, dit Sam","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-01-14T00:00:00+0100","coordx":41,"coordy":35,"status":{"id":1,"slug":"Bonne sant\u00e9"}}]]';
		$this->assertEquals($json, $client->getResponse()->getContent());
		$this->assertJson($client->getResponse()->getContent());
	}
}
