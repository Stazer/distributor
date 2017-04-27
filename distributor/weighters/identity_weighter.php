<?php
namespace distributor\weighters;

require_once('polynomial_weighter.php');

/**
 * Class which represents an identity weighter
 */
class IdentityWeighter extends PolynomialWeighter 
{
    /**
     * Creates an identity weighter
     */
    public function __construct()
    {
        parent::__construct([1, 1]);
    }
};

?>
     