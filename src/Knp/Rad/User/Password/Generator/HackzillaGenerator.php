<?php

namespace Knp\Rad\User\Password\Generator;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Hackzilla\PasswordGenerator\Generator\PasswordGeneratorInterface;
use Knp\Rad\User\Password\Generator;

class HackzillaGenerator implements Generator
{
    public function __construct(array $options = [], PasswordGeneratorInterface $generator = null)
    {
        $defaults = [
            'uppercase' => false,
            'lowercase' => true,
            'numeric'   => true,
            'symbol'    => false,
            'length'    => 10,
        ];

        $this->generator = $generator;
        $this->options   = array_merge($defaults, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $this->configure();

        return $this->generator->generatePassword();
    }

    private function configure()
    {
        if (null === $this->generator) {
            $this->generator = new ComputerPasswordGenerator();
        }

        $options = ComputerPasswordGenerator::OPTION_AVOID_SIMILAR;

        if ($this->options['uppercase']) {
            $options = $options | ComputerPasswordGenerator::OPTION_UPPER_CASE;
        }

        if ($this->options['lowercase']) {
            $options = $options | ComputerPasswordGenerator::OPTION_LOWER_CASE;
        }

        if ($this->options['symbol']) {
            $options = $options | ComputerPasswordGenerator::OPTION_SYMBOLS;
        }

        if ($this->options['numeric']) {
            $options = $options | ComputerPasswordGenerator::OPTION_NUMBERS;
        }

        mt_srand();
        $this->generator->setOptions($options);
        $this->generator->setLength($this->options['length']);
    }
}
