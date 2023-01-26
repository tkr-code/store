<?php

namespace App\Controller\Main;

use App\Entity\Article;
use App\Entity\ArticleFiltre;
use App\Entity\ArticleSearch;
use App\Entity\Comment;
use App\Form\ArticleFiltreType;
use App\Form\ArticleSearchType;
use App\Form\CommentType;
use App\Repository\ArticleBuyRepository;
use App\Repository\ArticleRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\ParentCategoryRepository;
use Cocur\Slugify\Slugify;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ArticleController extends AbstractController
{
    /**
     * @Route("article/{category}/{slug}/{id}", name="articles_show", requirements={"slug": "[a-z0-9\-]*"} )
     */
    public function show( PaginatorInterface $paginatorInterface, CommentRepository $commentRepository, ArticleBuyRepository $articleBuyRepository, Article $article,string $category, string $slug, Request $request, ArticleRepository $articleRepository): Response
    {
        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        if($slug !== $article->getSlug() || $category !== $article->getCategory()->getSlug() ){
            return $this->redirectToRoute('articles_show',
                [
                    'category'=>$article->getCategory()->getSlug(),
                    'slug'=>$article->getSlug(),
                    'id'=>$article->getId()
                ],301);
        }
        $search = new ArticleSearch();
        $form = $this->createForm(ArticleSearchType::class,$search);
        
        $comment = new Comment();
        $comment->setArticle($article);
        
        $formComment = $this->createForm(CommentType::class, $comment);
        $formComment->handleRequest($request);
        
        if ($formComment->isSubmitted() && $formComment->isValid()) {
            if(!empty($this->getUser())){
                $comment->setUser($this->getUser());
            }else{
                return $this->redirectToRoute('app_login');
            }
            $ratting = $request->request->get('rating');
            $comment->setRating($ratting);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success','Le commentaire a été enregistré');
            return $this->redirectToRoute('articles_show',
                [
                    'category'=>$article->getCategory()->getSlug(),
                    'slug'=>$article->getSlug(),
                    'id'=>$article->getId()
                ],Response::HTTP_SEE_OTHER);
        }
        $user = $this->getUser();


        $isBuy = $isComment = false;
        if($user){
            $client = $user->getClient();
            if($client)
            {               
                $isBuy = $articleBuyRepository->isBuy($client,$article);
            }
            $isComment = $commentRepository->isComment($user,$article);
        }

        $pagination = $paginatorInterface->paginate(
            $articleRepository->showPagination(),
            $request->query->getInt('page',1),
            1
        );

        return $this->renderForm($this->getParameter('template').'/shop/show.html.twig', [
            'article'=>$article,
            'articles'=>$articleRepository->findBy(['enabled'=>true,'etat'=>'top'],null,12),
            'form' => $form,
            'formComment' => $formComment,
            'is_buy'=>$isBuy,
            'is_comment'=>$isComment,
            'propositions'=>$articleRepository->findAll(),
            'article_rand'=>$articleRepository->findRand(20,$article)
        ]);
    }
    /**
     * @Route("/boutique", name="articles")
     * @Route("/boutique/{category3}", name="articles_category3")
     * //@Route("/boutique/{category3_slug}/{category2}", name="articles_category2")
     * @Route("/boutique/{category3_slug}/{category2_slug}/{category}", name="articles_category")
     */
    public function index(
        string $parent = null,
        string $category = null,
        string $category3 = null,
        string $category2 = null,
        SessionInterface $sessionInterface,
        ParentCategoryRepository $parentCategoryRepository,
        Request $request,
        PaginatorInterface $paginator,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        BrandRepository $brandRepository): Response
    {
        $category = str_replace('-',' ',$category);
        $search = new ArticleSearch();
        $route_name = $request->attributes->get('_route');
        if ($route_name == 'articles_category') {
            $search->setCategory($category);
        } elseif ($route_name == 'articles_category3') {
            $search->setCategory3($category3);
        } elseif ($route_name == 'articles_category2') {
            $search->setCategory2($category2);
        }
        $sort_valide = [
            'created_at', 'ASC', 'DESC', 'price'
        ];
        $sort_by = ($sessionInterface->get('sort_by'))? $sessionInterface->get('sort_by'): [];
        if (!is_array($sort_by)) {
            $sort_by = explode(':', $sort_by);
            if (!in_array($sort_by[0], $sort_valide)) {
                $sort_by = [];
            }
        }else{
            $sort_by = [];
        }

        $form = $this->createForm(ArticleSearchType::class,$search)->handleRequest($request);
        $pagination = $paginator->paginate(
            $articleRepository->search(
                $search->getMots(),
                $search->getCategory3(),
                $search->getCategory2(),
                $search->getCategory(),
                $search->getMinPrice(),
                $search->getMaxPrice(),
                $search->getBrand(),
                $search->getEtat(),
                $sort_by
            ),
            $request->query->getInt('page',1),
            12
        );
        return $this->renderForm($this->getParameter('template').'/shop/index.html.twig', [
            'articles' => $pagination,
            'form'=>$form,
            'brands'=> $brandRepository->findAll(),
            'breadcrumb'=>[
                'parent'=>ucfirst($parent),
                'category'=>ucfirst($category)
            ],
            'categorie'=>$categoryRepository->findOneBy([
                'title'=>$category
            ]),
            'category'=>$categoryRepository->findAll(),
            'category_parents'=>$parentCategoryRepository->etat(true),
            'top_articles'=>$articleRepository->findBy(['enabled'=>true,'etat'=>'top'],null,12),
        ]);
    }

    /**
     * @Route("/suggestion/", name="suggestions")
     */
    public function suggestion($mots, ArticleRepository $articleRepository)
    {
       $search = $articleRepository->searchJson($mots);
        // dd($search);
        return $this->json(
            [
                'suggests'=>[ $search ]
            ]
        );
    }
}