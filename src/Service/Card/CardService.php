<?php 
namespace App\Service\Card;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardService{
    private$session;
    private $articleRepository;
    public function __construct(SessionInterface $sessionInterface, ArticleRepository $articleRepository)
    {
        $this->session =$sessionInterface;
        $this->articleRepository = $articleRepository;
    }
    public function add(int $id)
    {
        $panier = $this->session->get('panier',[]);

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        
        $this->session->set('panier',$panier);
        
    }
    public function remove(int $id)
    {
        $panier = $this->session->get('panier',[]);

        if(!empty($panier[$id])){
            $panier[$id]--;
        }else{
            $panier[$id] = 1;
        }
        
        $this->session->set('panier',$panier);
        
    }
    public function delete(int $id)
    {
        $panier = $this->session->get('panier',[]);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $this->session->set('panier',$panier);
    }
    public function getFullCard(): array
    {
        $panier = $this->session->get('panier',[]);
        $panierWithData = [];
        foreach($panier as $id => $quantite){
            $panierWithData[]=[
                'article'=>$this->articleRepository->find($id),
                'quantite'=>$quantite
            ];
        }
        return $panierWithData;
    }
    public function getTotal():float
    {
        $total = 0;
        foreach ($this->getFullCard() as $item) {
            $total+= $item['article']->getPrice() + $item['quantite'];
        }
        return $total;
    }
}