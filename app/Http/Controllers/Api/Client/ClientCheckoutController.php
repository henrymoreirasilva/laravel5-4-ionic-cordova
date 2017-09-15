<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use CodeDelivery\Http\Requests\CheckoutRequest;

class ClientCheckoutController extends Controller
{
    private $userRepository;
    private $productRepository;
    private $orderRepository;
    private $orderService;
    
    public function __construct(UserRepository $userRepository, ProductRepository $productRepository, OrderRepository $orderRepository, OrderService $orderService) {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($userId)->client->id;

        $orders = $this->orderRepository->with(['items', 'deliveryman', 'cupom'])->scopeQuery(function($query) use($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }


    public function store(CheckoutRequest $request)
    {
        
        $userId = Authorizer::getResourceOwnerId();
        
        $data = $request->all();
        
        $clientId = $this->userRepository->find($userId)->client->id;
        $data['client_id'] = $clientId;
        
        $order = $this->orderService->create($data);
        $order = $this->orderRepository->with('items')->find($order->id);
        return $order;
    }  
    
    public function show($id)
    {
        $order = $this->orderRepository->with(['items', 'deliveryman', 'cupom'])->find($id);
        $order->items->each(function($item) {
            $item->product->category;
        });
        return $order;
    } 
    
    public function update($id)
    {
        return 'update';
    } 
}
