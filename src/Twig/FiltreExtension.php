<?php 
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FiltreExtension extends AbstractExtension
{
    public function getFunctions():array
    {
        return[
            new TwigFunction('sidebar',[$this,'filtres'])
        ];
    }

    public function filtres()
    {
        return 
        [
            'part1'=>
            [
                [
                    'min'=>'100',
                    'max'=>'3000'
                ],
                [
                    'min'=>'3000',
                    'max'=>'5000'
                ],
                [
                    'min'=>'10000',
                    'max'=>'50000'
                ],
                [
                    'min'=>'50000',
                    'max'=>'75000'
                ],
                [
                    'min'=>'50000',
                    'max'=>'100000'
                ],
            ],
            'part2'=>
            [
                [
                    'min'=>'100000',
                    'max'=>'200000'
                ],
                [
                    'min'=>'200000',
                    'max'=>'300000'
                ],
                [
                    'min'=>'300000',
                    'max'=>'400000'
                ],
                [
                    'min'=>'400000',
                    'max'=>'500000'
                ],
                [
                    'min'=>'500000',
                    'max'=>'1000000'
                ],
            ]
            
        ];
    }
}