<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface as AuthorizationChecker;


class UserAuthenticationSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;
    private $security;

    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationChecker $security)
    {
        $this->tokenStorage = $tokenStorage;
        $this->security = $security;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        // Exclude specific routes from the check (e.g., login route)
        $excludedRoutes = ['home', 'app_login', 'app_logout', 'app_register', 'app_forgot_password_request', 'app_check_email', 'app_reset_password'];
        $routeName = $request->get('_route') ?? '';

        // ou si l'url commence par _wdt ou _profiler (debug)
        if (strpos($routeName, '_wdt') === 0 || strpos($routeName, '_profiler') === 0) {
            return;
        }

        if (in_array($routeName, $excludedRoutes)) {
            return;
        }

        // Check if the user is authenticated
        if (!$this->security->isGranted('IS_AUTHENTICATED_FULLY')) {
            // Redirect or handle unauthorized access as needed
            $event->setResponse(new RedirectResponse('/login'));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
