<?php

namespace Lexik\Bundle\PayboxBundle\Paybox\System\Cancellation;

use Lexik\Bundle\PayboxBundle\Paybox\AbstractParameterResolver;
use Symfony\Component\OptionsResolver\Options;

/**
 * Class ParameterResolver
 *
 * @package Lexik\Bundle\PayboxBundle\Paybox\System\Cancellation
 *
 * @author Fabien Pomerol <fabien.pomerol@gmail.com>
 */
class ParameterResolver extends AbstractParameterResolver
{
    /**
     * @var array
     */
    private $knownParameters = array(
        'VERSION',
        'TYPE',
        'SITE',
        'IDENTIFIANT',
        'MACH',
        'HMAC',
        'TIME',
        'ABONNEMENT',
        'REFERENCE',
    );

    /**
     * @var array
     */
    private $requiredParameters = array(
        'VERSION',
        'TYPE',
        'SITE',
        'IDENTIFIANT',
        'MACH',
        'HMAC',
        'TIME',
    );

    /**
     * Resolves parameters for a cancellation call.
     *
     * @param  array $parameters
     *
     * @return Options
     */
    public function resolve(array $parameters)
    {
        $this->initResolver();

        return $this->resolver->resolve($parameters);
    }

    /**
     * Initialize the OptionResolver with required/optionnal options and allowed values.
     */
    protected function initResolver()
    {
        $this->resolver->setRequired($this->requiredParameters);

        $this->resolver->setOptional(array_diff($this->knownParameters, $this->requiredParameters));

        $this->initAllowed();
    }

    /**
     * Initialize allowed values for the cancellation OptionResolver.
     */
    protected function initAllowed()
    {
        $this->resolver->setAllowedValues(array(
            'VERSION' => array('001'),
            'TYPE'    => array('001'),
        ));
    }
}
