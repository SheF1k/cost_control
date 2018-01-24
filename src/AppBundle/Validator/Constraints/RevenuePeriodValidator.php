<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RevenuePeriodValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof RevenuePeriod) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\RevenuePeriod');
        }

        if ($this->isPreiodRequired($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

    private function isPreiodRequired($value)
    {
        $obj = $this->context->getObject();

        $response = false;

        if ($obj->getIsRegular() && empty($value)) {
            $response = true;
        }

        return $response;
    }
}