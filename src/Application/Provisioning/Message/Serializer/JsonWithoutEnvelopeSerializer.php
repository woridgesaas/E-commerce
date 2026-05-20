<?php

namespace App\Application\Provisioning\Message\Serializer;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class JsonWithoutEnvelopeSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        return Envelope::wrap($encodedEnvelope);
    }

    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();

        if (is_string($message) && json_validate($message)) {
            return [
                'body' => $message,
                'headers' => ['Content-Type' => 'application/json'],
            ];
        }

        return [
            'body' => json_encode($message),
            'headers' => ['Content-Type' => 'application/json'],
        ];
    }
}
