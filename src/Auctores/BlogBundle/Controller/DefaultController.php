<?php

namespace Auctores\BlogBundle\Controller;

use Auctores\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($page)
    {


        $repo = $this->getDoctrine()
            ->getRepository('AuctoresBlogBundle:Article');
        $max = 5;
        $total = $repo->getCount();

        //Verification du bon numéro de page
        if ($page < 1 || $page > ceil($total/$max))
        {
            $page = 1;
        }

        $pagination = array(
            'page' => $page,
            'route' => 'auctores_blog_homepage',
            'pages_count' =>ceil($total/$max),
            'route_params' => array()
        );

        $result= $repo
            ->getList($page,$max);

        return $this->render('AuctoresBlogBundle:Default:index.html.twig', array(
            'listArticle'  => $result,
            'pagination' => $pagination));
    }

    public function addArticleAction()
    {
        $article = new Article();
        $article->setTitle("Le blog decade fait son test numero ");

        $article->setDate(new \DateTime());
        $article->setText("Le blog de Decade est heureux de vous accueillir sur ce site.
        Vous pourrez y suivre l'avancée du projet ainsi que les dernières actualités concernant le concept.");
        $article->setSlug("test");
        $em = $this->getDoctrine()->getManager();

        $em->persist($article);
        $em->flush();

        $article->setTitle("Le blog decade fait son test numero ".$article->getId());
        $article->setSlug("test".$article->getId());
        $em->persist($article);
        $em->flush();


        return $this->redirect($this->generateUrl('auctores_blog_homepage'));

    }

    public function articleAction($slug)
    {
        $article= $this->getDoctrine()
            ->getRepository('AuctoresBlogBundle:Article')->findOneBySlug($slug);

        return $this->render('AuctoresBlogBundle:Default:article.html.twig', array(
            'article'  => $article,));
    }
}
