<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * @OA\Get(
     *     path="/stocks",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response="200",
     *         description="List of stocks",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="city_id", type="integer", example=1),
     *                 @OA\Property(property="address", type="string", example="Плеханова, дом 2"),
     *                 @OA\Property(property="lat", type="number", example=59.836997),
     *                 @OA\Property(property="lng", type="number", example=30.494354),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Stock::all();
    }

    /**
     * @OA\Post(
     *     path="/stocks",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="city_id", type="integer"),
     *                 @OA\Property(property="address", type="string"),
     *                 @OA\Property(property="lat", type="number", minimum="-90", maximum="90"),
     *                 @OA\Property(property="lng", type="number", minimum="-180", maximum="180")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Stock created",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="city_id", type="integer", example=1),
     *             @OA\Property(property="address", type="string", example="Плеханова, дом 2"),
     *             @OA\Property(property="lat", type="number", example=59.836997),
     *             @OA\Property(property="lng", type="number", example=30.494354),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        return Stock::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/stocks/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="200",
     *         description="Stock details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="city_id", type="integer", example=1),
     *             @OA\Property(property="address", type="string", example="Плеханова, дом 2"),
     *             @OA\Property(property="lat", type="number", example=59.836997),
     *             @OA\Property(property="lng", type="number", example=30.494354),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        return Stock::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/stock/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="city_id", type="integer"),
     *                 @OA\Property(property="address", type="string"),
     *                 @OA\Property(property="lat", type="number", minimum="-90", maximum="90"),
     *                 @OA\Property(property="lng", type="number", minimum="-180", maximum="180")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Stock updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="city_id", type="integer", example=1),
     *             @OA\Property(property="address", type="string", example="Плеханова, дом 2"),
     *             @OA\Property(property="lat", type="number", example=59.836997),
     *             @OA\Property(property="lng", type="number", example=30.494354),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($request->all());
        return $stock;
    }


    /**
     * @OA\Delete(
     *     path="/stock/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="204",
     *         description="Stock deleted"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return response()->json(null, 204);
    }

    /**
     * @OA\Post(
     *     path="/stock/nearby",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="lat", type="number"),
     *                 @OA\Property(property="lng", type="number")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Nearest stock",
     *         @OA\JsonContent(
     *             @OA\Property(property="stock", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="city_id", type="integer", example=1),
     *                 @OA\Property(property="address", type="string", example="Плеханова, дом 2"),
     *                 @OA\Property(property="lat", type="number", example=59.836997),
     *                 @OA\Property(property="lng", type="number", example=30.494354),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *             ),
     *             @OA\Property(property="distance", type="number", example=1.234),
     *             @OA\Property(property="city", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Minsk"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *             )
     *         )
     *     )
     * )
     */
    public function nearby(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        $lat = $request->input('lat');
        $lng = $request->input('lng');

        $nearestStock = Stock::select('stocks.*', DB::raw('ST_Distance(geography(ST_MakePoint(lng, lat)), geography(ST_MakePoint(' . $lng . ', ' . $lat . '))) as distance'))
            ->orderBy('distance')
            ->first();

        return response()->json([
            'stock' => $nearestStock,
            'distance' => $nearestStock->distance,
            'city' => $nearestStock->city,
        ]);
    }
}
