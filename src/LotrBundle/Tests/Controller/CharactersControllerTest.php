<?php

namespace LotrBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CharactersControllerTest extends WebTestCase
{
    public function testGetCharacters()
    {
        $client = static::createClient();

        $client->request('GET', '/characters');

        $json = '[{"id":1,"slug":"aragorn","name":"Aragorn, dit Grands-Pas","race":{"id":1,"slug":"homme","description":"L\'humanit\u00e9, race jeune en opposition aux autres races humano\u00efdes telles les Elfes, les Nains ou les Orques."}},{"id":2,"slug":"boromir","name":"Boromir, fils de Denethor","race":{"id":1,"slug":"homme","description":"L\'humanit\u00e9, race jeune en opposition aux autres races humano\u00efdes telles les Elfes, les Nains ou les Orques."}},{"id":3,"slug":"frodon","name":"Frodon Sacquet","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},{"id":4,"slug":"gandalf","name":"Gandalf le gris, puis Gandalf le blanc","race":{"id":4,"slug":"maia","description":"Ils font partie des Ainur, les divinit\u00e9s issues de l\'esprit d\'Il\u00favatar, le dieu cr\u00e9ateur."}},{"id":5,"slug":"gimli","name":"Gimli, fils de Gl\u00f3in","race":{"id":2,"slug":"elfe","description":"Les a\u00een\u00e9s des Enfants d\'Il\u00favatar, les cadets \u00e9tant les Hommes."}},{"id":6,"slug":"legolas","name":"Legolas Vertefeuille, fils de Thranduil","race":{"id":2,"slug":"elfe","description":"Les a\u00een\u00e9s des Enfants d\'Il\u00favatar, les cadets \u00e9tant les Hommes."}},{"id":7,"slug":"merry","name":"Meriadoc Brandebouc, dit Merry","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},{"id":8,"slug":"pippin","name":"Peregrin Touque, dit Pippin","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},{"id":9,"slug":"sam","name":"Samsagace Gamegie, dit Sam","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}}]';

        $this->assertEquals($json, $client->getResponse()->getContent());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testgetCharactersByDate()
    {
        $client = static::createClient();

        $client->request('GET', '/characters/date/3018-09-10');
        $this->assertEquals('"error : date not found"', $client->getResponse()->getContent());

        $client->request('GET', '/characters/date/3019-03-10');
        $json = '[{"id":169,"character":{"id":1,"slug":"aragorn","name":"Aragorn, dit Grands-Pas","race":{"id":1,"slug":"homme","description":"L\'humanit\u00e9, race jeune en opposition aux autres races humano\u00efdes telles les Elfes, les Nains ou les Orques."}},"date":"3019-03-10T00:00:00+0100","coordx":45,"coordy":52,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":353,"character":{"id":2,"slug":"boromir","name":"Boromir, fils de Denethor","race":{"id":1,"slug":"homme","description":"L\'humanit\u00e9, race jeune en opposition aux autres races humano\u00efdes telles les Elfes, les Nains ou les Orques."}},"date":"3019-03-10T00:00:00+0100","coordx":61,"coordy":56,"status":{"id":3,"slug":"Mort"}},{"id":537,"character":{"id":3,"slug":"frodon","name":"Frodon Sacquet","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-03-10T00:00:00+0100","coordx":64,"coordy":61,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":721,"character":{"id":4,"slug":"gandalf","name":"Gandalf le gris, puis Gandalf le blanc","race":{"id":4,"slug":"maia","description":"Ils font partie des Ainur, les divinit\u00e9s issues de l\'esprit d\'Il\u00favatar, le dieu cr\u00e9ateur."}},"date":"3019-03-10T00:00:00+0100","coordx":59,"coordy":60,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":905,"character":{"id":5,"slug":"gimli","name":"Gimli, fils de Gl\u00f3in","race":{"id":2,"slug":"elfe","description":"Les a\u00een\u00e9s des Enfants d\'Il\u00favatar, les cadets \u00e9tant les Hommes."}},"date":"3019-03-10T00:00:00+0100","coordx":45,"coordy":52,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1089,"character":{"id":6,"slug":"legolas","name":"Legolas Vertefeuille, fils de Thranduil","race":{"id":2,"slug":"elfe","description":"Les a\u00een\u00e9s des Enfants d\'Il\u00favatar, les cadets \u00e9tant les Hommes."}},"date":"3019-03-10T00:00:00+0100","coordx":45,"coordy":52,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1273,"character":{"id":7,"slug":"merry","name":"Meriadoc Brandebouc, dit Merry","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-03-10T00:00:00+0100","coordx":45,"coordy":52,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1457,"character":{"id":8,"slug":"pippin","name":"Peregrin Touque, dit Pippin","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-03-10T00:00:00+0100","coordx":59,"coordy":60,"status":{"id":1,"slug":"Bonne sant\u00e9"}},{"id":1641,"character":{"id":9,"slug":"sam","name":"Samsagace Gamegie, dit Sam","race":{"id":3,"slug":"hobbit","description":"Egalement appel\u00e9s Semi-hommes ou Periannath."}},"date":"3019-03-10T00:00:00+0100","coordx":64,"coordy":61,"status":{"id":1,"slug":"Bonne sant\u00e9"}}]';
        $this->assertEquals($json, $client->getResponse()->getContent());
        $this->assertJson($client->getResponse()->getContent());
    }

}
