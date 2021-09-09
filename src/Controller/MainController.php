<?php
/**
 * This file is part of Berlioz framework.
 *
 * @license   https://opensource.org/licenses/MIT MIT License
 * @copyright 2020 Ronan GIRON
 * @author    Ronan GIRON <https://github.com/ElGigi>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code, to the root.
 */

declare(strict_types=1);

namespace App\Controller;

use Atlas\Orm\Atlas;
use Berlioz\Core\Exception\BerliozException;
use Berlioz\HttpCore\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Twig\Error\Error;

/**
 * Class MainController.
 *
 * @package App\Controller
 */
class MainController extends AbstractController
{
    /**
     * Home route.
     *
     * @return ResponseInterface|string
     * @throws BerliozException
     * @throws Error
     * @route("/")
     */
    public function home()
    {
        /** @var Atlas $atlas */
        /*$atlas = $this->getService('atlas');
        $atlas = $this->getService(\Atlas\Orm\Atlas::class);
        var_dump('dd');die();*/
        return $this->render('home.html.twig');
    }
}