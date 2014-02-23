<?php

namespace Lebed\GuestbookBundle\Twig;

use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Bundle\FrameworkBundle\Controller;

class GuestbookExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
            'ReadMore' => new \Twig_Filter_Method($this, 'readMoreFilter', array('is_safe' => array('html')) )
        );
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function readMoreFilter($str, $link = '#', $limit = 20, $read_more_text = 'Read more')
    {
        if (!is_null($str)){
            $array_str = explode(' ', $str, $limit + 1);
            array_pop($array_str); // delete last element of array
            $str = implode(' ', $array_str);
            $str.= "...<p><a class='btn btn-info' href=\"".$link."\" role='button'>".$read_more_text."&raquo;</a></p>";
        }

        return $str;
    }

    public function getName()
    {
        return 'guestbook_extension';
    }
}