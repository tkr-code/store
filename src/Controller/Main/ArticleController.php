<?php

namespace App\Controller\Main;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use App\Form\ArticleSearchType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("articles/{category}/{slug}/{id}", name="articles_show", requirements={"slug": "[a-z0-9\-]*"} )
     */
    public function articleshow(Article $article,string $category, string $slug, Request $request, CategoryRepository $categoryRepository): Response
    {
        if($slug !== $article->getSlug() || $category !== strtolower($article->getCategory()->getTitle() )){
            return $this->redirectToRoute('articles_show',
                [
                    'category'=> strtolower( $article->getCategory()->getTitle()),
                    'slug'=>$article->getSlug(),
                    'id'=>$article->getId()
                ],301);
        }
        $search = new ArticleSearch();
        $form = $this->createForm(ArticleSearchType::class,$search);
        // $comment = new Comment();
        // $comment->setProduit($produit);
        
        // $comment->setAdmin($this->getUser());
        // $form = $this->createForm(CommentType::class, $comment);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($comment);
        //     $entityManager->flush();
        //     $this->addFlash('success','Commentaire enregistré');
        //     return $this->redirectToRoute('articles_show',
        //         [
        //             'category'=>$category,
        //             'slug'=>$slug,
        //             'id'=>$produit->getId()
        //         ], Response::HTTP_SEE_OTHER);
        // }
        return $this->renderForm('main/article/show.html.twig', [
            'article'=>$article,
            'category' => $categoryRepository->findAll(),
            'form' => $form,
        ]);
    }
    /**
     * @Route("/articles", name="articles")
     * @Route("/articles/{categorieTitle}", name="articles_categorie")
     */
    public function index(string $categorieTitle = null, Request $request, PaginatorInterface $paginator, ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $search = new ArticleSearch();
        $form = $this->createForm(ArticleSearchType::class,$search)->handleRequest($request);
        if($categorieTitle){
            $categorieTitle = str_replace('-',' ',$categorieTitle);
        }
        $pageGroupe = ($categorieTitle) ? $articleRepository->findByCategoryTitle($categorieTitle,$request->get('minPrice'),$request->get('maxPrice')) : 
        $articleRepository->search(
            $search->getMots(),
            $search->getCategory(),
            $search->getMinPrice(),
            $search->getMaxPrice()
        ); 
        $pagination = $paginator->paginate($pageGroupe, $request->query->getInt('page',1), 12);
        return $this->renderForm('main/article/index.html.twig', [
            'articles' => $pagination,
            'form'=>$form,
            'category'=>$categoryRepository->findAll()
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