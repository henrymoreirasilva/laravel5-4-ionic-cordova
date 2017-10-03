<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use \Illuminate\Http\Request;

class DeliverymanCheckoutController extends Controller
{
    private $userRepository;
    private $productRepository;
    private $orderRepository;
    private $orderService;
    
    private $with = ['client', 'cupom', 'items'];
    
    public function __construct(UserRepository $userRepository, ProductRepository $productRepository, OrderRepository $orderRepository, OrderService $orderService) {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        $orders = $this->orderRepository
                ->skipPresenter(false)
                ->with($this->with)
                ->scopeQuery(function($query) use($userId) {
                    return $query->where('user_deliveryman_id', '=', $userId);
                })
                ->paginate();

        return $orders;
    }

    public function show($id)
    {
        $deliverymanId = Authorizer::getResourceOwnerId();
        $order = $this->orderRepository
                ->skipPresenter(false)
                ->getByIdAndDeliveryman($id, $deliverymanId);
        
        return $order;
    } 
    
    public function update($id)
    {
        return 'update';
    } 
    
    public function updateStatus(Request $request, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        $order = $this->orderService->updateStatus($id, $idDeliveryman, $request->get('status'));

        if ($order) {
            return $this->orderRepository->find($order->id);
        }
        abort(400, 'Order não encontrado.');
    } 
}
