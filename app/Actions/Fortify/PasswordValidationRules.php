<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        $passwordRule = new Password();
        $passwordRule->requireUppercase();
        $passwordRule->requireNumeric();
        return ['required', 'string', $passwordRule, 'confirmed'];
    }
}
