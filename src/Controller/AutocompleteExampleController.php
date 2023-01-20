<?php

namespace Drupal\autocomplete_example\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AutocompleteExampleController extends ControllerBase {

  public function citiesAutocomplete(Request $request): JsonResponse {
	  $results = [];
	  $input = $request->query->get('q');
	  if (!$input) {
		  return new JsonResponse($results);
	  }
	  $input = Xss::filter($input);
	  $query = \Drupal::entityQuery('taxonomy_term')
      ->accessCheck(FALSE)
      ->condition('vid', 'cities')
		  ->condition('name', $input, 'CONTAINS')
		  ->condition('status', 1)
		  ->groupBy('tid')
		  ->sort('name', 'ASC')
		  ->range(0, 10);
	  $ids = $query->execute();
		$terms = Term::loadMultiple($ids) ?? [];
	  foreach ($terms as $term) {
			$name = $term->getName();
		  $results[] = [
			  'value' => $name,
			  'label' => $name,
		  ];
	  }
	  return new JsonResponse($results);
  }

}
