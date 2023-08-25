<?php

namespace App\Controller\Api;

use App\Repository\PictureRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PictureController extends AbstractController
{
    /**
     * Get Post collection
     * @Route("/api/pictures", name="api_pictures", methods={"GET"})
     */
    public function getCollectionPicture(PictureRepository $pictureRepository): JsonResponse
    {
        //on utilise la méthode getGallery() crée dans PictureRepository pour lister tous les images
        $pictures = $pictureRepository->getGallery();
      
        //on retourne la liste d'articles en format json 
        //cet liste d'images est retourné dans un tableau en suivant les règles de securité OWASP
        return $this->json(
            // 1er parametres = ce qu'on veut afficher
            $pictures,
            // 2eme parametre : le code status
            // voir liste des code status : https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
            200,
            // 3eme parametre = le header
            [],
            // 4eme parametre : le/les groupe(s)
            // Les groupes permettent de définir quels éléments de l'entité on veut afficher
            ['groups' => 'get_collection_picture']
        );

    }
}
