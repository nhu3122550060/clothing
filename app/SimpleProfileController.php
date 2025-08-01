<?php

declare(strict_types=1);

namespace App;

use Tempest\Router\Get;
use Tempest\View\View;

use function Tempest\view;

final class SimpleProfileController
{
    #[Get('/simple-profile')]
    public function __invoke(): View
    {
        $data = [
            'name' => 'Test User',
            'title' => 'Developer',
            'email' => 'test@example.com'
        ];

        return view('simple-profile.view.php', [
            'profileData' => $data,
        ]);
    }
}
