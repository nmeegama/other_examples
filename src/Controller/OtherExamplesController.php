<?php
/**
 * Created by PhpStorm.
 * User: nmeegama
 * Date: 13/05/20
 * Time: 6:41 AM
 */
namespace Drupal\other_examples\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

class OtherExamplesController extends ControllerBase {

  /**
   * Returns a render-able array for shop page.
   */
  public function display() {
    $build = [
      '#markup' => $this->t('Ajax call example! <a class="use-ajax" href="/other-examples/ajax-call"> Ajax call</a> <div class="ajax-wrapper">Change me !!!</div>'),
    ];
    return $build;
  }

  /**
   * Route callback for Ajax call.
   * Only works for Ajax calls.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   */
  public function ajaxCall(Request $request) {
    if (!$request->isXmlHttpRequest()) {
      throw new NotFoundHttpException();
    }

    $response = new AjaxResponse();

    $Selector = '.ajax-wrapper'; //See: https://www.w3schools.com/cssref/css_selectors.asp
    $content = '<p>Changed !!!</p>'; /*The content that will be replace the matched element(s), either a render array or an HTML string.*/
    $settings = ['my-setting' => 'setting',]; /*An array of JavaScript settings to be passed to any attached behaviors.*/
    $response->addCommand(new ReplaceCommand($Selector, $content, $settings));
    return $response;
  }

}