<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\OrderItem;
use App\Entity\Payment;
use App\Form\PaymentType;
use App\Form\OrderNewType;
use App\Form\OrderItemType;
use App\Repository\OrderItemRepository;
use App\Repository\AdressRepository;
use App\Repository\ArticleRepository;
use App\Repository\OrderRepository;
use App\Repository\PaymentMethodRepository;
use App\Service\Order\OrderService;
use App\Service\Payment\PaymentService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OrderController extends AbstractController
{
    private $urlGenerator;
    public function __construct(UrlGeneratorInterface $urlGeneratorInterface)
    {
        $this->urlGenerator= $urlGeneratorInterface;
    }
    /**
     * @Route("/admin/order/order-adress/{id}/manage-adress", name="order_adress")
     */
    public function adress($id, AdressRepository $adressRepository): Response
    {
        return $this->renderForm('admin/order/adresses.html.twig',[
            'adresses' => $adressRepository->findByOrder($id),
        ]);
    }

    /**
     * @Route("/admin/order/client", name="order_client_index", methods={"GET"})
     */
    public function Clientindex(OrderRepository $orderRepository): Response
    {
        $user = $this->getUser();
        return $this->render('admin/order/client/index.html.twig', [
            'nbrOrders'=>count($orderRepository->findAll()),
            'orders'=>$orderRepository->findClient($user->getId()),
            'ordersCompleted'=>$orderRepository->findState('completed'),
            'ordersInProgress'=>$orderRepository->findState('in progress'),
            'ordersWaiting'=>$orderRepository->findState('waiting'),
            'ordersCanceled'=>$orderRepository->findState('canceled'),
        ]);
    }
    /**
     * @Route("/admin/order/", name="order_index", methods={"GET"})
     */
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('admin/order/index.html.twig', [
            'nbrOrders'=>count($orderRepository->findAll()),
            'orders'=>$orderRepository->findAll(),
            'ordersCompleted'=>$orderRepository->findState('completed'),
            'ordersInProgress'=>$orderRepository->findState('in progress'),
            'ordersWaiting'=>$orderRepository->findState('waiting'),
            'ordersCanceled'=>$orderRepository->findState('canceled'),
        ]);
    }

    /**
     * @Route("/customer/order/new-order", name="order_customer", methods={"GET","POST"})
     * @Route("/admin/order/new-order", name="order_user", methods={"GET","POST"})
     */
    public function newOrder(PaymentMethodRepository $paymentMethodRepository, ArticleRepository $articleRepository, Request $request, OrderService $orderService, SessionInterface $session): Response
    {
        $order = new Order();
        $order->setPaymentState('in progress');
        $order->setShippingState('in progress');
        $order->setCheckoutState('in progress');
        $order->setState('in progress');
        $order->setShipping(500);
        $order->setNumber($orderService->voiceNumber());
        $order->setPaymentDue(new \DateTime('+ 6 day') );
        $user  = $this->getUser();
        $adresses = $user->getAdresses();
        $order->setShippingAdress($adresses[0]);
        $order->setUser($user);
        $panier = $session->get('panier');
        $total = 0;
        foreach ($panier as $key => $value) {
           $article = $articleRepository->find($key);
           $orderItem = new OrderItem();
           $orderItem->setProduitName($article->getTitle());
           $orderItem->setQuantity($value);
           $orderItem->setUnitPrice($article->getPrice());
           $orderItem->setUnitsTotal($orderItem->getUnitPrice() * $orderItem->getQuantity());
           $orderItem->setTotal($orderItem->getUnitsTotal() + $orderItem->getAdjustmentsTotal() );
           $total += $orderItem->getTotal();
           $orderItem->setArticle($article);
           $order->addOrderItem($orderItem);
        }
        $order->setItemsTotal($total);
        $order->setAdjustmentsTotal($order->getShipping());
        $order->setTotal($order->getItemsTotal() + $order->getAdjustmentsTotal() );
        $payment = new Payment();
        $payment->setAmount($order->getTotal());
        $payment->setState('in progress');
        $method = $paymentMethodRepository->find(3);
        $payment->setPaymentMethod($method);
        // $payment->setOrderPayment($order);
        // dump($total);
        // $order = $orderService->calculPersist($order);
        $order->setPayment($payment);
        
        // dd($order);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($order);
        $entityManager->flush();
        $this->addFlash('success','Order created');
        $session->set('panier',[]);
        return $this->redirectToRoute('client_index',[],Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/admin/order/new", name="order_new", methods={"GET","POST"})
     */
    public function new(Request $request, OrderService $orderService): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderNewType::class, $order);
        $form->handleRequest($request);
    
        dd($request->getSession());

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $order = $orderService->calculPersist($order);
            $entityManager->persist($order);
            $entityManager->flush();
            $this->addFlash('success','Order created');
            // dd($order);
            return $this->redirectToRoute('order_edit', ['id'=>$order->getId(),'tab'=>'articles'], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/order/new.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/order/{id}", name="order_show", methods={"GET"})
     */
    public function show(Order $order): Response
    {
        // dd($order);
        // dump($order);
    //    $var =  sprintf("%06s", 1);
        // $ribbon_text = ($order->getState() == 'paid') ? 'PAID':'NOT PAID';

        return $this->render('admin/order/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/order/print/{id}", name="order_print", methods={"GET"})
     */
    public function invoice(Order $order): Response
    {
        dump($order);
        return $this->render('admin/order/print.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/admin/order/client/{id}/edit", name="order_edit_client", methods={"GET","POST"})
     * @Route("/admin/order/{id}/edit", name="order_edit", methods={"GET","POST"})
     */
    public function edit( Request $request, Order $order, OrderItemRepository $orderItemRepository,  OrderService $orderService, PaymentService $paymentService): Response
    {
        // dd($request)
        $message = '';
        // debut payment
        $payment = $order->getPayment();
        $formPayment = $this->createForm(PaymentType::class, $payment);
        $formPayment->handleRequest($request);
        //en payment
       //Debut new orderItem 
        $orderItem = new OrderItem();
        $formItem = $this->createForm(OrderItemType::class, $orderItem);
        $formItem->handleRequest($request);
        // dump($order->getOrderItem()->getValues());
        if ($formItem->isSubmitted() && $formItem->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            //add order item 
            $orderService->orderItemAdd($orderItem, $order);
            
            $order->setItemsTotal($orderService->subTotal($order));
            

            $orderItemPost =  $orderItemRepository->findOneBy([
                        'produit_name'=>$orderItem->getArticle()->getTitle(),
                        'commande'=>$order->getId()
            ]);

            if(!$orderItemPost){
                $entityManager->persist($orderItem,$order);
                $message = 'Order item  add';
                $entityManager->flush();
                $this->addFlash('success',$message);
                return $this->redirectToRoute('order_edit', ['id'=>$order->getId(),'tab'=>'articles'], Response::HTTP_SEE_OTHER);       
            }
            $message = "Article existe dans la commande ";
            $this->addFlash('warning',$message);
            
        }
        //end new orderItem
        
        // order 
        $form = $this->createForm(OrderType::class, $order,[
            'user'=>$order->getUser()
        ]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {            
            
            if($order->getShipping() <= 0 || empty($order->getShipping()) )
            {
                $order->setShipping(0);
            }
            if($order->getState() == 'completed')
            {
                $order->setShippingState('completed');
                $order->setCheckoutState('completed');
                $payment->setState('completed');
                $order->setPayment($payment);
                $order->setCheckoutCompletedAt(new \DateTime());
            }
            // dd('oups');
            //
            $this->getDoctrine()->getManager()->flush();
            // return $this->redirectToRoute('order_index', [], Response::HTTP_SEE_OTHER);
            $this->addFlash('success','Order modified');
            return $this->redirectToRoute('order_edit', ['id'=>$order->getId()], Response::HTTP_SEE_OTHER);       
        }

        $orderService->calculOrder($order);

        $payment = $order->getPayment();
        $payment->setAmount($order->getTotal());

        $paymentService->calculPayment($payment);
        $order->setPayment($payment);
        
        $breadcrumb=
        [
            [
                'path'=>$this->urlGenerator->generate('order_index'),
                'name'=>'Manage orders'
            ]
        ];
        return $this->renderForm('admin/order/edit.html.twig', [
            'order' => $order,
            'form' => $form,
            'formItem' => $formItem,
            'formFacturation'=>$formPayment,
            'breadcrumb'=>$breadcrumb
        ]);
    }

    /**
     * @Route("/admin/order/{id}", name="order_delete", methods={"POST"})
     */
    public function delete(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index', [], Response::HTTP_SEE_OTHER);
    }
}