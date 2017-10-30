<?php
//
// Database Mapping Test
//
class WorldController extends AppController {

  // Needed to enable JsonView
  // http://book.cakephp.org/2.0/en/views/json-and-xml-views.html#enabling-data-views-in-your-application
  public $components = array('RequestHandler');

  public function index() {

    // Read number of queries to run from URL parameter
    // http://book.cakephp.org/2.0/en/controllers/request-response.html#accessing-request-parameters
    $query_count = $this->request->query('queries');

    $query_count = (int)$query_count;
    if ($query_count === 0) {
      $query_count = 1;
    } elseif ($query_count > 500) {
      $query_count = 500;
    }

    // Create an array with the response string.
    $worlds = array();

    // For each query, store the result set values in the response array
    for ($i = 0; $i < $query_count; $i++) {
      	// Retrieve a model by ID
      	// http://book.cakephp.org/2.0/en/models/retrieving-your-data.html#find
		$worlds[] = $this->World->find('randomId');
    }

    # Return json list
  	$this->set('worlds', $worlds);

    // Use the CakePHP JSON View
    // http://book.cakephp.org/2.0/en/views/json-and-xml-views.html
    $this->set('_serialize', 'worlds');
	$this->RequestHandler->renderAs($this, 'json');
  }

  public function query()
  {
  	$world = $this->World->find('randomId');

  	$this->set('world', $world);
  	$this->set('_serialize', 'world');
  	$this->RequestHandler->renderAs($this, 'json');
  }
}
