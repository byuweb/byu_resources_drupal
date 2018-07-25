<?php

namespace Drupal\byu_resources\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ByuResourcesController
 * @package Drupal\byu_resources\Controller
 * Creates the page where the BYU resources will be listed.
 */

class ByuResourcesController extends ControllerBase {

  /**
   * Function that builds all the content that is found in the BYU resources page.
   * @return array - Content of the page.
   */

  public function content() {
    $html = '<div id="resources">Resources loading...</div>';
//    $readme = file_get_contents('https://raw.githubusercontent.com/byuweb/byu-calendar-components/master/README.md');
//    $html .= markdown_decode($readme);
    $json = file_get_contents('https://cdn.byu.edu/manifest.json');
    $json = json_decode($json);
    foreach($json->libraries as $library => $item) {
      if ($item->type == 'web-component') {
//        drupal_set_message($library);
        $sourceURL = $item->links->source;
        $parts = explode('/', $sourceURL);
        $nodeName = $parts[count($parts) - 1];
//        drupal_set_message($nodeName);
        drupal_set_message(make_title($nodeName));
      }
    }

    return [
      '#type' => 'markup',
      '#markup' => $this->t($html)
    ];
  }
}

function make_title($input) {
  $input = str_replace('-', ' ', $input);
  $input = str_replace('byu', 'BYU', $input);
  $input = ucwords($input);
  return $input;
}

/**
 * This function takes markdown text and converts it to html.
 * @param $input - Input string to be decoded.
 * @return string - Fully formatted html.
 */

function markdown_decode($input) {
  $stringArray = explode("\n", $input);
  $result = '';
  $preformatted = false;
  foreach ($stringArray as $line) {
    $header = false;
    // Preformatted text
    if (substr($line, 0, 3) == '```') {
      $line = htmlspecialchars($line);
      if (!$preformatted) {
        $line = preg_replace('/```/', '<pre>', $line, 1);
        $preformatted = true;
        $result .= $line;
      }
      else {
        $line = preg_replace('/```/', '</pre>', $line, 1);
        $preformatted = false;
        $result .= $line;
      }
    }
    else if($preformatted) {
      $line = htmlspecialchars($line) . "\n";
      $result .= $line;
    }

    // Find other formatting if not preformatted.
    if (!$preformatted) {
      // Headers
      if (substr($line, 0, 6) == '######') {
        $line = str_replace('###### ', '<h6>', $line);
        $result .= $line . '</h6>';
        $header = true;
      } else if (substr($line, 0, 5) == '#####') {
        $line = str_replace('##### ', '<h5>', $line);
        $result .= $line . '</h5>';
        $header = true;
      } else if (substr($line, 0, 4) == '####') {
        $line = str_replace('#### ', '<h4>', $line);
        $result .= $line . '</h4>';
        $header = true;
      } else if (substr($line, 0, 3) == '###') {
        $line = str_replace('### ', '<h3>', $line);
        $result .= $line . '</h3>';
        $header = true;
      } else if (substr($line, 0, 2) == '##') {
        $line = str_replace('## ', '<h2>', $line);
        $result .= $line . '</h2>';
        $header = true;
      } else if (substr($line, 0, 1) == '#') {
        $line = str_replace('# ', '<h1>', $line);
        $result .= $line . '</h1>';
        $header = true;
      }

      // Inline Code
      if (strpos($line, '`')) {
        $line = htmlspecialchars($line);
        while (strpos($line, '`')) {
          $line = preg_replace('/`/', '<code>', $line, 1);
          $line = preg_replace('/`/', '</code>', $line, 1);
        }
      }

      // Bold and Italics
      if (strpos($line, '**') || strpos($line, '__')) {
        while (strpos($line, '**')) {
          $line = preg_replace('/\*\*/', '<strong>', $line, 1);
          $line = preg_replace('/\*\*/', '</strong>', $line, 1);
        }
        while (strpos($line, '__')) {
          $line = preg_replace('/__/', '<strong>', $line, 1);
          $line = preg_replace('/__/', '</strong>', $line, 1);
        }
      }
      else if (strpos($line, '*') || strpos($line, '_')) {
        while (strpos($line, '*')) {
          $line = preg_replace('/\*/', '<em>', $line, 1);
          $line = preg_replace('/\*/', '</em>', $line, 1);
        }
        while (strpos($line, '_')) {
          $line = preg_replace('/_/', '<em>', $line, 1);
          $line = preg_replace('/_/', '</em>', $line, 1);
        }
      }
    }

    // If no formatting took place, add the line.
    if (!$header && !$preformatted) {
      $result .= '<p>' . $line . '</p>';
    }
  }
  return $result;
}