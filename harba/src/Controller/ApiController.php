<?php

namespace App\Controller;

use App\Entity\Request\WeatherRequest;
use App\Service\Harbour\Exception\InvalidResponseException;
use App\Service\Harbour\MapService;
use App\Service\Weather\Provider\Exception\ProviderException;
use App\Service\Weather\WeatherService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiController.
 *
 * @Route("/api", name="api_", methods={"POST"})
 */
class ApiController extends ApiAbstractController
{
    /**
     * @Route("/harbour", name="harbour")
     *
     * @param MapService $mapService
     *
     * @return JsonResponse
     */
    public function harbour(MapService $mapService): JsonResponse
    {
        try {
            return $this->json($mapService->getHarbours());
        } catch (InvalidResponseException $exception) {

            return $this->failedResponse($exception->getMessage());
        }
    }

    /**
     * @Route("/weather", name="weather")
     *
     * @param Request        $request
     * @param WeatherService $weatherService
     *
     * @return JsonResponse
     */
    public function weather(Request $request, WeatherService $weatherService)
    {
        try {
            /* @var WeatherRequest $weatherRequest */
            $weatherRequest = $this->validate($request->getContent(), WeatherRequest::class);

            return $this->json($weatherService->getWeatherByCordinates($weatherRequest));
        } catch (BadRequestHttpException | ProviderException $exception) {

            return $this->failedResponse($exception->getMessage());
        }
    }
}
