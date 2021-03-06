<?php

namespace App\Form;

use App\Entity\Adress;
use App\Entity\User;
use App\Entity\Order;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $user =  $options['user'];
        $builder
            ->add('created_at',DateType::class,[
                'label'=>'Date'
            ])
            // ->add('number',IntegerType::class,[
            //     'attr'=>[
            //         ''
            //     ],
            //     'help'=>'Number of order'
            // ])
            
            ->add('state',ChoiceType::class,[
                'choices'=>[
                    'Canceled'=>'canceled',
                    'Waiting'=>'waiting',
                    'in progress'=>'in progress',
                    'Completed'=>'completed'
                ]
            ])
            ->add('note',TextareaType::class)
            // ->add('user',EntityType::class,[
            //     'class'=>User::class,
            //     'choice_label'=>'personne.lastName',
            //     'attr'=>[
            //         'disabled'=>true
            //     ]
            // ])
            // ->add('checkout_completed_at')
            // ->add('total')
            // ->add('checkout_state',ChoiceType::class,[
            //     'choices'=>[
            //         'incomplet'=>'incomplet',
            //         'completed'=>'completed'
            //     ]
            // ])
            // ->add('payment_state',ChoiceType::class,[
            //     'choices'=>[
            //         'awaiting_payment'=>'awaiting_payment',
            //         'Paid'=>'Paid'
            //     ]
            // ])
            ->add('shipping_state',ChoiceType::class,[
                'choices'=>[
                    'in Progress'=>'In progress',
                    'Ready'=>'Ready',
                    'shipped'=>'shippedd',
                    'completed'=>'Completed',
                ]
            ])
            ->add('shipping_adress',EntityType::class,[
                'class'=>Adress::class,
                'query_builder'=> function(EntityRepository $entityRepository) use($user) {
                    return $entityRepository->createQueryBuilder('p')
                    ->where("p.user = ". $user->getId());
                },
                'choice_label'=>'street',
                'group_by'=>'lastname'
            ])
            ->add('shipping',IntegerType::class,[
                'attr'=>[
                    'required'=>true
                ],
                'label'=>'Shipping amount'
            ])
            
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
            'translation_domain'=>'forms',
            'user'=>null
        ]);
    }
}