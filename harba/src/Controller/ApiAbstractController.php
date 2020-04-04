<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ApiAbstractController.
 */
class ApiAbstractController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * ApiController constructor.
     *
     * @param SerializerInterface $serializer
     * @param ValidatorInterface  $validator
     */
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator
    )
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @param string $data
     * @param string $model
     *
     * @return object
     */
    public function validate(string $data, string $model): object
    {
        if (!$data) {
            throw new BadRequestHttpException('Empty body.');
        }

        try {
            $object = $this->serializer->deserialize($data, $model, 'json');
        } catch (\Throwable $e) {
            throw new BadRequestHttpException('Invalid body.');
        }

        $errors = $this->validator->validate($object);
        if ($errors->count()) {
            throw new BadRequestHttpException('Validation failed.');
        }

        return $object;
    }

    /**
     * @param string $message
     *
     * @return JsonResponse
     */
    public function failedResponse(string $message): JsonResponse
    {
        return $this->json(
            [
                'message' => $message,
            ],
            Response::HTTP_BAD_REQUEST
        );
    }
}
