<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
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
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;

        $orders = $this->orderRepository->scopeQuery(function($query) use($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->visible(['id', 'name', 'price'])->all();
        return view('customer.order.create', compact('products'));
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        
        $this->orderService->create($data);
        
        return redirect()->route('customer.order.index');
    }  
}
