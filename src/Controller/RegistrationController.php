<?php

namespace App\Controller;

use App\Entity\ArticleSearch;
use App\Entity\Client;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RegistrationClientFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\Form\ArticleSearchType;

class RegistrationController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function appRegister(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $search = new ArticleSearch();
        $formSearch = $this->createForm(ArticleSearchType::class,$search);
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $adress = $form->get('adresses')->getData();
            $adress->setFirstName($user->getPersonne()->getFirstName());
            $adress->setLastName($user->getPersonne()->getLastName());
            $user->addAdress($adress);
            $user->setRoles(['ROLE_CLIENT']);
            $client = new Client();
            $user->setClient($client);

            // dd($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //     (new TemplatedEmail())
            //         ->from(new Address('malick.tounkara.1@gmail.com', 'store.test'))
            //         ->to($user->getEmail())
            //         ->subject('Please Confirm your Email')
            //         ->htmlTemplate('registration/confirmation_email.html.twig')
            // );
            // do anything else you need here, like send an email
            return $this->redirectToRoute('client_index');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('admin');
    }
}