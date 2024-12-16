<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(title="Warehouse API", version="1.0", description="API for managing warehouses")
 * @OA\Components(
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer",
 *         bearerFormat="JWT"
 *     )
 * )
 */
abstract class Controller
{
    //
}
