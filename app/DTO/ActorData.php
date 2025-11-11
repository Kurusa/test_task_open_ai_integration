<?php

declare(strict_types=1);

namespace App\DTO;

readonly class ActorData
{
    public function __construct(
        private string  $email,
        private string  $description,
        private string  $first_name,
        private string  $last_name,
        private string  $address,
        private ?string $height = null,
        private ?string $weight = null,
        private ?string $gender = null,
        private ?int    $age = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            description: $data['description'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            address: $data['address'],
            height: $data['height'] ?? null,
            weight: $data['weight'] ?? null,
            gender: $data['gender'] ?? null,
            age: isset($data['age']) ? (int)$data['age'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'description' => $this->description,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'height' => $this->height,
            'weight' => $this->weight,
            'gender' => $this->gender,
            'age' => $this->age,
        ];
    }
}
