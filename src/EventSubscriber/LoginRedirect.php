<?php

namespace Drupal\demomodule\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\demomodule\Event\UserLoginEvent;
use Drupal\Core\Url;

/**
 * Redirects user to dashboard.
 */
class LoginRedirect implements EventSubscriberInterface {

  const EVENT_NAME = 'demomodule_user_login';

  /**
   * Database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      // Static class constant => method on this class.
      LoginRedirect::EVENT_NAME => 'onUserLogin',
    ];
  }

  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\demomodule\Event\UserLoginEvent $event
   *   Dat event object yo.
   */
  public function onUserLogin(UserLoginEvent $event) {
    $response = new RedirectResponse(Url::fromRoute('demomodule.dashboard')->setAbsolute()->toString());
    $request = \Drupal::request();
    $request->getSession()->save();
    $response->prepare($request);
    \Drupal::service('kernel')->terminate($request, $response);
    $response->send();
  }

}
