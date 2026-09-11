<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require base_path('routes/auth/v1/auth.php');
    require base_path('routes/project/v1/project.php');
});

