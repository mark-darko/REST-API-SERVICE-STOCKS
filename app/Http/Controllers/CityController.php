<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * @OA\Get(
     *     path="/cities",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response="200",
     *         description="List of cities",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Minsk"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return City::all();
    }

    /**
     * @OA\Post(
     *     path="/city",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="City created",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Minsk"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        return City::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/city/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="200",
     *         description="City details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Minsk"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        return City::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/city/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="City updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Minsk"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-16T18:36:51Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-16T18:36:51Z")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
        return $city;
    }

    /**
     * @OA\Delete(
     *     path="/city/{id}",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="204",
     *         description="City deleted"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/city/{id}/stocks",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response="200",
     *         description="List of stocks for a city",
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
    public function stocks($id)
    {
        $city = City::findOrFail($id);
        return $city->stocks;
    }
}
