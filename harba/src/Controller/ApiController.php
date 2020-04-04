<?php

namespace App\Controller;

use App\Entity\Request\WeatherRequest;
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
     * @Route("", name="main")
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->json(['ok']);
    }

    /**
     * @Route("weather", name="weather")
     *
     * @param WeatherService $weatherService
     * @param Request        $request
     *
     * @return JsonResponse
     */
    public function weather(Request $request, WeatherService $weatherService)
    {
        /* @var WeatherRequest $weatherRequest */
        try {
            $weatherRequest = $this->validate($request->getContent(), WeatherRequest::class);
        } catch (BadRequestHttpException $exception) {
            return $this->failedResponse($exception->getMessage());
        }

        return $this->json($weatherService->getWeatherForCordinates($weatherRequest));
    }
}
