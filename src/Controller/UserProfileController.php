<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/user/profile", name="user_profile")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findAll();
        $companies = new ArrayCollection();

        if(count($company) == 0){
            $company = new Company();
            $user->addCompany($company);
        }else{
            foreach ($user->getCompany() as $company){
                $companies->add($company);
            }
        }

        $form= $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            foreach ($companies as $company){
                if($user->getCompany()->contains($company) === false){
                    $em->remove($company);
                }
            }
            $em->persist($user);
            $em->flush();
        }

        return $this->render('user_profile/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user->getUsername()
        ]);
    }
}
