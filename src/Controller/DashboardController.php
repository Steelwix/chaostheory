<?php

    namespace App\Controller;

    use App\Entity\Produit;
    use App\Form\TaskType;
    use PHPUnit\Util\Json;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Validator\Constraints\Date;
    use Symfony\UX\Turbo\TurboBundle;

    class DashboardController extends AbstractController
    {
        private $produit;
        public function __construct(Produit $produit){
            $this->produit = $produit;
        }
        #[Route('/', name: 'app_dashboard')]
        public function home(Request $request): Response
        {
            return $this->render('dashboard/index.html.twig');
        }

        #[Route('/ajax', name: 'test_ajax')]
        public function ajaxContent(Request $request)
        {
            $data['name'] = $request->request->get('name');
            $data['email'] = $request->request->get('email');
            $data['year'] = '2023';
            $data['month'] = 'Aout';
            $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
            return $this->render('dashboard/about.html.twig', ['data' => $data]);
        }

        #[Route('/produit', name: 'app_produit')]
        public function produit()
        {
            $tousLesProduits = $this->produit->getAllProduits();
            return $this->render('produit/produit.html.twig', ['produits' => $tousLesProduits]);
        }

        #[Route('/produit/ajax/filter/{filtre}', name: 'app_produit_filter')]
        public function filtrerLesProduits(Request $request, $filtre)
        {
            if($filtre == 10){
                $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
                return $this->render('dashboard/index.html.twig');
            }
            $products = $this->produit->getThroughFilter($filtre);

            $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
            return $this->render('produit/refresh.html.twig', ['produits' => $products]);
        }

        #[Route('/produit/ajax/declinaison/{produit}', name: 'app_produit_declinaison')]
        public function getDeclinaisonList(Request $request, $produit)
        {
            if(in_array($produit, $this->produit->getProduitsSolid())){
                dd("objet");
            }
            dd("liquid");

            $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
            return $this->render('produit/refresh.html.twig', ['produits' => $products]);
        }


    }
