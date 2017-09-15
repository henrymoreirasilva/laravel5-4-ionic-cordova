<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthCheckRole
{
    private $userRepository;
    
    public function __construct(\CodeDelivery\Repositories\UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $userId = Authorizer::getResourceOwnerId();
        $user = $this->userRepository->find($userId);
        
        if ($user->role != $role) {
            abort(403, 'Access forbiden');
        }
        
        return $next($request);
    }
}
