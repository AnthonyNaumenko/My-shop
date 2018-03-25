<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 25.03.18
 * Time: 15:02
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LukyController
{
    /**
          * @Route("/lucky/number")
          *
          * @Route Response
     */
    public function number()
    {
        $number = mt_rand(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

}