<?php

declare(strict_types=1);

namespace App;

use Tempest\Router\Get;
use Tempest\View\View;

use function Tempest\view;

final class ProfileDebugController
{
    #[Get('/profile-debug')]
    public function __invoke(): View
    {
        $profile = [
            'name' => 'Test User',
            'title' => 'Developer',
        ];

        return view('profile-debug.view.php', [
            'profile' => $profile,
        ]);
    }
}
